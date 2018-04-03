<?php
/**
 *
 * No part of the materials protected by this copyright
 * may be reproduced,in whole or in part, in any form or by
 * any means, digital or mechanical, including photocopy, recording,
 * and broadcasting, without the written consent of Mobilozophy, LLC.
 *
 * © 2018. Mobilozophy, LLC.  All Rights Reserved.
 *
 */

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
