<?php

declare(strict_types=1);

namespace ActivityPhp\Type\Validator;

use ActivityPhp\Type\ValidatorInterface;
use ActivityPhp\Type\ValidatorTools;

/**
 * \ActivityPhp\Type\Validator\BtoValidator is a dedicated
 * validator for bto attribute.
 */
class BtoValidator implements ValidatorInterface
{
    /**
     * Validate a bto value
     *
     * @param  string $value
     * @param  mixed  $container An Object type
     * @return bool
     */
    public function validate($value, $container)
    {
        return ValidatorTools::validateListOrObject(
            $value,
            $container,
            ValidatorTools::getLinkOrUrlObjectValidator()
        );
    }
}
