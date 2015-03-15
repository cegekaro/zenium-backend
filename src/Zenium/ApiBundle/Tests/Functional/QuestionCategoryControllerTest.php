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
     * Example: "question-category" is used in order to generate:
     * http://localhost/api/question-category/
     *
     * @return string
     */
    public function getUrlPath()
    {
        return 'question-category';
    }

}
