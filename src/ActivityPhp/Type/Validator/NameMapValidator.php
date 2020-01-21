<?php

declare(strict_types=1);

namespace ActivityPhp\Type\Validator;

use ActivityPhp\Type\Util;
use ActivityPhp\Type\Validator;
use ActivityPhp\Type\ValidatorInterface;
use ActivityPhp\Type\ValidatorTools;

/**
 * \ActivityPhp\Type\Validator\NameMapValidator is a dedicated
 * validator for nameMap attribute.
 */
final class NameMapValidator implements ValidatorInterface
{

    /**
     * @var Validator
     */
    private $validator;

    /**
     * @param Validator $validator
     */
    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Validate a nameMap value
     *
     * @param string  $value
     * @param mixed   $container
     * @return bool
     */
    public function validate($value, $container)
    {
        return ValidatorTools::validateMap('name', $value, $container, $this->validator);
    }
}
