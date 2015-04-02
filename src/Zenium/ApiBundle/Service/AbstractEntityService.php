<?php


namespace Zenium\ApiBundle\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Zenium\AppBundle\Entity\AbstractBaseEntity;
use Zenium\AppBundle\Exception\ZeniumException;
use Zenium\AppBundle\Exception\ZeniumStatusCode;

/**
 * Governs the entity services in the API Bundle.
 *
 * @package ApiBundle\Service
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
abstract class AbstractEntityService
{
    /**
     * @var ExceptionProcessingService
     */
    protected $exceptionProcessingService;

    /**
     * @var ValidatorInterface
     */
    protected $validationService;

    /**
     * @var ObjectManager
     */
    protected $manager;

    public function __construct(ObjectManager $manager, ExceptionProcessingService $exceptionProcessingService, ValidatorInterface $validationService)
    {
        $this->manager                    = $manager;
        $this->exceptionProcessingService = $exceptionProcessingService;
        $this->validationService          = $validationService;
    }

    /**
     * Create a new entry from a properties array and validate it.
     * Will throw a ZeniumException that should be automatically caught
     * by the appropriate Listener, so that the API call gets a specific Response.
     *
     * @param array $properties The data that the entity should be made from.
     *
     * @return AbstractBaseEntity
     * @throws ZeniumException
     */
    public function createFromArrayValidateAndPersist(array $properties = [])
    {
        $entity           = $this->createFromArray($properties);
        $validationErrors = $this->getValidationService()->validate($entity);

        if (count($validationErrors) > 0) {
            $validationErrors = $this->getExceptionProcessingService()->processValidationErrorsIntoJsonArray($validationErrors);
            throw new ZeniumException('Entity does not validate correctly.', ZeniumStatusCode::INVALID_DATA, $validationErrors);
        }

        $this->getManager()->persist($entity);
        $this->getManager()->flush();

        return $entity;
    }

    /**
     * Update an entry with data from an array.
     *
     * @param AbstractBaseEntity $object
     * @param array              $properties
     *
     * @return AbstractBaseEntity
     */
    abstract public function updateFromArray(AbstractBaseEntity $object, array $properties = []);

    /**
     * Create a new entry from an array.
     *
     * @param array $properties
     *
     * @return AbstractBaseEntity
     */
    abstract public function createFromArray(array $properties = []);

    /**
     * @return ExceptionProcessingService
     */
    public function getExceptionProcessingService()
    {
        return $this->exceptionProcessingService;
    }

    /**
     * @return ValidatorInterface
     */
    public function getValidationService()
    {
        return $this->validationService;
    }

    /**
     * @return ObjectManager
     */
    public function getManager()
    {
        return $this->manager;
    }
}
