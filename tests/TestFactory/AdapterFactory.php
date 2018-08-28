<?php
declare(strict_types=1);

namespace Tale\Test\TestFactory;

use Tale\Factory;
use Tale\Test\TestFactory\Adapter\JsonAdapter;
use Tale\Test\TestFactory\Adapter\XmlAdapter;
use Tale\Test\TestFactory\Adapter\YamlAdapter;

class AdapterFactory extends Factory
{
    private $manager;

    public function __construct(AdapterManager $manager)
    {
        parent::__construct(AdapterInterface::class, [$manager], [
            'json' => JsonAdapter::class,
            'xml' => XmlAdapter::class,
            'yaml' => YamlAdapter::class
        ]);
        $this->manager = $manager;
    }

    /**
     * @return AdapterManager
     */
    public function getManager(): AdapterManager
    {
        return $this->manager;
    }

    public function get(string $aliasOrClassName): AdapterInterface
    {
        return parent::get($aliasOrClassName);
    }
}
