<?php

namespace ActivityPhp;

use ActivityPhp\Type\AbstractObject;
use ActivityPhp\Type\Dialect;
use ActivityPhp\Type\TypeResolver;
use ActivityPhp\Type\Validator;
use DeepCopy\DeepCopy;
use Exception;

/**
 * \ActivityPhp\Type is a Factory for ActivityStreams 2.0 types.
 *
 * It provides shortcuts methods for type instanciation and more.
 *
 * @see https://www.w3.org/TR/activitystreams-vocabulary/#types
 * @see https://www.w3.org/TR/activitystreams-vocabulary/#activity-types
 * @see https://www.w3.org/TR/activitystreams-vocabulary/#actor-types
 * @see https://www.w3.org/TR/activitystreams-vocabulary/#object-types
 */
final class TypeFactory
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
     * Factory method to create type instance and set attributes values
     *
     * To see which default types are defined and their attributes:
     *
     * @see https://www.w3.org/TR/activitystreams-vocabulary/#types
     * @see https://www.w3.org/TR/activitystreams-vocabulary/#activity-types
     * @see https://www.w3.org/TR/activitystreams-vocabulary/#actor-types
     * @see https://www.w3.org/TR/activitystreams-vocabulary/#object-types
     *
     * @param string|array $type
     * @param array $attributes
     * @return AbstractObject
     * @throws Exception
     */
    public function create(string $type, array $attributes = []): AbstractObject
    {
        $className = $this->typeResolver->getClass($type);
        $object = new $className();

        foreach ($attributes as $name => $value) {
            $object->set($name, $value);
        }

        return $object;
    }

    /**
     * Add a custom type definition. It overrides defined types.
     *
     * @param string $name A short name
     * @param string $class Fully qualified class name
     * @throws Exception
     */
    public function add($name, $class)
    {
        $this->typeResolver->addCustomType($name, $class);
    }
}
