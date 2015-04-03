<?php


namespace Zenium\AppBundle\Tests\Integration\Manager;


use Zenium\AppBundle\Entity\Question;
use Zenium\AppBundle\Entity\QuestionCategory;
use Zenium\AppBundle\Manager\AbstractManager;
use Zenium\AppBundle\Manager\QuestionManager;

/**
 * Integration test for the Question Manager class.
 *
 * @package Zenium\AppBundle\Tests\Integration\Manager
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
class QuestionManagerTest extends AbstractManagerTest
{
    /**
     * @return QuestionManager
     */
    public function getTestedManager()
    {
        return $this->getContainer()->get('zenium.app.question.manager');
    }

    /**
     * Retrieve the class path of the tested Entity, in order to make
     * instance checks.
     *
     * @return string
     */
    public function getClassPath()
    {
        return 'Zenium\AppBundle\Entity\Question';
    }

    public function testAssociateQuestionToQuestionCategory()
    {
        $questionCategory = new QuestionCategory();
        $questionCategory
            ->setName('Association Test');

        $question = new Question();
        $question
            ->setContent('Association Test Content')
            ->setDifficulty(3);

        $this->assertNull($question->getQuestionCategory());

        $this->getTestedManager()->associateQuestionToQuestionCategory($question, $questionCategory);

        $this->assertNotNull($question->getQuestionCategory());
        $this->assertEquals($questionCategory, $question->getQuestionCategory());
    }
}
