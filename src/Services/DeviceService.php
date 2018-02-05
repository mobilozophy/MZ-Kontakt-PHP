<?php

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
