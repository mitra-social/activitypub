<?php

namespace ActivityPhp\Server\Http;

interface DecoderInterface
{
    public function decode(string $data);
}