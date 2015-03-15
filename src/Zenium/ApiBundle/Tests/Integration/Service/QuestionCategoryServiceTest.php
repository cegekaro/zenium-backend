<?php


namespace Zenium\ApiBundle\Tests\Integration\Service;


use Zenium\ApiBundle\Service\QuestionCategoryService;
use Zenium\AppBundle\Entity\QuestionCategory;
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

    public function testCreateFromArray()
    {
        $testName = 'Scrum';

        $seedData = [
            'name' => $testName,
            'randomOtherData' => 123
        ];

        /** @var QuestionCategory $generatedEntity */
        $generatedEntity = $this->questionCategoryService->createFromArray($seedData);

        $this->assertInstanceOf('Zenium\AppBundle\Entity\QuestionCategory', $generatedEntity, 'Entity should be a Question Category');
        $this->assertEquals($testName, $generatedEntity->getName(), 'The name of the entity was not set correctly.');
    }

    public function testUpdateFromArray()
    {
        $testName = 'OOP';

        $seedData = [
            'name' => 'OOP',
            'id' => 23,
        ];

        $originalEntity = new QuestionCategory;
        $originalEntity->setName('Agile');

        /** @var QuestionCategory $generatedEntity */
        $generatedEntity = $this->questionCategoryService->updateFromArray($originalEntity, $seedData);

        $this->assertInstanceOf('Zenium\AppBundle\Entity\QuestionCategory', $generatedEntity, 'Entity should be a Question Category');
        $this->assertEquals($testName, $generatedEntity->getName(), 'The name of the entity was not updated.');
        $this->assertNotEquals($seedData['id'], $generatedEntity->getId(), 'The ID of the entity was updated and it should not have happened.');
        $this->assertNull($generatedEntity->getId(), 'The ID is not null, which means the entity was persisted at one point.');
    }
}
