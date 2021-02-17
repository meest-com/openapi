<?php

namespace Meest\OpenApi\Handlers;

use Meest\OpenApi\Includes\Handler;

class Search extends Handler
{
   public function __construct($token)
   {
       parent::__construct($token);
   }

    /**
     * Show the application dashboard.
     *
     * @param string countryID
     * @param string countryDescr
     *
     * @return array
     */
    public function country($data)
    {
        if (isset($data['countryID'])) {
            return $this->cache::remember("country:id:{$data['countryID']}", $this->cacheInterval, function () use ($data) {
                return $this->request->get('POST', $this->getUrl('urls.search.country'), [
                    'filters' => $data
                ]);
            });
        }

        return $this->request->get('POST', $this->getUrl('urls.search.country'), [
            'filters' => $data
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @param string regionID
     * @param string regionKATUU
     * @param string regionDescr
     * @param string countryID
     * @param string countryDescr
     *
     * @return array
     */
    public function region($data)
    {
        if (isset($data['regionID'])) {
            return $this->cache::remember("region:id:{$data['regionID']}", $this->cacheInterval, function () use ($data) {
                return $this->request->get('POST', $this->getUrl('urls.search.region'), [
                    'filters' => $data
                ]);
            });
        }

        return $this->request->get('POST', $this->getUrl('urls.search.region'), [
            'filters' => $data
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @param string districtID
     * @param string districtDescr
     * @param string regionID
     * @param string regionDescr
     * @param string districtKATUU
     *
     * @return array
     */
    public function district($data)
    {
        if (isset($data['districtID'])) {
            return $this->cache::remember("district:id:{$data['districtID']}", $this->cacheInterval, function () use ($data) {
                return $this->request->get('POST', $this->getUrl('urls.search.district'), [
                    'filters' => $data
                ]);
            });
        }

        return $this->request->get('POST', $this->getUrl('urls.search.district'), [
            'filters' => $data
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @param string cityID
     * @param string cityDescr
     * @param string countryID
     * @param string districtID
     * @param string districtDescr
     * @param string regionID
     * @param string regionDescr
     * @param string regionKATUU
     *
     * @return array
     */
    public function city($data)
    {
        if (isset($data['cityID'])) {
            return $this->cache::remember("city:id:{$data['cityID']}", $this->cacheInterval, function () use ($data) {
                return $this->request->get('POST', $this->getUrl('urls.search.city'), [
                    'filters' => $data
                ]);
            });
        }

        return $this->request->get('POST', $this->getUrl('urls.search.city'), [
            'filters' => $data
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @param integer zipCode
     *
     * @return array
     */
    public function zipCode($data)
    {
        return $this->request->get('GET', $this->getUrl('urls.search.zipCode'), [
            'filters' => $data
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @param string cityID
     * @param string addressDescr
     *
     * @return array
     */
    public function address($data)
    {
        return $this->request->get('POST', $this->getUrl('urls.search.address'), [
            'filters' => $data
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return array
     */
    public function types()
    {
        return $this->request->get('GET', $this->getUrl('urls.search.types'));
    }

    /**
     * Show the application dashboard.
     *
     * @param integer branchNo
     * @param string branchTypeID
     * @param string cityID
     * @param string cityDescr
     * @param string districtID
     * @param string districtDescr
     * @param string regionID
     * @param string regionDescr
     *
     * @return array
     */
    public function branch($data)
    {
        if (isset($data['branchID'])) {
            return $this->cache::remember("branch:id:{$data['branchID']}", 3600, function () use ($data) {
                return $this->request->get('POST', $this->getUrl('urls.search.branch'), [
                    'filters' => $data
                ]);
            });
        }

        return $this->request->get('POST', $this->getUrl('urls.search.branch'), [
            'filters' => $data
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @param $search search
     *
     * @return array
     */
    public function pudoSearchMWL($search)
    {
        return $this->request->get('GET', $this->getUrl('urls.search.pudoSearchMWL', [
            '{search}' => $search
        ]));
    }

    /**
     * Show the application dashboard.
     *
     * @param float latitude
     * @param float longitude
     *
     * @return array
     */
    public function terminal($data)
    {
        return $this->request->get('POST', $this->getUrl('urls.search.terminal'), [
            'filters' => $data
        ]);
    }

    /**
     * Get contract ID.
     *
     * @param float latitude
     * @param float longitude
     *
     * @return array
     */
    public function contract($data)
    {
        return $this->request->get('GET', $this->getUrl('urls.search.contract', null, [
            'email' => $data['email']
        ]));
    }
}
