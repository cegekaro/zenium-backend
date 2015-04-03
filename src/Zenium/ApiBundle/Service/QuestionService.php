<?php


namespace Zenium\ApiBundle\Service;


use Zenium\AppBundle\Entity\AbstractBaseEntity;
use Zenium\AppBundle\Entity\Question;
use Zenium\AppBundle\Entity\QuestionCategory;
use Zenium\AppBundle\Exception\ZeniumException;

/**
 * Manages creating and updating data for Questions.
 *
 * @package ApiBundle\Service
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
class QuestionService extends AbstractEntityService
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
        $question = new Question;

        return $this->updateFromArray($question, $properties);
    }

    /**
     * Update an entry with data from an array.
     *
     * @param AbstractBaseEntity $object
     * @param array              $properties
     *
     * @return AbstractBaseEntity
     * @throws ZeniumException
     */
    public function updateFromArray(AbstractBaseEntity $object, array $properties = [])
    {
        if (!$object instanceof Question) {
            throw new ZeniumException("Invalid data sent for update");
        }

        if (array_key_exists('content', $properties)) {
            $object->setContent($properties['content']);
        }

        if (array_key_exists('difficulty', $properties)) {
            $object->setDifficulty($properties['difficulty']);
        }

        return $object;
    }
}
