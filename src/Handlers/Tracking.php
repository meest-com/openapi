<?php

namespace Meest\OpenApi\Handlers;

use Meest\OpenApi\Includes\Handler;

class Tracking extends Handler
{
    public function __construct($token)
    {
        parent::__construct($token);
    }

    /**
     * Parcel tracking.
     *
     * @param string $number
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get($number)
    {
        return $this->request->get('GET', $this->getUrl('urls.tracking.get', [
            '{trackNumber}' => $number
        ]));
    }

    /**
     * Parcel tracking.
     *
     * @param string $number
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function byNumber($number)
    {
        if (empty($number)) {
            return [];
        }

        return $this->request->get('GET', $this->getUrl('urls.tracking.byNumber', [
            '{trackNumber}' => $number
        ]));
    }
}
