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
    /**
     * @var array
     */
    protected $extraInformation;

    public function __construct($message, $code = 400, $extraInformation = [])
    {
        parent::__construct($message, $code);

        $this->extraInformation = $extraInformation;
    }

    /**
     * @return array
     */
    public function getExtraInformation()
    {
        return $this->extraInformation;
    }

    /**
     * @param array $extraInformation
     *
     * @return $this
     */
    public function setExtraInformation($extraInformation)
    {
        $this->extraInformation = $extraInformation;

        return $this;
    }


}
