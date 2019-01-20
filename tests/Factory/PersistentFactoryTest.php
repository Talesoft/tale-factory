<?php declare(strict_types=1);

namespace Tale\Test;

use PHPUnit\Framework\TestCase;
use Tale\Factory\PersistentFactory;
use Tale\Test\TestFactory\Adapter\XmlAdapter;
use Tale\Test\TestFactory\Adapter\YamlAdapter;
use Tale\Test\TestFactory\AdapterInterface;
use Tale\Test\TestFactory\AdapterManager;

/**
 * @coversDefaultClass \Tale\Factory\PersistentFactory
 */
class PersistentFactoryTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::get
     * @covers ::getInstance
     * @covers ::createInstance
     */
    public function testGet(): void
    {
        $factory = new PersistentFactory(AdapterInterface::class, [new AdapterManager()], [
            'yaml' => YamlAdapter::class,
            'xml' => XmlAdapter::class
        ]);

        /** @var YamlAdapter $yamlAdapter */
        $yamlAdapter = $factory->get('yaml');
        self::assertInstanceOf(YamlAdapter::class, $yamlAdapter);
        self::assertSame('yaml', $yamlAdapter->getString());
        self::assertSame($yamlAdapter, $factory->get('yaml'));
        self::assertSame($yamlAdapter, $factory->get(YamlAdapter::class));
        self::assertSame($yamlAdapter, $factory->get('yaml'));

        /** @var XmlAdapter $xmlAdapter */
        $xmlAdapter = $factory->get('xml');
        self::assertInstanceOf(XmlAdapter::class, $xmlAdapter);
        self::assertSame('xml', $xmlAdapter->getString());
        self::assertSame($xmlAdapter, $factory->get('xml'));
        self::assertSame($xmlAdapter, $factory->get(XmlAdapter::class));
        self::assertSame($xmlAdapter, $factory->get('xml'));
    }
}
