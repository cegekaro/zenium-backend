<?php

namespace Zenium\ApiBundle\Controller;

use Zenium\ApiBundle\Service\AbstractEntityService;
use Zenium\AppBundle\Exception\ZeniumException;
use Zenium\AppBundle\Manager\AbstractManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Describes the API functionality for interacting with Questions.
 *
 * @package ApiBundle\Controller
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
class QuestionController extends AbstractApiController
{
    /**
     * @return AbstractManager
     */
    public function getEntityManager()
    {
        return $this->get('zenium.app.question.manager');
    }

    /**
     * Retrieve the entity service.
     *
     * @return AbstractEntityService
     */
    public function getEntityService()
    {
        return $this->get('zenium.api.question.service');
    }

    /**
     * Create a new entry into the system.
     *
     * @Route("/question/", name="api.question.create")
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
     * @Route("/question/{id}", name="api.question.update")
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
     * @Route("/question/{id}", name="api.question.delete")
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
     * @Route("/question/{id}", name="api.question.get")
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
     * @Route("/question/", name="api.question.list")
     * @Method({"GET"})
     *
     * @return string
     */
    public function listAction()
    {
        return parent::listAction();
    }

}
