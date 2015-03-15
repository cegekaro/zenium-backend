<?php


namespace Zenium\ApiBundle\Features\Context;


use Behat\Symfony2Extension\Context\KernelAwareContext;
use Guzzle\Http\Client;
use Guzzle\Http\Message\Response;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class BaseApiFeature
 *
 * @package ApiBundle\Features\Context
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
class BaseApiFeature implements KernelAwareContext
{
    /**
     * @var string
     */
    protected $requestData;

    /**
     * @var Response
     */
    protected $responseData;

    /**
     * @var KernelInterface
     */
    protected $kernel;

    /**
     * @var Client
     */
    protected $guzzleClient;

    public function __construct($host)
    {
        $this->setGuzzleClient(new Client);
        $this->getGuzzleClient()->setBaseUrl($host);
    }

    /**
     * Read a file from Behat's API mocks.
     *
     * @param string $fileName
     *
     * @return string
     */
    public function readFile($fileName)
    {
        $filepath    = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Resources' . DIRECTORY_SEPARATOR . $fileName;
        $fileContent = @file_get_contents($filepath);

        if (false === $fileContent) {
            throw new \InvalidArgumentException("Requested Behat file {$filepath} does not exist.");
        }

        return $fileContent;
    }

    /**
     * @return string
     */
    public function getRequestData()
    {
        return $this->requestData;
    }

    /**
     * @param string $requestData
     *
     * @return $this
     */
    public function setRequestData($requestData)
    {
        $this->requestData = $requestData;

        return $this;
    }

    /**
     * Sets Kernel instance.
     *
     * @param KernelInterface $kernel
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @return KernelInterface
     */
    public function getKernel()
    {
        return $this->kernel;
    }

    /**
     * @return Client
     */
    public function getGuzzleClient()
    {
        return $this->guzzleClient;
    }

    /**
     * @param Client $guzzleClient
     *
     * @return $this
     */
    public function setGuzzleClient($guzzleClient)
    {
        $this->guzzleClient = $guzzleClient;

        return $this;
    }

    /**
     * @return Response
     */
    public function getResponseData()
    {
        return $this->responseData;
    }

    /**
     * @param Response $responseData
     *
     * @return $this
     */
    public function setResponseData($responseData)
    {
        $this->responseData = $responseData;

        return $this;
    }


}
