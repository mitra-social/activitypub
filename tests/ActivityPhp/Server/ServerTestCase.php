<?php

declare(strict_types=1);

namespace ActivityPhpTest\Server;

use ActivityPhp\Server;
use ActivityPhp\Type\TypeResolver;
use ActivityPhp\Type\Validator;
use ActivityPhp\TypeFactory;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;

abstract class ServerTestCase extends TestCase
{

    /**
     * @var RequestFactoryInterface|ResponseFactoryInterface
     */
    protected $httpFactory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->httpFactory = new Psr17Factory();
    }

    public function getServer(array $config = []): Server
    {
        $typeFactory = new TypeFactory(new TypeResolver());
        $normalizer = new Server\Http\Normalizer();
        $denoramlizer = new Server\Http\Denormalizer($typeFactory);
        $encoder = new Server\Http\JsonEncoder();
        $decoder = new Server\Http\JsonDecoder();
        $activityPubClient = new Server\Http\GuzzleActivityPubClient($decoder, 0.5);
        $webfingerClient = new Server\Http\WebFingerClient($activityPubClient, false);

        return new Server(
            $this->httpFactory,
            $activityPubClient,
            $webfingerClient,
            $typeFactory,
            $normalizer,
            $denoramlizer,
            $encoder,
            $decoder,
            $config
        );
    }
}