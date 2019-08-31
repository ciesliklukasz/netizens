<?php

namespace App\Console\API;

use App\API\Exception\InvalidStatusCodeException;
use GuzzleHttp\Client as GuzzleClient;

class Client
{
    private const URL = 'https://jsonplaceholder.typicode.com/photos';
    /** @var GuzzleClient */
    private $guzzle;

    public function __construct(GuzzleClient $guzzle)
    {
        $this->guzzle = $guzzle;
    }

    /**
     * @throws InvalidStatusCodeException
     */
    public function getResponse(): array
    {
        $response = $this->guzzle->get(self::URL);

        if ($response->getStatusCode() !== 200)
        {
            throw new InvalidStatusCodeException();
        }

        return json_decode($response->getBody(), true);
    }
}
