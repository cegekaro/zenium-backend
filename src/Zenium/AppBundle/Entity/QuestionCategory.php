<?php


namespace Zenium\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Definition of the Question Category entity.
 * Used to define categories in which questions are placed and which are then referenced in tests.
 *
 * @package AppBundle\Entity
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 *
 * @ORM\Entity(repositoryClass="Zenium\AppBundle\Repository\QuestionCategoryRepository")
 * @ORM\Table(name="question_category")
 *
 * @JMS\ExclusionPolicy("all")
 */
class QuestionCategory extends AbstractBaseEntity
{
    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=160)
     *
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\Length(min="2", max="160")
     *
     * @JMS\Type("string")
     * @JMS\Expose()
     */
    protected $name;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Zenium\AppBundle\Entity\Question", cascade={"persist", "remove"}, mappedBy="questionCategory")
     */
    protected $questions;

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

    /**
     * @return ArrayCollection
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * @param ArrayCollection $questions
     *
     * @return $this
     */
    public function setQuestions($questions)
    {
        $this->questions = $questions;

        return $this;
    }

    /**
     * @param Question $question
     *
     * @return $this
     */
    public function addQuestion(Question $question)
    {
        $this->questions->add($question);

        return $this;
    }
}
