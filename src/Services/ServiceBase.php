<?php
namespace Mobilozophy\Kontakt\Services;
use Mobilozophy\Kontakt\Services\Api\Credentials;
use function GuzzleHttp\default_user_agent;


/**
 * Class ServiceBase
 * @author Jeffrey Wray <jwray@mobilozophy.com>
 * @package Mobilozophy\Kontakt\Services
 */
class ServiceBase
{
    use UsesCredentialsTrait;

    protected $apiService;


    /**
     * @param array $data Data to be submitted
     * @param null|string $account_uuid The account id of the account to perform this call on.
     * @param bool|string $scope The scope to apply to call (ex. with-children will scope to all child accounts).
     * @param array $otherHeaders Other headers to apply to call.
     * @return bool|mixed
     */
    public function add(array $data, $account_uuid = null, $scope = false, $otherHeaders=[])
    {

        $response = $this->apiService->add(
            $this->getSubAccountCredentials($account_uuid,$scope,$otherHeaders), $data
        );
        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody()->getContents());
        } else
        {
            return false;
        }
    }


    /**
     * @param string $id Id (UUID) of the record to be updated.
     * @param array $data Data to be submitted.
     * @param null|string $account_uuid The account id of the account to perform this call on.
     * @param bool|string $scope The scope to apply to call (ex. with-children will scope to all child accounts).
     * @param array $otherHeaders Other headers to apply to call.
     * @return bool|mixed
     */
    public function update($id, array $data, $account_uuid = null, $scope = false, $otherHeaders=[])
    {

        $response = $this->apiService->update(
            $this->getSubAccountCredentials($account_uuid,$scope, $otherHeaders), $id, $data, $account_uuid
        );
        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody()->getContents());
        } else
        {
            return false;
        }
    }


    /**
     * @param string $id Id (UUID) of the record to be retrieved.
     * @param null|string $account_uuid The account id of the account to perform this call on.
     * @param bool|string $scope The scope to apply to call (ex. with-children will scope to all child accounts).
     * @param array $otherHeaders Other headers to apply to call.
     * @param null|array|string $include Related items to include in response.
     * @return bool|mixed
     */
    public function get($id,$account_uuid = null, $scope = false, $otherHeaders=[], $include=null)
    {

        if(is_string($include))
        {
            $includeArray = explode(',',$include);
        }
        elseif (!is_array($include))
        {
            $includeArray = [];
        }
        elseif (is_array($include))
        {
            $includeArray = $include;
        }

        try {
            $response = $this->apiService->get(
                $this->getSubAccountCredentials($account_uuid,$scope, $otherHeaders), $id,$includeArray
            );
            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody()->getContents());
            } else {
                return false;
            }
        } catch (\Exception $e)
        {
            return false;
        }
    }


    /**
     * @param null|string $account_uuid The account id of the account to perform this call on.
     * @param bool|string $scope The scope to apply to call (ex. with-children will scope to all child accounts).
     * @param array $otherHeaders Other headers to apply to call.
     * @return bool|mixed
     */
    public function getall($account_uuid = null, $scope = false, $otherHeaders=[])
    {
        $response = $this->apiService->getAll(
            $this->getSubAccountCredentials($account_uuid,$scope, $otherHeaders)
        );
        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody()->getContents());
        } else
        {
            return false;
        }
    }


    /**
     * @param string $id Id (UUID) of the record to be deleted.
     * @param null|string $account_uuid The account id of the account to perform this call on.
     * @param bool|string $scope The scope to apply to call (ex. with-children will scope to all child accounts).
     * @param array $otherHeaders Other headers to apply to call.
     * @return bool|mixed
     */
    public function delete($id, $account_uuid = null, $scope = false, $otherHeaders=[])
    {
        $response = $this->apiService->delete(
            $this->getSubAccountCredentials($account_uuid,$scope, $otherHeaders), $id
        );
        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody()->getContents());
        } else
        {
            return false;
        }
    }


    /**
     * Get Account Credentials for API Calls
     * @param null|string $account The account id of the account to perform this call on.
     * @param bool|string $scope The scope to apply to call (ex. with-children will scope to all child accounts).
     * @param array $otherHeaders Other headers to apply to call.
     * @return Credentials
     */
    public function getSubAccountCredentials($kontakt_api_key, $otherHeaders = array())
    {

        $version = '9';

        $headers =             [
            'Accept'        => 'application/vnd.com.kontakt+json;version=' . $version,
            'Api-Key'       => $kontakt_api_key,
            'User-Agent'    => 'mzcapi/kontakt' . default_user_agent()
        ];

        $headers = array_merge($headers, $otherHeaders);

        return new Credentials(
            $headers
        );
    }

    /**
     * @param $exception
     * @return string
     */
    protected function handleErrorException($exception)
    {
        $responseBody = $exception->getResponse()->getBody()->getContents();
        $exceptionCode = $exception->getCode();
        $responseJsonDecode = json_decode($responseBody,true);
        unset($responseJsonDecode['error']['debug']);
        return json_encode($responseJsonDecode);

    }
}