<?php
declare(strict_types=1);

namespace Tale\Test\TestFactory\Adapter;

use Tale\Test\TestFactory\AdapterInterface;
use Tale\Test\TestFactory\AdapterManager;

class JsonAdapter implements AdapterInterface
{
    private $manager;

    public function __construct(AdapterManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @return AdapterManager
     */
    public function getManager(): AdapterManager
    {
        return $this->manager;
    }

    public function getString(): string
    {
        return 'json';
    }
}