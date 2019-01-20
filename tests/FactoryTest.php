<?php declare(strict_types=1);

namespace Tale\Test;

use PHPUnit\Framework\TestCase;
use Tale\Factory;
use Tale\Test\TestFactory\Adapter\JsonAdapter;
use Tale\Test\TestFactory\Adapter\XmlAdapter;
use Tale\Test\TestFactory\Adapter\YamlAdapter;
use Tale\Test\TestFactory\AdapterInterface;
use Tale\Test\TestFactory\AdapterManager;

/**
 * @coversDefaultClass \Tale\Factory
 */
class FactoryTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getBaseClassName
     * @covers ::getConstructorArguments
     * @covers ::getAliases
     * @covers ::validateClassName
     */
    public function testGetters(): void
    {
        $factory = new Factory(AdapterInterface::class, ['test', 1, true], [
            'yaml' => YamlAdapter::class,
            'xml' => XmlAdapter::class
        ]);

        self::assertSame(AdapterInterface::class, $factory->getBaseClassName());
        self::assertSame(['test', 1, true], $factory->getConstructorArguments());
        self::assertSame([
            'yaml' => YamlAdapter::class,
            'xml' => XmlAdapter::class
        ], $factory->getAliases());
    }

    /**
     * @covers ::__construct
     * @covers ::register
     * @covers ::resolve
     * @covers ::validateClassName
     */
    public function testRegisterUnregisterAndResolve(): void
    {
        $factory = new Factory(AdapterInterface::class);
        $factory->register('yaml', YamlAdapter::class);
        self::assertSame(YamlAdapter::class, $factory->resolve(YamlAdapter::class));
        self::assertSame(YamlAdapter::class, $factory->resolve('yaml'));
        $factory->register('json', JsonAdapter::class);
        self::assertSame(JsonAdapter::class, $factory->resolve(JsonAdapter::class));
        self::assertSame(JsonAdapter::class, $factory->resolve('json'));
    }

    /**
     * @covers ::__construct
     * @covers ::resolve
     * @covers ::validateClassName
     * @expectedException \Tale\FactoryException
     */
    public function testNotYetRegisteredAliasThrowsException(): void
    {
        $factory = new Factory(AdapterInterface::class);
        $factory->resolve('yaml');
    }

    /**
     * @covers ::__construct
     * @covers ::register
     * @covers ::unregister
     * @covers ::resolve
     * @covers ::validateClassName
     * @expectedException \Tale\FactoryException
     */
    public function testUnregisteredAliasThrowsException(): void
    {
        $factory = new Factory(AdapterInterface::class);
        $factory->register('yaml', YamlAdapter::class);
        $factory->unregister('yaml');
        $factory->resolve('yaml');
    }

    /**
     * @covers ::__construct
     * @covers ::get
     * @covers ::createInstance
     * @covers ::getInstance
     */
    public function testGet(): void
    {
        $manager = new AdapterManager();
        $factory = $manager->getFactory();
        /** @var JsonAdapter $jsonAdapter */
        $jsonAdapter = $factory->get('json');
        self::assertInstanceOf(JsonAdapter::class, $jsonAdapter);
        self::assertSame('json', $jsonAdapter->getString());
        self::assertSame($manager, $jsonAdapter->getManager());
        self::assertNotSame($jsonAdapter, $factory->get('json'));

        $yamlAdapter = $factory->get('yaml');
        self::assertInstanceOf(YamlAdapter::class, $yamlAdapter);
        self::assertSame('yaml', $yamlAdapter->getString());
        self::assertNotSame($yamlAdapter, $factory->get('yaml'));

        $yamlAdapter = $factory->get(YamlAdapter::class);
        self::assertInstanceOf(YamlAdapter::class, $yamlAdapter);
        self::assertSame('yaml', $yamlAdapter->getString());
        self::assertNotSame($yamlAdapter, $factory->get(YamlAdapter::class));
    }
}
