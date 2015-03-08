<?php

namespace ApiBundle\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Symfony2Extension\Context\KernelAwareContext;
use Symfony\Component\HttpKernel\KernelInterface;

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
        $requestData     = $this->getRequestData();

        $responseWrapper = $this->getGuzzleClient()->createRequest($requestMethod, $requestUrl, null, $requestData)->send();
        $this->setResponseData($responseWrapper);
    }

    /**
     * @Then the response has a status code of :arg1
     */
    public function theResponseHasAStatusCodeOf($expectedStatusCode)
    {
        $actualStatusCode = $this->getResponseData()->getStatusCode();

        \PHPUnit_Framework_TestCase::assertEquals($expectedStatusCode, $actualStatusCode, "Expected the response to have a status code of {$actualStatusCode}.");
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
        $responseBody = $this->getResponseData()->getBody(true);
        $responseArray = json_decode($responseBody, true);

        \PHPUnit_Framework_TestCase::assertArrayHasKey($key, $responseArray, "The {$key} key does not exist in the returned JSON.");
        \PHPUnit_Framework_TestCase::assertEquals($value, $responseArray[$key], "The value {$value} does not match the value returned, {$responseArray[$key]}.");
    }
}
