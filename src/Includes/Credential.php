<?php

namespace Meest\OpenApi\Includes;

use Meest\OpenApi\Handlers\Auth;
use function GuzzleHttp\{json_encode, json_decode};

class Credential
{
    private $config;
    private $auth;

    public function __construct($config)
    {
        $this->config = $config;

        $this->auth = new Auth($config);
    }

    /**
     * set cache data.
     *
     * @param $data
     * @return void
     * @throws \Exception
     */
    public function save($data)
    {
        $file = $this->config->get('credential_file');

        try {
            self::checkDir($file);

            file_put_contents($file, json_encode($data));
        } catch (\Exception $e) {
            throw new \Exception('Error save credentials');
        }
    }

    /**
     * get cache data.
     *
     * @return mixed
     * @throws \Exception
     */
    public function load()
    {
        $file = $this->config->get('credential_file');

        return json_decode(file_get_contents($file), true);
    }

    /**
     * get cache data.
     *
     * @param $path
     * @return void
     */
    public static function checkDir($path)
    {
        if (!file_exists($dir = pathinfo($path)['dirname'])) {
            mkdir($dir, 0777, true);
        }
    }

    /**
     * force token.
     *
     * @return void
     * @throws \Exception
     */
    public function force()
    {
        $credential = $this->auth->create();
        $this->save($credential);
        $this->config->set('credential', $credential);
    }

    /**
     * cache token.
     *
     * @return void
     * @throws \Exception
     */
    public function cache()
    {
        try {
            $credential = $this->load();
            $credential = $this->check($credential);
        } catch (\Exception $e) {
            $credential = $this->auth->create();
            $this->save($credential);
        }

        $this->config->set('credential', $credential);
    }

    /**
     * check token expires.
     *
     * @param $time
     * @return bool
     */
    private function isExpired($time): bool
    {
        return (int) date('U') >= $time;
    }

    /**
     * check token expires.
     *
     * @param $credential
     * @return array
     * @throws \Exception
     */
    private function check($credential)
    {
        if ($this->isExpired($credential['expiresIn'])) {
            $credential = $this->auth->refresh($credential['refreshToken']);

            $this->save($credential);
        }

        return $credential;
    }
}
