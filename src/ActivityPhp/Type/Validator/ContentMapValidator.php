<?php

declare(strict_types=1);

namespace ActivityPhp\Type\Validator;

use ActivityPhp\Type\Util;
use ActivityPhp\Type\Validator;
use ActivityPhp\Type\ValidatorInterface;
use ActivityPhp\Type\ValidatorTools;

/**
 * \ActivityPhp\Type\Validator\ContentMapValidator is a dedicated
 * validator for contentMap attribute.
 */
final class ContentMapValidator implements ValidatorInterface
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
     * Validate a contentMap value
     *
     * @param string  $value
     * @param mixed   $container
     * @return bool
     */
    public function validate($value, $container)
    {
        return ValidatorTools::validateMap('content', $value, $container, $this->validator);
    }
}
