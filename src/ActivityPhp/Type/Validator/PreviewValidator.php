<?php

declare(strict_types=1);

namespace ActivityPhp\Type\Validator;

use ActivityPhp\Type\Core\Link;
use ActivityPhp\Type\Core\ObjectType;
use ActivityPhp\Type\TypeResolver;
use ActivityPhp\Type\Util;
use ActivityPhp\Type\ValidatorInterface;

/**
 * \ActivityPhp\Type\Validator\PreviewValidator is a dedicated
 * validator for preview attribute.
 */
class PreviewValidator implements ValidatorInterface
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
     * Validate a preview value
     * 
     * @param  string|array|object $value
     * @param  mixed  $container
     * @return bool
     */
    public function validate($value, $container)
    {
        // Container is an ObjectType or a Link
        Util::subclassOf(
            $container, 
            [ObjectType::class, Link::class],
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
