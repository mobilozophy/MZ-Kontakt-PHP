<?php

namespace Mobilozophy\Kontakt\Services\Api;

/**
 * Class Credentials
 * @author Jeffrey Wray <jwray@mobilozophy.com>
 * @package Mobilozophy\Kontakt\Services\Api
 */
class Credentials
{
    public $headers;

    /**
     * Credentials constructor.
     * @param $username
     * @param $password
     * @param array $headers
     */
    public function __construct($headers = array())
    {
        $this->headers  = $headers;
    }

    /**
     * @return array
     */
    public function getHeaders() {
        return $this->headers;
    }
}
