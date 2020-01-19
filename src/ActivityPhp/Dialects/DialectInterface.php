<?php

namespace ActivityPhp\Dialects;

interface DialectInterface
{
    public function load(): void;

    public function unload(): void;
}