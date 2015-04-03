<?php


namespace Zenium\AppBundle\Manager;

use Zenium\AppBundle\Entity\Question;
use Zenium\AppBundle\Entity\QuestionCategory;
use Zenium\AppBundle\Repository\AbstractBaseRepository;

/**
 * Manager operations available for Questions.
 *
 * @package AppBundle\Manager
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
class QuestionManager extends AbstractManager
{
    /**
     * Retrieve the repository of the Entity class.
     *
     * @return AbstractBaseRepository
     */
    public function getRepository()
    {
        return $this->getManager()->getRepository('AppBundle:Question');
    }

    /**
     * Associate a Question to a QuestionCategory.
     *
     * @param Question         $question
     * @param QuestionCategory $questionCategory
     *
     * @return Question
     */
    public function associateQuestionToQuestionCategory(Question $question, QuestionCategory $questionCategory)
    {
        $question->setQuestionCategory($questionCategory);
        $this->getManager()->flush();

        return $question;
    }
}
