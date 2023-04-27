<?php

namespace Meest\OpenApi\Handlers;

use Meest\OpenApi\Includes\Handler;

class Export extends Handler
{
    public function __construct($token)
    {
        parent::__construct($token);
    }

    /**
     * Get list of services.
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function service()
    {
        return $this->request->get('POST', $this->getUrl('urls.export.service'), ['search' => 'all']);
    }

    /**
     * Calculate delivery cost.
     *
     * @param array $data
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function calculate(array $data)
    {
        return $this->request->get('POST', $this->getUrl('urls.export.calculate'), $data);
    }
}
