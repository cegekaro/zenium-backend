<?php


namespace Zenium\ApiBundle\Controller;


use Symfony\Component\HttpFoundation\Response;

/**
 * Class ZeniumResponse
 *
 * @package Zenium\ApiBundle\Controller
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
class ZeniumResponse extends Response
{
    public function __construct($content = '', $status = 200)
    {
        $headers = [
            'Content-Type' => 'application/json',
        ];

        parent::__construct($content, $status, $headers);
    }
}
