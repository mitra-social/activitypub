<?php

declare(strict_types=1);

namespace ActivityPhp\Server\Http;

final class JsonDecoder implements DecoderInterface
{

    public function decode(string $value)
    {
        $json = json_decode($value, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('JSON decoding failed for string: ' . $value);
        }

        return $json;
    }
}
