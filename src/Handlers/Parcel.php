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
    public function get($uuid, $field = 'parcelID', $type = null)
    {
        return $this->request->get('GET', $this->getUrl('urls.parcel.get', [
            '{parcelID}' => $uuid,
            '{searchMode}' => $field,
            '{returnMode}' => $type
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
    public function delete($parcelUuid, $contractUuid)
    {
        return $this->request->get('DELETE', $this->getUrl('urls.parcel.delete', [
            '{parcelID}' => $parcelUuid,
            '{contractID}' => $contractUuid
        ]));
    }

    /**
     * Show the application dashboard.
     *
     * @param $uuid
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sticker($uuid)
    {
        $arr = explode('-', strtolower($uuid));

        $result = $this->request->get('GET', $this->getUrl('urls.parcel.sticker', [
            '{parcelID}' => '0x' . $arr[3] . $arr[4] . $arr[2] . $arr[1] . $arr[0]
        ]));

        return $result[0] ?? null;
    }
}
