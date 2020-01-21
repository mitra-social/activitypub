<?php

declare(strict_types=1);

namespace ActivityPhp\Type\Validator;

use ActivityPhp\Type\Core\ObjectType;
use ActivityPhp\Type\Extended\Object\Profile;
use ActivityPhp\Type\Util;
use ActivityPhp\Type\ValidatorInterface;

/**
 * \ActivityPhp\Type\Validator\DescribesValidator is a dedicated
 * validator for describes attribute.
 */
class DescribesValidator implements ValidatorInterface
{
    /**
     * Validate an DESCRIBES attribute value
     * 
     * @param object $value
     * @param mixed  $container A Profile type
     * @return bool
     */
    public function validate($value, $container)
    {
        // Validate that container is a Tombstone type
        Util::subclassOf($container, Profile::class, true);

        if (is_object($value)) {
            // MUST be an Object
            return Util::subclassOf($value, ObjectType::class, true);
        }
    }
}
