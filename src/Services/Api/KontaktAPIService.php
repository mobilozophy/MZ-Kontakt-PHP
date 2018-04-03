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

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use function GuzzleHttp\Psr7\str;
use InvalidArgumentException;

class KontaktAPIService extends AbstractAPIService
{

    /**
     * Send a request to add a new resource.
     *
     * @param Credentials $credentials
     * @param array $params
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function add(Credentials $credentials, array $params)
    {
        $requestUrl = $this->getEndpointRequestUrl();

            return $this->httpClient->post(
                $requestUrl,
                $this->generateOptions($credentials,
                    [
                        'form_params' => $params,
                    ]
                )
            );

    }

    /**
     * Send a request to update a resource
     *
     * @param Credentials $credentials
     * @param             $id
     * @param array       $params
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function update(Credentials $credentials, $id, array $params)
    {
        $requestUrl = $this->getEndpointRequestUrl($id);

        return $this->httpClient->put(
            $requestUrl,
            $this->generateOptions($credentials,
                [
                    'form_params' => $params,
                ]
            )
        );

    }

    /**
     * Send a request to retrieve a resource.
     *
     * @param Credentials $credentials
     * @param string $id
     * @param string $include
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get(Credentials $credentials, $id, $include=[])
    {
        $includesImplode  = implode(',',$include);

        $includeAddOn = ((!is_null($includesImplode) && $includesImplode!='')?"?include=$includesImplode":'');
        $requestUrl = $this->getEndpointRequestUrl($id).$includeAddOn;
        return $this->httpClient->get(
            $requestUrl,
            $this->generateOptions($credentials)
        );

    }


    /**
     * Send a request to retrieve all resources.
     *
     * @param Credentials $credentials
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getAll(Credentials $credentials, $include=[])
    {
        $queryString='';
        if ($include)
        {
            $queryString='?'.http_build_query($include);
        }
        $requestUrl = $this->getEndpointRequestUrl().$queryString;

        return $this->httpClient->get(
            $requestUrl,
            $this->generateOptions($credentials)
        );

    }


    /**
     * Send a request to delete a resource
     * .
     * @param Credentials $credentials
     * @param string $id
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function delete(Credentials $credentials, $id)
    {
        $requestUrl = $this->getEndpointRequestUrl($id);
        return $this->httpClient->delete(
            $requestUrl,
            $this->generateOptions($credentials)
        );
    }


    /**
     * Get base API request URL with additional segments.
     *
     * @param mixed $segments Segments of the URL
     *
     * @return string
     */
    protected function getBaseRequestUrl($segments = null)
    {
        if (is_array($segments)) {
            $segments = implode('/', $segments);
        }

        $baseUrl = env('KONTAKT_BASEURL');

        return $baseUrl . '/' . $segments;
    }

    protected function generateOptions(Credentials $credentials, $options = null)
    {

        $base = [
            'headers' => $credentials->getHeaders()
        ];

        if (isset($options)) {
            $base = array_merge($base, $options);
        }

        //Check if we need to proxy the request; really only to be used in a development environement
        if (env('PROXY_REQUESTS_IP_PORT', false)) {
            if ( is_bool(env('PROXY_REQUESTS_IP_PORT', false)) ){
                $address = gethostbyname(trim(exec("hostname"))).':8888';
            }else
            {
                $address = env('PROXY_REQUESTS_IP_PORT');
            }
            $proxy = [
                'proxy' => 'http://' . $address,
            ];
            $base = array_merge($base, $proxy);
        }

        return $base;

    }
}
