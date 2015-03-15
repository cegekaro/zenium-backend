<?php

namespace Zenium\ApiBundle\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Guzzle\Http\Exception\ClientErrorResponseException;

/**
 * Defines application features from the specific context.
 *
 * @package ApiBundle\Features\Context
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
class FeatureContext extends BaseApiFeature implements Context, SnippetAcceptingContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct($host)
    {
        parent::__construct($host);
    }

    /**
     * @Given I want to make an API request with the data in file :arg1
     */
    public function iWantToMakeAnApiRequestWithTheDataInFile($file)
    {
        $fileContent = $this->readFile($file);
        $this->setRequestData($fileContent);
    }

    /**
     * @When I make a :arg1 request to :arg2
     */
    public function iAmMakingARequestTo($requestMethod, $requestUrl)
    {
        $requestData = $this->getRequestData();

        $responseWrapper = null;
        try {
            $responseWrapper = $this->getGuzzleClient()->createRequest($requestMethod, $requestUrl, null, $requestData)->send();
        } catch (ClientErrorResponseException $exception) {
            $responseWrapper = $exception->getResponse();
        }

        $this->setResponseData($responseWrapper);
    }

    /**
     * @Then the response has a status code of :arg1
     */
    public function theResponseHasAStatusCodeOf($expectedStatusCode)
    {
        $actualStatusCode = $this->getResponseData()->getStatusCode();

        \PHPUnit_Framework_TestCase::assertEquals($expectedStatusCode, $actualStatusCode, "Expected the response to have a status code of {$expectedStatusCode}.");
    }

    /**
     * @Then the response contains valid JSON
     */
    public function theResponseContainsValidJson()
    {
        $responseBody = $this->getResponseData()->getBody(true);

        \PHPUnit_Framework_TestCase::assertJson($responseBody, 'Expected the response to be valid JSON.');
    }

    /**
     * @Then the response has the value :arg1 set to :arg2
     */
    public function theResponseHasTheValueSetTo($key, $value)
    {
        $responseBody  = $this->getResponseData()->getBody(true);
        $responseArray = json_decode($responseBody, true);

        $this->checkIfKeyHasValue($responseArray, $key, $value);
    }

    /**
     * @Then the response has extra information with the value :arg1 set to :arg2
     */
    public function theResponseHasExtraInformationWithTheValueSetTo($key, $value)
    {
        $responseBody  = $this->getResponseData()->getBody(true);
        $responseArray = json_decode($responseBody, true);

        $this->checkIfKeyHasValue($responseArray['extra'], $key, $value);
    }

    /**
     * @Then the response contains an array with :arg1 items.
     */
    public function theResponseContainsAnArrayWithItems($itemCount)
    {
        $itemCount = intval($itemCount);

        $responseBody  = $this->getResponseData()->getBody(true);
        $responseArray = json_decode($responseBody, true);

        \PHPUnit_Framework_TestCase::assertCount($itemCount, $responseArray);
    }

    public function checkIfKeyHasValue($responseArray, $key, $value)
    {
        \PHPUnit_Framework_TestCase::assertArrayHasKey($key, $responseArray, "The {$key} key does not exist in the returned JSON.");
        \PHPUnit_Framework_TestCase::assertEquals($value, $responseArray[$key], "The value {$value} does not match the value returned, {$responseArray[$key]}.");
    }

}
