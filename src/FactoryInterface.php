<?php
declare(strict_types=1);

namespace Tale;

interface FactoryInterface
{
    public function getBaseClassName(): string;
    public function getConstructorArguments(): array;
    public function getAliases(): array;
    public function register(string $alias, string $className): void;
    public function unregister(string $alias): void;
    public function resolve(string $aliasOrClassName): string;
    public function get(string $aliasOrClassName);
}