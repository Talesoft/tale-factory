<?php declare(strict_types=1);

namespace Tale;

class Factory implements FactoryInterface
{
    private $baseClassName;
    private $constructorArguments;
    private $aliases = [];

    public function __construct(string $baseClassName, array $constructorArguments = [], array $aliases = [])
    {
        $this->baseClassName = $baseClassName;
        $this->constructorArguments = $constructorArguments;
        foreach ($aliases as $alias => $className) {
            $this->register($alias, $className);
        }
    }

    public function getBaseClassName(): string
    {
        return $this->baseClassName;
    }

    /**
     * @return array
     */
    public function getConstructorArguments(): array
    {
        return $this->constructorArguments;
    }

    public function getAliases(): array
    {
        return $this->aliases;
    }

    public function register(string $alias, string $className): void
    {
        $this->validateClassName($className);
        $this->aliases[$alias] = $className;
    }

    public function unregister(string $alias): void
    {
        unset($this->aliases[$alias]);
    }

    public function resolve(string $aliasOrClassName): string
    {
        $className = $this->aliases[$aliasOrClassName] ?? $aliasOrClassName;
        $this->validateClassName($className);
        return $className;
    }

    public function get(string $aliasOrClassName)
    {
        return $this->getInstance($this->resolve($aliasOrClassName));
    }

    protected function getInstance(string $className)
    {
        return $this->createInstance($className);
    }

    protected function createInstance(string $className)
    {
        return new $className(...$this->constructorArguments);
    }

    private function validateClassName(string $className): void
    {
        if (!is_a($className, $this->baseClassName, true)) {
            throw new FactoryException("{$className} is not a valid {$this->baseClassName} type");
        }
    }
}
