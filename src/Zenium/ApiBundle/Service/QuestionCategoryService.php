<?php


namespace Zenium\ApiBundle\Service;


use Zenium\AppBundle\Entity\AbstractBaseEntity;
use Zenium\AppBundle\Entity\QuestionCategory;

/**
 * Manages creating and updating data for Question Categories.
 *
 * @package ApiBundle\Service
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
class QuestionCategoryService extends AbstractEntityService
{
    /**
     * Create a new entry from an array.
     *
     * @param array $properties The properties with which the entry is built.
     *
     * @return AbstractBaseEntity
     */
    public function createFromArray(array $properties = [])
    {
        $questionCategory = new QuestionCategory;

        return $this->updateFromArray($questionCategory, $properties);
    }

    /**
     * Update an entry with data from an array.
     *
     * @param AbstractBaseEntity $object
     * @param array              $properties
     *
     * @return AbstractBaseEntity
     */
    public function updateFromArray(AbstractBaseEntity $object, array $properties = [])
    {
        if (array_key_exists('name', $properties)) {
            $object->setName($properties['name']);
        }

        return $object;
    }
}
