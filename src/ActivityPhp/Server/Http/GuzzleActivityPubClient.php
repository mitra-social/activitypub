<?php

namespace ActivityPhp\Server\Http;

use ActivityPhp\Type\Util;
use Exception;
use GuzzleHttp\Client;

/**
 * Request handler
 */
class GuzzleActivityPubClient implements ActivityPubClientInterface
{
    const HTTP_HEADER_ACCEPT = 'application/activity+json,application/ld+json,application/json';

    /**
     * @var string HTTP method
     */
    protected $method = 'GET';

    /**
     * Allowed HTTP methods
     *
     * @var array
     */
    protected $allowedMethods = [
        'GET', 'POST'
    ];

    /**
     * HTTP client
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var DecoderInterface
     */
    protected $decoder;

    /**
     * Set HTTP client
     *
     * @param DecoderInterface $decoder
     * @param float|int $timeout
     */
    public function __construct(DecoderInterface $decoder, $timeout = 5.0)
    {
        $this->decoder = $decoder;
        $this->client = new Client([
            'timeout' => $timeout,
            'headers' => [
                'Accept' => self::HTTP_HEADER_ACCEPT,
            ]
        ]);
    }

    /**
     * Execute a GET request
     *
     * @param  string $url
     * @return array
     */
    public function get(string $url): array
    {
        try {
            $content = $this->client->get($url)->getBody()->getContents();
        } catch (\GuzzleHttp\Exception\ClientException $exception) {
            throw new Exception($exception->getMessage());
        }

        return $this->decoder->decode($content);
    }
}
