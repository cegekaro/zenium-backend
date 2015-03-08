<?php


namespace ApiBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Interface governing the required methods for the Entities in the system.
 *
 * @package ApiBundle\Controller
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
interface ApiControllerInterface
{
    /**
     * Create a new entry into the system.
     *
     * @Method({"POST"})
     *
     * @return string
     */
    public function createAction();

    /**
     * Update one of the entries in the system.
     *
     * @param int $id The ID of the entry.
     *
     * @Method({"PUT", "PATCH"})
     *
     * @return string
     */
    public function updateAction($id);

    /**
     * Delete one of the entries in the system.
     *
     * @param int $id The ID of the entry.
     *
     * @Method({"DELETE"})
     *
     * @return string
     */
    public function deleteAction($id);

    /**
     * Retrieve one of the entries in the system.
     *
     * @param int $id The ID of the entry.
     *
     * @Method({"GET"})
     *
     * @return string
     */
    public function getAction($id);

    /**
     * List all of the entries in the system
     *
     * @Method({"GET"})
     *
     * @return string
     */
    public function listAction();
}
