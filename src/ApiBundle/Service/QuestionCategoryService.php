<?php


namespace ApiBundle\Service;


use AppBundle\Entity\AbstractBaseEntity;
use AppBundle\Entity\QuestionCategory;

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
        $object->setName($properties['name']);

        return $object;
    }


}
