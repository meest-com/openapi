<?php

namespace Meest\OpenApi\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;
use function GuzzleHttp\json_decode;

class RequestException extends HttpException
{
    private $reasonPhrase;

    /**
     * Create a new exception instance.
     *
     * @param  $e
     * @return void
     */
    public function __construct($e)
    {
        $response = $e->getResponse();
        $this->statusCode = $response->getStatusCode();
        $this->reasonPhrase = $response->getReasonPhrase();
        $body = json_decode($response->getBody()->getContents(), true);

        if ($body['info']['fieldName'] === 'parcelID' && $body['info']['message'] === 'Data not found') {
            $this->statusCode = 404;
            $message = $body['info']['message'];
        } else {
            $this->statusCode = 422;
            $message = $body['info']['message']
                .(!empty($body['info']['fieldName']) ? ': '.$body['info']['fieldName'] : null)
                .(!empty($body['info']['messageDetails']) ? ' ('.$body['info']['messageDetails'].') ' : null);
        }

        parent::__construct($this->statusCode, $message);
    }
}
