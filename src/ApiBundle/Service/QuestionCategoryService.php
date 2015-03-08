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

        $questionCategory->setName($properties['name']);

        return $questionCategory;
    }

}
