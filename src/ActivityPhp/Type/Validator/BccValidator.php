<?php

declare(strict_types=1);

namespace ActivityPhp\Type\Validator;

use ActivityPhp\Type\ValidatorInterface;
use ActivityPhp\Type\ValidatorTools;

/**
 * \ActivityPhp\Type\Validator\BccValidator is a dedicated
 * validator for bcc attribute.
 */
final class BccValidator implements ValidatorInterface
{
    /**
     * Validate a bcc value
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
