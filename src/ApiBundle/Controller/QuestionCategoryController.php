<?php

namespace ApiBundle\Controller;

use ApiBundle\Service\AbstractEntityService;
use AppBundle\Exception\ZeniumException;
use AppBundle\Manager\AbstractManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Describes the API functionality for interacting with Question Categories.
 *
 * @package ApiBundle\Controller
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
class QuestionCategoryController extends AbstractApiController
{
    /**
     * @return AbstractManager
     */
    public function getEntityManager()
    {
        return $this->get('app.question_category.manager');
    }

    /**
     * Retrieve the entity service.
     *
     * @return AbstractEntityService
     */
    public function getEntityService()
    {
        return $this->get('api.question_category.service');
    }

    /**
     * Create a new entry into the system.
     *
     * @Route("/question-category/", name="api.question_category.create")
     * @Method({"POST"})
     *
     * @param Request $request
     *
     * @return string
     * @throws ZeniumException
     */
    public function createAction(Request $request)
    {
        return parent::createAction($request);
    }

    /**
     * Update one of the entries in the system.
     *
     * @param Request $request
     * @param int     $id The ID of the entry.
     *
     * @Route("/question-category/{id}", name="api.question_category.update")
     * @Method({"PUT", "PATCH"})
     *
     * @return string
     */
    public function updateAction(Request $request, $id)
    {
        return parent::updateAction($request, $id);
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
        return parent::deleteAction($id);
    }

    /**
     * Retrieve one of the entries in the system.
     *
     * @param int $id The ID of the entry.
     *
     * @Route("/question-category/{id}", name="api.question_category.get")
     * @Method({"GET"})
     *
     * @return string
     */
    public function getAction($id)
    {
        return parent::getAction($id);
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
        return parent::listAction();
    }

}
