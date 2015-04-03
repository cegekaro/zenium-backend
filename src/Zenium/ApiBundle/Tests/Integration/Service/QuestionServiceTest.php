<?php


namespace Zenium\ApiBundle\Tests\Integration\Service;


use Zenium\ApiBundle\Service\QuestionService;
use Zenium\AppBundle\Entity\Question;
use Zenium\AppBundle\Tests\Integration\AbstractBaseIntegrationTest;

/**
 * Class QuestionServiceTestAbstract
 *
 * @package ApiBundle\Tests\Service
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
class QuestionServiceTest extends AbstractBaseIntegrationTest
{
    /**
     * @var QuestionService
     */
    protected $questionService;

    public function setUp()
    {
        parent::setUp();

        $this->questionService = $this->getContainer()->get('zenium.api.question.service');
    }

    public function testCreateFromArray()
    {
        $seedData = [
            'content' => 'Content create test',
            'difficulty' => 3,
            'randomOtherData' => 123
        ];

        /** @var Question $generatedEntity */
        $generatedEntity = $this->questionService->createFromArray($seedData);

        $this->assertInstanceOf('Zenium\AppBundle\Entity\Question', $generatedEntity, 'Entity should be a Question');
        $this->assertEquals($seedData['content'], $generatedEntity->getContent(), 'The content of the entity was not set correctly.');
        $this->assertEquals($seedData['difficulty'], $generatedEntity->getDifficulty(), 'The difficulty of the entity was not set correctly.');
    }

    public function testUpdateFromArray()
    {
        $seedData = [
            'content' => 'Content create test',
            'difficulty' => 3,
            'id' => 23,
            'randomOtherData' => 123,
        ];

        $originalEntity = new Question;
        $originalEntity->setContent('Test pre-update')
            ->setDifficulty(3);

        /** @var Question $generatedEntity */
        $generatedEntity = $this->questionService->updateFromArray($originalEntity, $seedData);

        $this->assertInstanceOf('Zenium\AppBundle\Entity\Question', $generatedEntity, 'Entity should be a Question');
        $this->assertEquals($seedData['content'], $generatedEntity->getContent(), 'The content of the entity was not updated.');
        $this->assertEquals($seedData['difficulty'], $generatedEntity->getDifficulty(), 'The difficulty of the entity was not updated.');
        $this->assertNotEquals($seedData['id'], $generatedEntity->getId(), 'The ID of the entity was updated and it should not have happened.');
        $this->assertNull($generatedEntity->getId(), 'The ID is not null, which means the entity was persisted at one point.');
    }
}
