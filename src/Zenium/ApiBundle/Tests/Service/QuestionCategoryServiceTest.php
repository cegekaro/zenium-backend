<?php


namespace Zenium\ApiBundle\Tests\Service;


use Zenium\ApiBundle\Service\QuestionCategoryService;
use Zenium\AppBundle\Tests\Integration\AbstractBaseIntegrationTest;

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

    public function testCreateFromArrayWhenDataIsValid()
    {
        $seedData = [
            'name' => 'Scrum'
        ];

        $generatedEntity = $this->questionCategoryService->createFromArray($seedData);
    }

    public function testUpdateFromArray()
    {
        $this->markTestIncomplete();
    }
}
