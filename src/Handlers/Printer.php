<?php

namespace Meest\OpenApi\Handlers;

use Meest\OpenApi\Includes\Handler;

class Printer extends Handler
{
    public function __construct($token)
    {
        parent::__construct($token);
    }

    /**
     * Get parsel info.
     *
     * @param $uuid
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sticker100($uuid)
    {
        return $this->request->stream($this->getUrl('urls.print.sticker100', [
            '{printValue}' => $uuid
        ]));
    }

    /**
     * Get parsel info.
     *
     * @param $uuid
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function declaration($uuid, $type = 'pdf')
    {
        return $this->request->stream($this->getUrl('urls.print.declaration', [
            '{printValue}' => $uuid,
            '{contentType}' => $type,
        ]));
    }

    /**
     * Get parsel info.
     *
     * @param $uuid
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function cn23($uuid, $type = 'pdf')
    {
        return $this->request->stream($this->getUrl('urls.print.cn23', [
            '{printValue}' => $uuid,
            '{contentType}' => $type,
        ]));
    }
}
