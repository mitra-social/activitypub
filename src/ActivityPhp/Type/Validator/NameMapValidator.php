<?php

declare(strict_types=1);

namespace ActivityPhp\Type\Validator;

use ActivityPhp\Type\Util;
use ActivityPhp\Type\ValidatorInterface;
use ActivityPhp\Type\ValidatorTools;

/**
 * \ActivityPhp\Type\Validator\NameMapValidator is a dedicated
 * validator for nameMap attribute.
 */
final class NameMapValidator implements ValidatorInterface
{
    /**
     * Validate a nameMap value
     *
     * @param string  $value
     * @param mixed   $container
     * @return bool
     */
    public function validate($value, $container)
    {
        return ValidatorInterface::validateMap('name', $value, $container);
    }
}
