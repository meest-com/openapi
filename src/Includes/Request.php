<?php

namespace Meest\OpenApi\Includes;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ConnectException;
use function GuzzleHttp\json_decode;

class Request
{
    private $client;
    private $config;
    private $logger;

    public function __construct($config)
    {
        $this->config = $config;
        $this->logger = $this->config->get('logger');
        $this->client = new Client();
    }

    /**
     * get cache data.
     *
     * @param $method
     * @param $url
     * @param $data
     * @param mixed $token
     * @return mixed
     * @throws Exception|RequestException|\GuzzleHttp\Exception\GuzzleException
     */
    public function get($method, $url, $data = [])
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
        if (($credential = $this->config->get('credential')) !== null) {
            $headers['token'] = $credential['token'];
        }

        try {
            $response = $this->client->request($method, $url, [
                'headers' => $headers,
                'json' => $data,
            ])
                ->getBody()
                ->getContents();

        } catch (ConnectException $e) {
            throw $e;
        } catch (BadResponseException $e) {
            if ($e->getCode() === 401) {
                (new Credential($this->config))->force();
            }

            $this->logger->error('get', [
                'url' => "$method: $url",
                'data' => $data,
                'message' => $e->getMessage()
            ]);

            throw new RequestException($e);
        }

        $response = json_decode($response, true);

        if ($response['status'] === 'OK') {
            return $response['result'];
        }

        return null;
    }

    /**
     * get cache data.
     *
     * @param $method
     * @param $url
     * @param $data
     * @param mixed $token
     * @return mixed
     * @throws Exception|\GuzzleHttp\Exception\GuzzleException
     */
    public function stream($url)
    {
        try {
            $context = stream_context_create([
                "http" => [
                    "method" => "GET",
                    "header" => ($credential = $this->config->get('credential')) !== null ? "token: {$credential['token']}\r\n" : null
                ]
            ]);
            $response = file_get_contents($url, 'rb', $context);
        } catch (\ErrorException $e) {
            if ($e->getCode() === 401) {
                (new Credential($this->config))->force();
            }

            $this->logger->error('streem', [
                'url' => "GET: $url",
                'message' => $e->getMessage()
            ]);

            throw new RequestException($e);
        }

        return $response ?? null;
    }
}
