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
     * Calculate export delivery cost.
     *
     * @param array $data
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function calculateExport(array $data)
    {
        return $this->request->get('POST', $this->getUrl('urls.export.calculateExport'), $data);
    }

    /**
     * Calculate standard delivery cost.
     *
     * @param array $data
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function calculateStandard(array $data)
    {
        return $this->request->get('POST', $this->getUrl('urls.export.calculateStandard'), $data);
    }
	
    /**
     * Calculate standard delivery cost.
     *
     * @param array $data
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function calculateStandardIoss(array $data)
    {
        return $this->request->get('POST', $this->getUrl('urls.export.calculateStandardIoss'), $data);
    }
}
