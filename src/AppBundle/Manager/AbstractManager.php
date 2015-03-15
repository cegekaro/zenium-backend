<?php


namespace AppBundle\Manager;


use AppBundle\Entity\AbstractBaseEntity;
use AppBundle\Repository\AbstractBaseRepository;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Governs the methods for Manager services.
 *
 * @package AppBundle\Manager
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
abstract class AbstractManager
{
    /**
     * @var ObjectManager
     */
    protected $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Retrieve the repository of the Entity class.
     *
     * @return AbstractBaseRepository
     */
    abstract function getRepository();

    /**
     * Retrieve an entry by its primary key.
     *
     * @param int $id The ID of the entry.
     *
     * @return null|AbstractBaseEntity
     */
    public function findOneById($id)
    {
        return $this->getRepository()->findOneBy([
            'id' => $id,
            'deleted' => false,
        ]);
    }

    /**
     * Retrieve all of the valid entries in the system.
     *
     * @return array
     */
    public function findAll()
    {
        return $this->getRepository()->findBy([
            'deleted' => false,
        ]);
    }

    /**
     * @return ObjectManager
     */
    public function getManager()
    {
        return $this->manager;
    }
}
