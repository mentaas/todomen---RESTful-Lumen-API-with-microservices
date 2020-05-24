<?php

namespace App\Traits;

use App\Utils\FormatApiResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

trait ConsumeExternalService
{
    /**
     * Send request to any service
     * @param $method
     * @param $requestUrl
     * @param array $formParams
     * @param array $headers
     * @return string
     */
    public function performRequest($method, $requestUrl, $formParams = [], $headers = [])
    {
        try{
            $client = new Client([
                'base_uri'  =>  $this->baseUri,
            ]);

            if(isset($this->secret))
            {
                $headers['Authorization'] = $this->secret;
                $headers['Authorization-Key'] = $this->userId;
            }

            $response = $client->request($method, $requestUrl, [
                'form_params' => $formParams,
                'headers'     => $headers,
            ]);
            return new FormatApiResponse($response->getBody()->getContents(), $response->getStatusCode());
        } catch (ClientException $e) {
            return new FormatApiResponse($e->getResponse()->getBody()->getContents(), $e->getResponse()->getStatusCode());
        }
    }
}
