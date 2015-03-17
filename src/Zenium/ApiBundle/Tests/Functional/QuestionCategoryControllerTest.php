<?php


namespace Zenium\ApiBundle\Tests\Functional;

/**
 * Used for testing the Question Category Controller.
 *
 * @package Zenium\ApiBundle\Tests\Functional
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
class QuestionCategoryControllerTest extends AbstractApiControllerTest
{
    /**
     * Retrieve the URL path of the controller.
     * Used in order to generate paths for the request tests.
     * Example: "question-category/" is used in order to generate:
     * http://localhost/api/question-category/
     *
     * Remember to add a trailing space!
     *
     * @return string
     */
    public function getUrlPath()
    {
        return 'question-category/';
    }

    /**
     * Get the data to create a valid request.
     *
     * @return string
     */
    protected function getCreateMockData()
    {
        return $this->readMockFile('question_category.create.request.json');
    }

    /**
     * Get the data to make a valid update request.
     *
     * @return string
     */
    protected function getUpdateMockData()
    {
        return $this->readMockFile('question_category.update.request.json');
    }

    /**
     * Verify the data that was retrieved after making a create request.
     *
     * @param array $responseData The data retrieved, after decoding it from JSON into an array.
     *
     * @return mixed
     */
    protected function verifyCreateResponse(array $responseData)
    {
        $this->assertArrayHasKey('id', $responseData, 'Expected the entity to have an ID field.');
        $this->assertArrayHasKey('name', $responseData, 'Expected the entity to have a name.');

        $this->assertEquals('Agile', $responseData['name'], 'Expected the name to match the value in the mock file.');
        $this->assertNotNull($responseData['id'], 'Expected ID to not be null');
    }

    /**
     * Verify the data that was retrieved after making an update request.
     *
     * @param array $responseData The data retrieved, after decoding it from JSON into an array.
     *
     * @return mixed
     */
    protected function verifyUpdateResponse(array $responseData)
    {
        $this->assertArrayHasKey('id', $responseData, 'Expected the entity to have an ID field.');
        $this->assertArrayHasKey('name', $responseData, 'Expected the entity to have a name.');

        $this->assertEquals('Update test', $responseData['name'], 'Expected the name to match the value in the mock file.');
        $this->assertEquals(2, $responseData['id'], 'Wrong ID returned for update operation, it seems that a new entry was persisted.');
    }

    /**
     * Verify the data that was retrieved after making a retrieve request.
     *
     * @param array $responseData The data retrieved, after decoding it from JSON into an array.
     *
     * @return mixed
     */
    protected function verifyRetrieveResponse(array $responseData)
    {
        $this->verifyUpdateResponse($responseData);
    }

    /**
     * Verify the data that was retrieved after making a list request.
     *
     * @param array $responseData The data retrieved, after decoding it from JSON into an array.
     *
     * @return mixed
     */
    protected function verifyListResponse(array $responseData)
    {
        $this->assertInternalType('array', $responseData);
        $this->assertGreaterThan(1, $responseData);
    }


}
