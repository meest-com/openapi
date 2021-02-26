<?php

namespace Meest\OpenApi\Includes;

use Symfony\Component\HttpKernel\Exception\HttpException;
use function GuzzleHttp\json_decode;

class RequestException extends HttpException
{
    /**
     * Create a new exception instance.
     *
     * @param  $e
     * @return void
     */
    public function __construct($e)
    {
        $response = json_decode($e->getResponse()->getBody()->getContents(), true);

        $message = $response['info']['message']
            .(!empty($response['info']['fieldName']) ? ': '.$response['info']['fieldName'] : null)
            .(!empty($response['info']['messageDetails']) ? ' ('.$response['info']['messageDetails'].') ' : null);

        parent::__construct(422, $message);
    }
}
