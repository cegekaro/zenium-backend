<?php


namespace Zenium\AppBundle\Tests\Functional;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpKernel\Client;

/**
 * Base class used by functional tests in the system.
 *
 * @package Zenium\AppBundle\Tests\Functional
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
abstract class AbstractBaseFunctionalTest extends WebTestCase
{
    /**
     * @var Client
     */
    protected $client;
    /**
     * @var Container
     */
    protected $container;

    public function setUp()
    {
        parent::setUp();

        $this->client = static::createClient();
        $this->client->followRedirects(true);
        $this->container = $this->client->getContainer();
    }

    public function assertJsonResponse()
    {
        $contentType = $this->client->getResponse()->headers->get('content-type');
        $this->assertEquals('application/json', $contentType, 'Response was not a JSON');
    }

    public function assertSuccessfulResponse()
    {
        $statusCode = $this->client->getResponse()->getStatusCode();
        $this->assertEquals(200, $statusCode, 'Response was not successful');
    }

    /**
     * @return \Symfony\Component\HttpKernel\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @return \Symfony\Component\DependencyInjection\Container
     */
    public function getContainer()
    {
        return $this->container;
    }
}
