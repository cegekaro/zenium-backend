<?php


namespace Zenium\AppBundle\Tests\Integration\Manager;


use Zenium\AppBundle\Manager\AbstractManager;

class QuestionCategoryManagerTest extends AbstractManagerTest
{
    /**
     * @return AbstractManager
     */
    public function getTestedManager()
    {
        return $this->getContainer()->get('app.question_category.manager');
    }

    /**
     * Retrieve the class path of the tested Entity, in order to make
     * instance checks.
     *
     * @return string
     */
    public function getClassPath()
    {
        return 'Zenium\AppBundle\Entity\QuestionCategory';
    }


}
