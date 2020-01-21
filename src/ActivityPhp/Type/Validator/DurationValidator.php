<?php

declare(strict_types=1);

namespace ActivityPhp\Type\Validator;

use ActivityPhp\Type\Core\ObjectType;
use ActivityPhp\Type\Util;
use ActivityPhp\Type\ValidatorInterface;

/**
 * \ActivityPhp\Type\Validator\DurationValidator is a dedicated
 * validator for duration attribute.
 */
class DurationValidator implements ValidatorInterface
{
    /**
     * Validate an DURATION attribute value
     * 
     * @param string $value
     * @param mixed  $container
     * @return bool
     */
    public function validate($value, $container)
    {
        // Validate that container has an ObjectType type
        Util::subclassOf($container, ObjectType::class, true);

        if (is_string($value)) {
            // MUST be a XML 8601 Duration formatted string
            return Util::isDuration($value, true);
        }
    }
}
