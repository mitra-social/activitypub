<?php

declare(strict_types=1);

namespace ActivityPhp\Type;

use ActivityPhp\Type\Core\ObjectType;
use ActivityPhp\Type\Extended\AbstractActor;
use Exception;

/**
 * \ActivityPhp\Type\ValidatorTools is an abstract class for
 * attribute validation.
 * Its purpose is to be extended by ActivityPhp\Type\Validator\*
 * classes.
 * It provides some methods to make some regular validations.
 * It implements \ActivityPhp\Type\ValidatorInterface.
 */
final class ValidatorTools
{

    private function __construct()
    {
    }

    /**
     * Validate a map attribute value.
     *
     * @param  string $type An attribute name
     * @param  mixed  $map
     * @param  object $container A valid container
     * @return bool
     */
    public static function validateMap($type, $map, $container)
    {
        // A map
        if (!is_array($map)) {
            return false;
        }

        foreach ($map as $key => $value) {
            if (!Util::validateBcp47($key)
                || !Validator::validate($type, $value, $container)
            ) {
                return false;
            }
        }

        return true;
    }

    /**
     * Validate an attribute value
     *
     * @param  mixed $value
     * @param  mixed $container An object
     * @param  callable $callback A dedicated validator
     * @return bool
     */
    public static function validateListOrObject($value, $container, callable $callback)
    {
        Util::subclassOf($container, ObjectType::class, true);

        // Not supported: Can be a JSON string
        // Must be a value like an URL, a text
        if (is_string($value)) {
            return $callback($value);
        }

        if (is_array($value)) {
            // Can be empty
            if (!count($value)) {
                return true;
            }

            // A collection
            if (is_int(key($value))) {
                return self::validateObjectCollection($value, $callback);
            }

            $value = Util::arrayToType($value);
        }

        if (!is_object($value)) {
            return false;
        }

        return $callback($value);
    }

    /**
     * Validate a list of Collection
     *
     * @param  array $collection
     * @param  callable $callback A dedicated validator
     * @return bool
     */
    public static function validateObjectCollection(array $collection, callable $callback)
    {
        foreach ($collection as $item) {
            if ($callback($item)) {
                continue;
            }

            return false;
        }

        return true;
    }

    /**
     * Validate that a value is a string
     *
     * @param  string $value
     * @return bool
     */
    public static function validateString($value)
    {
        if (!is_string($value) || strlen($value) < 1) {
            throw new Exception(
                sprintf(
                    'Value must be a non-empty string. Given: "%s"',
                    print_r($value, true)
                )
            );
        }

        return true;
    }

    /**
     * A callback function for validateListOrObject method
     *
     * It validate a Link or a named object
     *
     * @return callable
     */
    public static function getLinkOrNamedObjectValidator()
    {
        return function ($item) {
            if (is_string($item)) {
                return Util::validateUrl($item);
            }

            if (is_array($item)) {
                $item = Util::arrayToType($item);
            }

            if (is_object($item)) {
                Util::hasProperties($item, ['type'], true);

                // Validate Link type
                if ($item->type == 'Link') {
                    return Util::validateLink($item);
                }

                // Validate Object type
                Util::hasProperties($item, ['name'], true);

                return is_string($item->name);
            }
        };
    }

    /**
     * A callback function for validateListOrObject method
     *
     * Validate a reference with a Link or an Object with an URL
     *
     * @return callable
     */
    public static function getLinkOrUrlObjectValidator()
    {
        return function ($item) {
            if (is_array($item)) {
                $item = Util::arrayToType($item);
            }

            if (is_object($item)
                && Util::isLinkOrUrlObject($item)) {
                return true;
            } elseif (Util::validateUrl($item)) {
                return true;
            }
        };
    }


    /**
     * A callback function for attachment validation
     *
     * Validate a reference with a Link, an Object with an URL
     * or an ObjectType
     *
     * @return callable
     */
    public static function getAttachmentValidator()
    {
        return function ($item) {
            if (is_array($item)) {
                $item = Util::arrayToType($item);
            }

            if (is_object($item)) {
                if (Util::isLinkOrUrlObject($item)) {
                    return true;
                }

                return ($item instanceof ObjectType);
            } elseif (Util::validateUrl($item)) {
                return true;
            }
        };
    }

    /**
     * Validate that a Question answer is a Note
     *
     * @return callable
     */
    public static function getQuestionAnswerValidator()
    {
        return function ($item) {
            if (is_array($item)) {
                $item = Util::arrayToType($item);
            }

            if (!is_object($item)) {
                return false;
            }

            Util::hasProperties($item, ['type', 'name'], true);
            return $item->type == 'Note'
                && is_scalar($item->name);
        };
    }

    /**
     * Validate that a list of items is valid
     *
     * @return callable
     */
    public static function getCollectionItemsValidator()
    {
        return function ($item) {
            if (is_string($item)) {
                return Util::validateUrl($item);
            }

            if (is_array($item)) {
                $item = Util::arrayToType($item);
            }

            if (!is_object($item)) {
                return false;
            }

            return Util::hasProperties($item, ['type'], true);
        };
    }

    /**
     * Validate that a list of items are actors
     *
     * @return callable
     */
    public static function getCollectionActorsValidator()
    {
        return function ($item) {
            if (is_string($item)) {
                return Util::validateUrl($item);
            }

            if (is_array($item)) {
                $item = Util::arrayToType($item);
            }

            if (!is_object($item)) {
                return false;
            }
            // id must be filled
            if ($item instanceof AbstractActor) {
                return !is_null($item->id);
            }

            return Util::validateLink($item);
        };
    }
}
