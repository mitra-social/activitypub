<?php

declare(strict_types=1);

namespace ActivityPhp\Type\Validator;

use ActivityPhp\Type\ValidatorInterface;
use ActivityPhp\Type\ValidatorTools;

/**
 * \ActivityPhp\Type\Validator\TagValidator is a dedicated
 * validator for tag attribute.
 */
final class TagValidator implements ValidatorInterface
{
    /**
     * Validate a tag value
     *
     * @param  array $value
     * @param  mixed  $container An Object type
     * @return bool
     */
    public function validate($value, $container)
    {
        if (!count($value)) {
            return true;
        }

        return ValidatorTools::validateObjectCollection(
            $value,
            ValidatorTools::getCollectionItemsValidator()
        );
    }
}
