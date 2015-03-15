<?php


namespace Zenium\ApiBundle\Tests\Integration\Service;


use Zenium\ApiBundle\Service\ExceptionProcessingService;
use Zenium\AppBundle\Entity\QuestionCategory;
use Zenium\AppBundle\Tests\Integration\AbstractBaseIntegrationTest;
use Symfony\Component\Validator\Validator\RecursiveValidator;

/**
 * Class ExceptionProcessingServiceTestAbstract
 *
 * @package ApiBundle\Tests\Service
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
class ExceptionProcessingServiceTestAbstract extends AbstractBaseIntegrationTest
{
    /**
     * @var ExceptionProcessingService
     */
    protected $exceptionProcessingService;

    /**
     * @var RecursiveValidator
     */
    protected $validationService;

    public function setUp()
    {
        parent::setUp();

        $this->exceptionProcessingService = $this->getContainer()->get('api.exception_processing.service');
        $this->validationService          = $this->getContainer()->get('validator');
    }

    public function testProcessValidationErrorsIntoJsonArray()
    {
        $questionCategory = new QuestionCategory;
        $questionCategory->setName(null);

        $validationErrors           = $this->validationService->validate($questionCategory);
        $exportableValidationErrors = $this->exceptionProcessingService->processValidationErrorsIntoJsonArray($validationErrors);

        $this->assertInternalType('array', $exportableValidationErrors, 'Validation errors should be an array so that they can be serialized into JSON.');
        $this->assertCount(1, $exportableValidationErrors, 'There should only be one validation error in the test case.');
        $this->assertArrayHasKey('name', $exportableValidationErrors, 'The only validation error should be on the name.');
        $this->assertEquals('This value should not be blank.', $exportableValidationErrors['name'], 'The name key should contain the expected string.');
    }
}
