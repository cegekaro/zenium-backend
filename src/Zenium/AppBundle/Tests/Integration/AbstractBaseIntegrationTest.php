<?php


namespace Zenium\AppBundle\Tests\Integration;


use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\Container;

abstract class AbstractBaseIntegrationTest extends WebTestCase
{
    /**
     * @var Container
     */
    protected $container;
    /**
     * @var ObjectManager
     */
    protected $manager;

    public function setUp()
    {
        parent::setUp();

        static::$kernel = static::createKernel();
        static::$kernel->boot();

        $this->container = static::$kernel->getContainer();
        $this->manager   = $this->getContainer()->get('doctrine')->getManager();
    }

    /**
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @return ObjectManager
     */
    public function getManager()
    {
        return $this->manager;
    }
}
