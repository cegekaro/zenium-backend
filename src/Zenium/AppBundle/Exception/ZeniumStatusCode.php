<?php


namespace Zenium\AppBundle\Exception;

/**
 * Contains all of the status code that the API can return.
 *
 * @package AppBundle\Exception
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
class ZeniumStatusCode
{
    const REQUEST_SUCCESSFUL = 200;
    const INVALID_DATA = 400;
    const RESOURCE_NOT_FOUND = 404;
}
