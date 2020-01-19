<?php

declare(strict_types=1);

namespace ActivityPhpTest;

use ActivityPhp\Type\ValidatorInterface;

final class MyCustomValidator implements ValidatorInterface
{
    /**
     * Validate a custom attribute value
     *
     * @param mixed  $value
     * @param mixed  $container An object
     * @return bool
     */
    public function validate($value, $container)
    {
        return $value !== 'Bad value';
    }
}
