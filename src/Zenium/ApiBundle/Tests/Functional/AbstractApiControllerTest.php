<?php


namespace Zenium\ApiBundle\Tests\Functional;


use Guzzle\Http\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Zenium\AppBundle\Tests\Functional\AbstractBaseFunctionalTest;

/**
 * Base test class for controllers. Enables for RAD
 * on REST controllers by testing popular methods.
 *
 * @package Zenium\ApiBundle\Tests\Functional
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
abstract class AbstractApiControllerTest extends AbstractBaseFunctionalTest
{
    /**
     * Retrieve the URL path of the controller.
     * Used in order to generate paths for the request tests.
     * Example: /question-category/
     *
     * @return string
     */
    abstract public function getUrlPath();

    /**
     * @param $fileName
     *
     * @return string
     */
    protected function readMockFile($fileName)
    {
        $fileContents = @file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Resources' . DIRECTORY_SEPARATOR . 'api-mock' . DIRECTORY_SEPARATOR . $fileName);

        if (false === $fileContents) {
            throw new FileException('Requested mockfile not found.');
        }

        return $fileContents;
    }

    /**
     * @param $requestMethod
     * @param $requestUrl
     * @param $requestBody
     *
     * @dataProvider restActionDataProvider
     */
    public function testRestActions($requestMethod, $requestUrl, $requestBody = null)
    {
        $this->getClient()->request($requestMethod, $requestUrl, [], [], [], $requestBody);

        $this->assertSuccessfulResponse();
        $this->assertJsonResponse();
    }

    /**
     * Get the data to make a valid create request.
     *
     * @return string
     */
    abstract protected function getCreateMockData();

    /**
     * Get the data to make a valid update request.
     *
     * @return string
     */
    abstract protected function getUpdateMockData();

    /**
     * Verify the data that was retrieved after making a create request.
     *
     * @param array $responseData The data retrieved, after decoding it from JSON into an array.
     *
     * @return mixed
     */
    abstract protected function verifyCreateResponse(array $responseData);

    /**
     * Verify the data that was retrieved after making an update request.
     *
     * @param array $responseData The data retrieved, after decoding it from JSON into an array.
     *
     * @return mixed
     */
    abstract protected function verifyUpdateResponse(array $responseData);

    /**
     * Verify the data that was retrieved after making a retrieve request.
     *
     * @param array $responseData The data retrieved, after decoding it from JSON into an array.
     *
     * @return mixed
     */
    abstract protected function verifyRetrieveResponse(array $responseData);

    /**
     * Verify the data that was retrieved after making a list request.
     *
     * @param array $responseData The data retrieved, after decoding it from JSON into an array.
     *
     * @return mixed
     */
    abstract protected function verifyListResponse(array $responseData);

    /**
     * @return array
     */
    public function restActionDataProvider()
    {
        $urlPath = '/api/' . $this->getUrlPath();

        return [
            ['GET', $urlPath],
            ['GET', $urlPath . '1'],
            ['DELETE', $urlPath . '1'],
            ['POST', $urlPath, $this->getCreateMockData()],
            ['PUT', $urlPath . '2', $this->getUpdateMockData()],
        ];
    }

    public function testListAction()
    {
        $this->getClient()->request('GET', '/api/' . $this->getUrlPath());
        $responseContent = $this->getClient()->getResponse()->getContent();
        $responseData    = json_decode($responseContent, true);

        $this->verifyListResponse($responseData);
    }

    public function testCreateAction()
    {
        $this->getClient()->request('POST', '/api/' . $this->getUrlPath(), [], [], [], $this->getCreateMockData());
        $responseContent = $this->getClient()->getResponse()->getContent();
        $responseData    = json_decode($responseContent, true);

        $this->verifyCreateResponse($responseData);
    }

    public function testUpdateAction()
    {
        $this->getClient()->request('PUT', '/api/' . $this->getUrlPath() . '2', [], [], [], $this->getUpdateMockData());
        $responseContent = $this->getClient()->getResponse()->getContent();
        $responseData    = json_decode($responseContent, true);

        $this->verifyUpdateResponse($responseData);
    }

    /**
     * @depends testUpdateAction
     */
    public function testGetAction()
    {
        $this->getClient()->request('GET', '/api/' . $this->getUrlPath() . '2');
        $responseContent = $this->getClient()->getResponse()->getContent();
        $responseData    = json_decode($responseContent, true);

        $this->verifyRetrieveResponse($responseData);
    }
}
