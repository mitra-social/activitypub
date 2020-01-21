<?php

/*
 * This file is part of the ActivityPhp package.
 *
 * Copyright (c) landrok at github.com/landrok
 *
 * For the full copyright and license information, please see
 * <https://github.com/landrok/activitypub/blob/master/LICENSE>.
 */

namespace ActivityPhp\Type\Validator;

use ActivityPhp\Type\Core\ObjectType;
use ActivityPhp\Type\TypeResolver;
use ActivityPhp\Type\Util;
use ActivityPhp\Type\ValidatorInterface;

/**
 * \ActivityPhp\Type\Validator\GeneratorValidator is a dedicated
 * validator for generator attribute.
 */
class GeneratorValidator implements ValidatorInterface
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
     * Validate a generator attribute value
     * 
     * @param string|object|array $value
     * @param object              $container
     * @return bool
     */
    public function validate($value, $container)
    {
        // Validate that container has an ObjectType type
        Util::subclassOf($container, ObjectType::class, true);

        if (Util::validateUrl($value)) {
            return true;
        }

        if (is_array($value)) {
            $value = Util::arrayToType($value);
        }

        // MUST be a valid Actor type
        return Util::isActorType($value, $this->typeResolver) || Util::validateLink($value);
    }    
}
