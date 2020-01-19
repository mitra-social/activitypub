<?php

declare(strict_types=1);

namespace ActivityPhp\Type\Validator;

use ActivityPhp\Type\Core\Link;
use ActivityPhp\Type\Core\ObjectType;
use ActivityPhp\Type\Util;
use ActivityPhp\Type\ValidatorInterface;
use ActivityPhp\Type\ValidatorTools;

/**
 * \ActivityPhp\Type\Validator\TypeValidator is a dedicated
 * validator for type attribute.
 */
final class TypeValidator implements ValidatorInterface
{
    /**
     * Validate a type value
     *
     * @param  string $value
     * @param  mixed  $container An Object type
     * @return bool
     */
    public function validate($value, $container)
    {
        // Validate that container is an ObjectType or a Link
        Util::subclassOf(
            $container,
            [ObjectType::class, Link::class],
            true
        );

        return ValidatorTools::validateString(
            $value
        );
    }
}
