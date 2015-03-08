<?php


namespace ApiBundle\Service;

use AppBundle\Entity\AbstractBaseEntity;

/**
 * Governs the services in the API Bundle.
 *
 * @package ApiBundle\Service
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
abstract class AbstractEntityService
{
    /**
     * Create a new entry from an array.
     *
     * @param array $properties The properties with which the entry is built.
     *
     * @return AbstractBaseEntity
     */
    abstract public function createFromArray(array $properties = []);
}
