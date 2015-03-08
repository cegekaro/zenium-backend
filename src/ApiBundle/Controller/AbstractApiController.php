<?php


namespace ApiBundle\Controller;

use ApiBundle\Service\AbstractEntityService;
use AppBundle\Exception\ZeniumException;
use AppBundle\Exception\ZeniumStatusCode;
use AppBundle\Manager\AbstractManager;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Governs the required methods for the Entities in the system.
 *
 * @package ApiBundle\Controller
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
abstract class AbstractApiController extends Controller
{
    /**
     * Create a new entry into the system.
     *
     * @Method({"POST"})
     *
     * @param Request $request
     *
     * @return string
     * @throws ZeniumException
     */
    public function createAction(Request $request)
    {
        $jsonData    = $request->getContent();
        $requestData = json_decode($jsonData, true);

        $entity           = $this->getEntityService()->createFromArray($requestData);
        $validationErrors = $this->get('validator')->validate($entity);

        if (count($validationErrors) > 0) {
            $validationErrors = $this->get('api.exception_processing.service')->processValidationErrorsIntoJsonArray($validationErrors);
            throw new ZeniumException('Entity does not validate correctly.', ZeniumStatusCode::INVALID_DATA, $validationErrors);
        }

        $this->getManager()->persist($entity);
        $this->getManager()->flush();

        $serializedEntity = $this->get('serializer')->serialize($entity, $this->getSerializationFormat());

        return new Response($serializedEntity);
    }

    /**
     * Update one of the entries in the system.
     *
     * @param int $id The ID of the entry.
     *
     * @Method({"PUT", "PATCH"})
     *
     * @return string
     */
    abstract public function updateAction(Request $request, $id);

    /**
     * Delete one of the entries in the system.
     *
     * @param int $id The ID of the entry.
     *
     * @Method({"DELETE"})
     *
     * @return string
     */
    abstract public function deleteAction($id);

    /**
     * Retrieve one of the entries in the system.
     *
     * @param int $id The ID of the entry.
     *
     * @Method({"GET"})
     *
     * @return string
     */
    abstract public function getAction($id);

    /**
     * List all of the entries in the system
     *
     * @Method({"GET"})
     *
     * @return string
     */
    abstract public function listAction();

    /**
     * @return ObjectManager
     */
    public function getManager()
    {
        return $this->get('doctrine')->getManager();
    }

    /**
     * Retrieve the manager service of the Entity.
     *
     * @return AbstractManager
     */
    abstract public function getEntityManager();

    /**
     * Retrieve the entity service.
     *
     * @return AbstractEntityService
     */
    abstract public function getEntityService();

    /**
     * Retrieve the serialization format for the entities.
     *
     * @return string
     */
    public function getSerializationFormat()
    {
        return 'json';
    }
}
