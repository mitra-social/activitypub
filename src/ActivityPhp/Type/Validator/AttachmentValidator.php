<?php

declare(strict_types=1);

namespace ActivityPhp\Type\Validator;

use ActivityPhp\Type\ValidatorInterface;
use ActivityPhp\Type\ValidatorTools;

/**
 * \ActivityPhp\Type\Validator\AttachmentValidator is a dedicated
 * validator for attachment attribute.
 */
final class AttachmentValidator implements ValidatorInterface
{
    /**
     * Validate an attachment value
     *
     * @param  array $value
     * @param  mixed  $container An Object type
     * @return bool
     */
    public function validate($value, $container)
    {
        if (is_array($value) && !count($value)) {
            return true;
        }

        return ValidatorTools::validateListOrObject(
            $value,
            $container,
            ValidatorTools::getAttachmentValidator()
        );
    }
}
