<?php


namespace Zenium\ApiBundle\Tests\Functional;


use Guzzle\Http\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * Base test class for controllers. Enables for RAD
 * on REST controllers by testing popular methods.
 *
 * @package Zenium\ApiBundle\Tests\Functional
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
abstract class AbstractApiControllerTest extends WebTestCase
{
    /**
     * @var Client
     */
    protected $guzzleClient;

    protected $hostname = 'http://zenium-backend.dev/';

    public function setUp()
    {
        parent::setUp();

        $this->guzzleClient = new Client;
    }

    /**
     * Retrieve the URL path of the controller.
     * Used in order to generate paths for the request tests.
     * Example: /question-category/
     *
     * @return string
     */
    abstract public function getUrlPath();

    /**
     * @param null $id
     *
     * @return string
     */
    protected function generateUrl($id = null)
    {
        $url = $this->hostname . 'api/' . $this->getUrlPath() . '/';

        if (null !== $id) {
            $url .= $id . '/';
        }

        return $url;
    }

    /**
     * @param      $url
     * @param      $method
     * @param null $requestBody
     *
     * @return \Guzzle\Http\Message\Response|null
     */
    protected function makeRequest($url, $method, $requestBody = null)
    {
        $responseWrapper = null;

        try {
            $responseWrapper = $this->getGuzzleClient()->createRequest($method, $url, null, $requestBody)->send();
        } catch (ClientErrorResponseException $exception) {
            $responseWrapper = $exception->getResponse();
        }

        return $responseWrapper;
    }

    /**
     * @param $fileName
     */
    protected function readMockFile($fileName)
    {
        $fileContents = @file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Resources' . DIRECTORY_SEPARATOR . 'api-mock' . DIRECTORY_SEPARATOR . $fileName);

        if (false === $fileContents) {
            throw new FileException('Requested mockfile not found.');
        }
    }

    /**
     * @param $url
     * @param $method
     * @param $requestBody
     * @dataProvider restActionDataProvider
     */
    public function testRestActions($url, $method, $requestBody = null)
    {
        $responseWrapper = $this->makeRequest($this->generateUrl(), 'GET');
        $this->assertEquals(200, $responseWrapper->getStatusCode());

        $responseBody = $responseWrapper->getBody(true);
        $this->assertJson($responseBody);
    }

    /**
     * @return array
     */
    public function restActionDataProvider()
    {
        return [
            [$this->generateUrl(), 'GET', null],
            [$this->generateUrl(1), 'GET'],
            [$this->generateUrl(1), 'DELETE'],
            [$this->generateUrl(), 'POST', $this->readMockFile('question_category.create.request.json')],
            [$this->generateUrl(2), 'PUT', $this->readMockFile('question_category.update.request.json')],
        ];
    }

    /**
     * @return Client
     */
    public function getGuzzleClient()
    {
        return $this->guzzleClient;
    }


}
