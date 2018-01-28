<?php

namespace Mobilozophy\Kontakt\Services;

use Mobilozophy\Kontakt\Services\Api\Redemption\RegionAPIService;
use Mobilozophy\Kontakt\Services\ServiceBase;

/**
 * Class RegionService
 * @package Mobilozophy\Kontakt\Services\Beacon
 */
class RegionService extends ServiceBase
{

    /**
     * RegionService constructor.
     *
     * @param RegionAPIService $regionAPIService
     */
    public function __construct(RegionAPIService $regionAPIService) {
        $this->apiService = $regionAPIService;
    }

}
