<?php

declare(strict_types=1);

namespace ActivityPhp\Type\Validator;

use ActivityPhp\Type\Extended\AbstractActor;
use ActivityPhp\Type\Util;
use ActivityPhp\Type\ValidatorInterface;

/**
 * \ActivityPhp\Type\Validator\EndpointsValidator is a dedicated
 * validator for endpoints attribute.
 */
class EndpointsValidator implements ValidatorInterface
{
    /**
     * Validate ENDPOINTS value
     * 
     * @param string|array $value
     * @param mixed  $container
     * @return bool
     */
    public function validate($value, $container)
    {
        // Validate that container is an AbstractActor type
        Util::subclassOf($container, AbstractActor::class, true);

        // A link to a JSON-LD document 
        if (Util::validateUrl($value)) {
            return true;
        }

        // A map
        return is_array($value)
            ? $this->validateObject($value)
            : false;
    }

    /**
     * Validate endpoints mapping
     * 
     * @param  array $item
     * @return bool
     */
    protected function validateObject(array $item)
    {
        foreach ($item as $key => $value) {

            switch ($key) {
                case 'proxyUrl':
                case 'oauthAuthorizationEndpoint':
                case 'oauthTokenEndpoint':
                case 'provideClientKey':
                case 'signClientKey':
                case 'sharedInbox':
                    if (!Util::validateUrl($value)) {
                        return false;
                    }
                    break;
            }
        }

        return true;
    }
}
