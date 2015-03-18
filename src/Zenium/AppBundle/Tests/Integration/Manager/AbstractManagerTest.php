<?php


namespace Zenium\AppBundle\Tests\Integration\Manager;


use Zenium\AppBundle\Manager\AbstractManager;
use Zenium\AppBundle\Tests\Integration\AbstractBaseIntegrationTest;

abstract class AbstractManagerTest extends AbstractBaseIntegrationTest
{
    /**
     * Retrieve the specific manager that will be tested.
     *
     * @return AbstractManager
     */
    abstract public function getTestedManager();

    /**
     * Retrieve the class path of the tested Entity, in order to make
     * instance checks.
     *
     * @return string
     */
    abstract public function getClassPath();

    public function testGetRepository()
    {
        $repository = $this->getTestedManager()->getRepository();

        $this->assertNotNull($repository);
        $this->assertInstanceOf('Zenium\AppBundle\Repository\AbstractBaseRepository', $repository);
    }

    public function testFindOneById()
    {
        $entity = $this->getTestedManager()->findOneById(2);

        $this->assertNotNull($entity, 'Fixture data has not been defined.');
        $this->assertInstanceOf($this->getClassPath(), $entity, 'Entity did not match classpath.');
        $this->assertEquals(2, $entity->getId(), 'The method did not retrieve the ID that was requested.');
        $this->assertFalse($entity->isDeleted(), 'Find method retrieved a deleted entity.');
    }

    public function testFindAll()
    {
        $entities = $this->getTestedManager()->findAll();

        foreach ($entities as $entity) {
            $this->assertInstanceOf($this->getClassPath(), $entity, 'Entity did not match classpath.');
            $this->assertFalse($entity->isDeleted(), 'Find method retrieved a deleted entity.');
        }
    }
}
