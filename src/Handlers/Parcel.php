<?php

namespace Meest\OpenApi\Handlers;

use Meest\OpenApi\Includes\Handler;

class Parcel extends Handler
{
    public function __construct($token)
    {
        parent::__construct($token);
    }

    /**
     * Get parsel info.
     *
     * @param string $uuid
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function show($uuid)
    {
        return $this->request->get('GET', $this->getUrl('urls.parcel.show', [
            '{parcelID}' => $uuid
        ]));
    }

    /**
     * Get parsel info.
     *
     * @param string $uuid
     * @param string $field [parcelID, barCode, parcelNumber]
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get($uuid, $field = 'parcelID')
    {
        return $this->request->get('GET', $this->getUrl('urls.parcel.get', [
            '{parcelID}' => $uuid,
            '{searchMode}' => $field
        ]));
    }

    /**
     * Show the application dashboard.
     *
     * @param array $data
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function calculate($data)
    {
        return $this->request->get('POST', $this->getUrl('urls.parcel.calculate'), $data);
    }

    /**
     * Show the application dashboard.
     *
     * @param array $data
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create($data)
    {
        return $this->request->get('POST', $this->getUrl('urls.parcel.create'), $data);
    }

    /**
     * Show the application dashboard.
     *
     * @param $uuid
     * @param $data
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update($uuid, $data)
    {
        return $this->request->get('PUT', $this->getUrl('urls.parcel.update', [
            '{parcelID}' => $uuid
        ]), $data);
    }

    /**
     * Show the application dashboard.
     *
     * @param $uuid
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($uuid)
    {
        return $this->request->get('DELETE', $this->getUrl('urls.parcel.delete', [
            '{parcelID}' => $uuid
        ]));
    }
}
