<?php

namespace Meest\OpenApi\Includes;

class Cache
{
    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * set cache data.
     *
     * @param $data
     * @return void
     * @throws \Exception
     */
    public function set($data)
    {
        //try {
            self::checkDir($this->file);

            file_put_contents($this->file, json_encode($data));
        //} catch (\Exception $e) {
        //    throw new \Exception('Error save credentials');
        //}
    }

    /**
     * get cache data.
     *
     * @return mixed
     * @throws \Exception
     */
    public function get()
    {
        return json_decode(file_get_contents($this->file), true);
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
}
