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

namespace Mobilozophy\Kontakt\Services;

use Mobilozophy\Kontakt\Services\Api\Credentials;

/**
 * Trait UsesCredentialsTrait
 * @package Mobilozophy\Kontakt\Services
 */
trait UsesCredentialsTrait
{
    private $credentials;

    /**
     * @param Credentials $credentials
     */
    public function setCredentials(Credentials $credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * @return mixed
     */
    protected function getCredentials()
    {
        if ( ! $this->credentials) {
            throw new MissingCredentialsException;
        }
        
        return $this->credentials;
    }
}
