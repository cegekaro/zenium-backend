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
     * @dataProvider restActionDataProvider
     */
    public function testRestActions($requestMethod, $requestUrl, $requestBody = null)
    {
        $this->getClient()->request($requestMethod, $requestUrl, [], [], [], $requestBody);

        $this->assertSuccessfulResponse();
        $this->assertJsonResponse();
    }

    /**
     * @return array
     */
    abstract public function restActionDataProvider();

}
