<?php
declare(strict_types=1);

namespace Tale\Test\TestFactory;

class AdapterManager
{
    private $factory;

    public function __construct()
    {
        $this->factory = new AdapterFactory($this);
    }

    /**
     * @return AdapterFactory
     */
    public function getFactory(): AdapterFactory
    {
        return $this->factory;
    }
}
