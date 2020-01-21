<?php

declare(strict_types=1);

namespace ActivityPhp\Type\Validator;

use ActivityPhp\Type\Core\Activity;
use ActivityPhp\Type\TypeResolver;
use ActivityPhp\Type\Util;
use ActivityPhp\Type\ValidatorInterface;

/**
 * \ActivityPhp\Type\Validator\OriginValidator is a dedicated
 * validator for origin attribute.
 */
class OriginValidator implements ValidatorInterface
{

    /**
     * @var TypeResolver
     */
    private $typeResolver;

    /**
     * OriginValidator constructor.
     * @param TypeResolver $typeResolver
     */
    public function __construct(TypeResolver $typeResolver)
    {
        $this->typeResolver = $typeResolver;
    }

    /**
     * Validate an origin value
     * 
     * @param  string|array|object $value
     * @param  object              $container
     * @return bool
     */
    public function validate($value, $container)
    {
        // Container is an Activity
        Util::subclassOf(
            $container, 
            [Activity::class],
            true
        );

        // URL
        if (is_string($value)) {
            return Util::validateUrl($value);
        }

        if (is_array($value)) {
            $value = Util::arrayToType($value);
        }

        // Link or Object
        if (is_object($value)) {
            return Util::validateLink($value)
                || Util::isObjectType($value, $this->typeResolver);
        }
    }
}
