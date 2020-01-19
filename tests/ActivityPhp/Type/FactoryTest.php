<?php

namespace ActivityPhpTest\Type;

use ActivityPhp\Server\Http\Normalizer;
use ActivityPhp\Type;
use ActivityPhp\TypeFactory;
use ActivityPhpTest\MyCustomType;
use ActivityPhpTest\MyCustomValidator;
use Exception;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    /**
     * Valid scenarios provider
     */
    public function getShortTypes()
    {
        # Short type name
        return [
            ['Activity'],
            ['Collection'],
            ['CollectionPage'],
            ['IntransitiveActivity'],
            ['Link'],
            ['ObjectType'],
            ['Object'],
            ['OrderedCollection'],
            ['OrderedCollectionPage'],
            ['Application'],
            ['Group'],
            ['Organization'],
            ['Person'],
            ['Service'],
            ['Accept'],
            ['Add'],
            ['Announce'],
            ['Arrive'],
            ['Block'],
            ['Create'],
            ['Delete'],
            ['Dislike'],
            ['Flag'],
            ['Follow'],
            ['Ignore'],
            ['Invite'],
            ['Join'],
            ['Leave'],
            ['Like'],
            ['Listen'],
            ['Move'],
            ['Offer'],
            ['Question'],
            ['Read'],
            ['Reject'],
            ['Remove'],
            ['TentativeAccept'],
            ['TentativeReject'],
            ['Travel'],
            ['Undo'],
            ['Update'],
            ['View'],
            ['Article'],
            ['Audio'],
            ['Document'],
            ['Event'],
            ['Image'],
            ['Mention'],
            ['Note'],
            ['Page'],
            ['Place'],
            ['Profile'],
            ['Relationship'],
            ['Tombstone'],
            ['Video'],
        ];
	}

    /**
     * @var TypeFactory
     */
	private $typeFactory;

    /**
     * @var Type\TypeResolver
     */
	private $typeResolver;

	protected function setUp(): void
    {
        parent::setUp();

        $this->typeResolver = new Type\TypeResolver();
        $this->typeFactory = new TypeFactory(
            $this->typeResolver,
            new Type\Validator()
        );
    }

    /**
     * Check that all core objects have a correct type property.
     *
     * @dataProvider getShortTypes
     */
    public function testShortTypesInstanciation($type)
    {
        $class = $this->typeFactory->create($type, ['name' => strtolower($type)]);

        // Assert affectation
        $this->assertEquals(
            strtolower($type),
            $class->name
        );

        // Object has two names: Object and ObjectType
        if ($type == 'ObjectType') {
            $type = 'Object';
        }

        // Assert type property
        $this->assertEquals(
            $type,
            $class->type
        );
    }

    /**
     * Scenario for an undefined type
     */
    public function testUndefinedType()
    {
        $this->expectException(Exception::class);

        $this->typeFactory->create('UndefinedType');
    }

    /**
     * Scenario for instanciating a Type with a single parameter that
     * is not an array.
     */
    public function testShortCallFailingIntGiven()
    {
        $this->expectException(Exception::class);

        $this->typeFactory->create(42);
    }


    /**
     * Scenario for a custom classes with a failing value
     */
    public function testCustomTypeFailing()
    {
        $this->expectException(Exception::class);

        $this->typeFactory->add('Person', 'MyUndefinedType');
    }

    /**
     * Test a copy of an AS object
     */
    public function testCopy()
    {
        $original = new Type\Extended\Object\Note();
        $original->id = 'http://example.org/original-id';

        $copy = $original->copy();

        // Assert type are equals
        $this->assertEquals(
            $original->type,
            $copy->type
        );

        $normalizer = new Normalizer();

        // Assert all properties are equals
        $this->assertEquals(
            $normalizer->normalize($original),
            $normalizer->normalize($copy)
        );

        // Change a value
        $copy->id = 'http://example.org/copy-id';

        // Change is ok for the copy
        $this->assertEquals(
            'http://example.org/copy-id',
            $copy->id
        );

        // Assert original is not affected
        $this->assertEquals(
            'http://example.org/original-id',
            $original->id
        );
    }

    /**
     * Test copy chaining
     */
    public function testCopyChaining()
    {
        $original = new Type\Extended\Object\Note();
        $original->id = 'http://example.org/original-id';

        $copy = $original->copy();
        $copy->id = 'http://example.org/copy-id';

        // Change is ok for the copy
        $this->assertEquals(
            'http://example.org/copy-id',
            $copy->id
        );

        // Assert original is not affected
        $this->assertEquals(
            'http://example.org/original-id',
            $original->id
        );
    }
}
