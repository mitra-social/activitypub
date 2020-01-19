<?php

declare(strict_types=1);

namespace ActivityPhp\Type\Validator;

use ActivityPhp\Type\ValidatorInterface;
use ActivityPhp\Type\ValidatorTools;

/**
 * \ActivityPhp\Type\Validator\AttributedToValidator is a dedicated
 * validator for attributedTo attribute.
 */
final class AttributedToValidator implements ValidatorInterface
{
    /**
     * Validate an attributedTo value
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
            ValidatorTools::getCollectionActorsValidator()
        );
    }
}
