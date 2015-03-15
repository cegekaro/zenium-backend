<?php


namespace ApiBundle\Tests\Service;


use ApiBundle\Service\QuestionCategoryService;
use AppBundle\Tests\Integration\AbstractBaseIntegrationTest;

/**
 * Class QuestionCategoryServiceTestAbstract
 *
 * @package ApiBundle\Tests\Service
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
class QuestionCategoryServiceTestAbstract extends AbstractBaseIntegrationTest
{
    /**
     * @var QuestionCategoryService
     */
    protected $questionCategoryService;

    public function setUp()
    {
        parent::setUp();

        $this->questionCategoryService = $this->getContainer()->get('api.question_category.service');
    }

    public function testCreateFromArray()
    {
        $this->markTestIncomplete();
    }

    public function testUpdateFromArray()
    {
        $this->markTestIncomplete();
    }
}
