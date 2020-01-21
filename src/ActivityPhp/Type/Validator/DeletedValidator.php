<?php

declare(strict_types=1);

namespace ActivityPhp\Type\Validator;

use ActivityPhp\Type\Extended\Object\Tombstone;
use ActivityPhp\Type\Util;
use ActivityPhp\Type\ValidatorInterface;

/**
 * \ActivityPhp\Type\Validator\DeletedValidator is a dedicated
 * validator for deleted attribute.
 */
class DeletedValidator implements ValidatorInterface
{
    /**
     * Validate a DELETED attribute value
     * 
     * @param string $value
     * @param mixed  $container A Tombstone type
     * @return bool
     */
    public function validate($value, $container)
    {
        // Validate that container is a Tombstone type
        Util::subclassOf($container, Tombstone::class, true);

        if (is_string($value)) {
            // MUST be a datetime
            if (Util::validateDatetime($value)) {
                return true;
            }
        }
    }
}
