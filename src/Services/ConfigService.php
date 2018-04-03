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

use Mobilozophy\Kontakt\Services\Api\Services\ConfigAPIService;
use Mobilozophy\Kontakt\Services\ServiceBase;

/**
 * Class RegionService
 * @package Mobilozophy\Kontakt\Services\Beacon
 */
class ConfigService extends ServiceBase
{

    /**
     * RegionService constructor.
     *
     * @param RegionAPIService $regionAPIService
     */
    public function __construct(ConfigAPIService $APIService) {
        $this->apiService = $APIService;
    }



    /**
     * @param array $data Data to be submitted
     * @param null|string $kontakt_api_key The account id of the account to perform this call on.
     * @param bool|string $scope The scope to apply to call (ex. with-children will scope to all child accounts).
     * @param array $otherHeaders Other headers to apply to call.
     * @return bool|mixed
     */
    public function create(array $data, $kontakt_api_key = null, $otherHeaders=[])
    {

        $response = $this->apiService->add(
            $this->getSubAccountCredentials($kontakt_api_key,$otherHeaders), $data
        );
        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody()->getContents());
        } else
        {
            return false;
        }
    }

}
