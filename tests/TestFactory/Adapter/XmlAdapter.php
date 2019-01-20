<?php declare(strict_types=1);

namespace Tale\Test\TestFactory\Adapter;

use Tale\Test\TestFactory\AdapterInterface;

class XmlAdapter implements AdapterInterface
{
    public function getString(): string
    {
        return 'xml';
    }
}
