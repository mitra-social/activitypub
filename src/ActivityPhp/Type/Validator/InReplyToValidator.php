<?php

declare(strict_types=1);

namespace ActivityPhp\Type\Validator;

use ActivityPhp\Type\Core\ObjectType;
use ActivityPhp\Type\TypeResolver;
use ActivityPhp\Type\Util;
use ActivityPhp\Type\ValidatorInterface;

/**
 * \ActivityPhp\Type\Validator\InReplyToValidator is a dedicated
 * validator for inReplyTo attribute.
 */
class InReplyToValidator implements ValidatorInterface
{

    /**
     * @var TypeResolver
     */
    private $typeResolver;

    /**
     * @param TypeResolver $typeResolver
     */
    public function __construct(TypeResolver $typeResolver)
    {
        $this->typeResolver = $typeResolver;
    }

    /**
     * Validate inReplyTo value
     * 
     * @param  string|array|object $value
     * @param  object              $container
     * @return bool
     */
    public function validate($value, $container)
    {
        // Container is an ObjectType
        Util::subclassOf(
            $container, 
            ObjectType::class,
            true
        );

        // null
        if (is_null($value)) {
            return true;
        }

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
