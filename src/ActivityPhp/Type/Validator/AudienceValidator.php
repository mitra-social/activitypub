<?php

declare(strict_types=1);

namespace ActivityPhp\Type\Validator;

use ActivityPhp\Type\ValidatorInterface;
use ActivityPhp\Type\ValidatorTools;

/**
 * \ActivityPhp\Type\Validator\AudienceValidator is a dedicated
 * validator for audience attribute.
 */
final class AudienceValidator implements ValidatorInterface
{
    /**
     * Validate an audience value
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
            ValidatorTools::getLinkOrNamedObjectValidator()
        );
    }
}
