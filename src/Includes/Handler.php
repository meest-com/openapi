<?php

namespace Meest\OpenApi\Includes;

abstract class Handler
{
    protected $config;
    protected $request;
    protected $credential;
    protected $cache;
    protected $cacheInterval;

    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->cache = $this->config->get('cache');
        $this->cacheInterval = $this->config->get('cache_interval');
        $this->request = new Request($this->config);
        $this->credential = new Cache($this->config->get('credential_file'));
    }

    protected function getUrl($url, $query = [], $params = [])
    {
        $url = $this->config->get($url);

        return $this->config->get('base_url')
            .(!empty($query) ? strtr($url, $query) : $url)
            .(!empty($params) ? '?'.http_build_query($params) : null);
    }
}
