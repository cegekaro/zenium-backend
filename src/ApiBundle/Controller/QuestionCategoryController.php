<?php

namespace ApiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Describes the API functionality for interacting with Question Categories.
 *
 * @package ApiBundle\Controller
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
class QuestionCategoryController extends Controller implements ApiControllerInterface
{
    /**
     * Create a new entry into the system.
     *
     * @Route("/question-category/", name="api.question_category.create")
     * @Method({"POST"})
     *
     * @return string
     */
    public function createAction()
    {
        $data = [
            'id' => 1,
            'name' => 'OOP',
        ];
        $data = json_encode($data);

        return new Response($data);
    }

    /**
     * Update one of the entries in the system.
     *
     * @param int $id The ID of the entry.
     *
     * @Route("/question-category/{id}", name="api.question_category.update")
     * @Method({"PUT", "PATCH"})
     *
     * @return string
     */
    public function updateAction($id)
    {
        // TODO: Implement updateAction() method.
    }

    /**
     * Delete one of the entries in the system.
     *
     * @param int $id The ID of the entry.
     *
     * @Route("/question-category/{id}", name="api.question_category.delete")
     * @Method({"DELETE"})
     *
     * @return string
     */
    public function deleteAction($id)
    {
        // TODO: Implement deleteAction() method.
    }

    /**
     * Retrieve one of the entries in the system.
     *
     * @param int $id The ID of the entry.
     *
     * @Route("/question-category/", name="api.question_category.get")
     * @Method({"GET"})
     *
     * @return string
     */
    public function getAction($id)
    {
        // TODO: Implement getAction() method.
    }

    /**
     * List all of the entries in the system
     *
     * @Route("/question-category/", name="api.question_category.list")
     * @Method({"GET"})
     *
     * @return string
     */
    public function listAction()
    {
        // TODO: Implement listAction() method.
    }

}
