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

namespace Mobilozophy\Kontakt\Services\Api\Services;

use Mobilozophy\Kontakt\Services\Api\Credentials;
use Mobilozophy\Kontakt\Services\Api\KontaktAPIService;

class ConfigAPIService extends KontaktAPIService
{
    const ENDPOINT = 'config';

    /**
     * Send a request to add a new resource.
     *
     * @param Credentials $credentials
     * @param array $params
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function create(Credentials $credentials, array $params)
    {
        $requestUrl = $this->getEndpointRequestUrl().'/create';

        return $this->httpClient->post($requestUrl, [
            'headers'     => $credentials->getHeaders(),
            'form_params' => $params,
        ]);

    }
}
