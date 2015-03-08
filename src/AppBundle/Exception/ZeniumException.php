<?php


namespace AppBundle\Exception;

/**
 * Base Exception in the Zenium package.
 *
 * @package ApiBundle\Exception
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
class ZeniumException extends \Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
