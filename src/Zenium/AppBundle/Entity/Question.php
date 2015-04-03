<?php


namespace Zenium\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Definition of the Question entity.
 * Used to define the questions / exercises that the candidates must answer in order
 * to assess their technical skill level.
 *
 * @package AppBundle\Entity
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 *
 * @ORM\Entity(repositoryClass="Zenium\AppBundle\Repository\QuestionRepository")
 * @ORM\Table(name="question")
 *
 * @JMS\ExclusionPolicy("all")
 */
class Question extends AbstractBaseEntity
{
    /**
     * @var QuestionCategory
     *
     * @ORM\ManyToOne(targetEntity="Zenium\AppBundle\Entity\QuestionCategory", inversedBy="questions")
     * @ORM\JoinColumn(name="question_category_id")
     */
    protected $questionCategory;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", length=160)
     *
     * @Assert\NotNull()
     * @Assert\NotBlank()
     *
     * @JMS\Type("string")
     * @JMS\Expose()
     */
    protected $content;

    /**
     * @var int
     *
     * @ORM\Column(name="difficulty", type="smallint")
     *
     * @Assert\NotNull()
     * @Assert\NotBlank()
     *
     * @JMS\Type("integer")
     * @JMS\Expose()
     */
    protected $difficulty;

    /**
     * @return QuestionCategory
     */
    public function getQuestionCategory()
    {
        return $this->questionCategory;
    }

    /**
     * @param QuestionCategory $questionCategory
     *
     * @return $this
     */
    public function setQuestionCategory($questionCategory)
    {
        $this->questionCategory = $questionCategory;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return int
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * @param int $difficulty
     *
     * @return $this
     */
    public function setDifficulty($difficulty)
    {
        $this->difficulty = $difficulty;

        return $this;
    }


}
