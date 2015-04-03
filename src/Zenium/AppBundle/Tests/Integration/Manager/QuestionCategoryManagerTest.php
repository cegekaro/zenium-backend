<?php


namespace Zenium\AppBundle\Tests\Integration\Manager;


use Zenium\AppBundle\Manager\AbstractManager;

/**
 * Integration test for the Question Category Manager class.
 *
 * @package Zenium\AppBundle\Tests\Integration\Manager
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
class QuestionCategoryManagerTest extends AbstractManagerTest
{
    /**
     * @return AbstractManager
     */
    public function getTestedManager()
    {
        return $this->getContainer()->get('zenium.app.question_category.manager');
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
