<?php

declare(strict_types=1);

namespace ActivityPhp\Type\Validator;

use ActivityPhp\Type\Util;
use ActivityPhp\Type\ValidatorInterface;
use ActivityPhp\Type\ValidatorTools;

/**
 * \ActivityPhp\Type\Validator\ContentMapValidator is a dedicated
 * validator for contentMap attribute.
 */
final class ContentMapValidator implements ValidatorInterface
{
    /**
     * Validate a contentMap value
     *
     * @param string  $value
     * @param mixed   $container
     * @return bool
     */
    public function validate($value, $container)
    {
        return ValidatorTools::validateMap('content', $value, $container);
    }
}
