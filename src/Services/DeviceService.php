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

use Mobilozophy\Kontakt\Services\Api\Services\DeviceAPIService;
use Mobilozophy\Kontakt\Services\ServiceBase;

/**
 * Class RegionService
 * @package Mobilozophy\Kontakt\Services\Beacon
 */
class DeviceService extends ServiceBase
{

    /**
     * RegionService constructor.
     *
     * @param RegionAPIService $regionAPIService
     */
    public function __construct(DeviceAPIService $APIService) {
        $this->apiService = $APIService;
    }

}
