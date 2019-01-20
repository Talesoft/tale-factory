<?php declare(strict_types=1);

namespace Tale\Factory;

use Tale\Factory;

class PersistentFactory extends Factory
{
    private $instances = [];

    protected function getInstance(string $className)
    {
        if (!isset($this->instances[$className])) {
            $this->instances[$className] = parent::getInstance($className);
        }
        return $this->instances[$className];
    }
}
