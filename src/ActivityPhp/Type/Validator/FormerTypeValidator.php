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

use ActivityPhp\Type\Extended\Object\Tombstone;
use ActivityPhp\Type\TypeResolver;
use ActivityPhp\Type\Util;
use ActivityPhp\Type\ValidatorInterface;

/**
 * \ActivityPhp\Type\Validator\FormerTypeValidator is a dedicated
 * validator for formerType attribute.
 */
class FormerTypeValidator implements ValidatorInterface
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
     * Validate a formerType attribute value
     * 
     * @param string|object|array $value
     * @param object  $container
     * @return bool
     */
    public function validate($value, $container)
    {
        // Validate that container has an Tombstone type
        Util::subclassOf($container, Tombstone::class, true);

        if (is_array($value)) {
            $value = Util::arrayToType($value);
        }

        // MUST be a valid Object type
        return Util::isObjectType($value, $this->typeResolver);
    }    
}
