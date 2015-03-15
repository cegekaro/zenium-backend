<?php


namespace ApiBundle\Service;

use AppBundle\Entity\AbstractBaseEntity;

/**
 * Governs the entity services in the API Bundle.
 *
 * @package ApiBundle\Service
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
abstract class AbstractEntityService
{
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
}
