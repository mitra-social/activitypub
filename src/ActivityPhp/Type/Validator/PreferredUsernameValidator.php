<?php

declare(strict_types=1);

namespace ActivityPhp\Type\Validator;

use ActivityPhp\Type\Extended\AbstractActor;
use ActivityPhp\Type\Util;
use ActivityPhp\Type\ValidatorInterface;
use ActivityPhp\Type\ValidatorTools;

/**
 * \ActivityPhp\Type\Validator\PreferredUsernameValidator is a dedicated
 * validator for preferredUsername attribute.
 */
final class PreferredUsernameValidator implements ValidatorInterface
{
    /**
     * Validate preferredUsername value
     *
     * @param string $value
     * @param mixed  $container An Actor
     * @return bool
     */
    public function validate($value, $container)
    {
        // Validate that container is an Actor
        Util::subclassOf($container, AbstractActor::class, true);

        return ValidatorTools::validateString(
            $value
        );
    }
}
