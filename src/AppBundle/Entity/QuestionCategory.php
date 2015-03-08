<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Definition of the Question Category entity.
 * Used to define categories in which questions are placed and which are then referenced in tests.
 *
 * @package AppBundle\Entity
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QuestionCategoryRepository")
 * @ORM\Table(name="question_category")
 *
 * @JMS\ExclusionPolicy("all")
 */
class QuestionCategory extends AbstractBaseEntity
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=160)
     *
     * @JMS\Type("string")
     * @JMS\Expose()
     */
    protected $name;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }


}
