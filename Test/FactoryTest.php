<?php

namespace Tale\Test;

use Tale\Factory;
use Tale\FactoryException;

interface I {}

class A implements I {}
class B implements I {}
class C {}
class D extends A {}

class InflectorTest extends \PHPUnit_Framework_TestCase
{


    public function testPragmatic()
    {

        $factory = new Factory(I::class, ['a' => A::class, 'c' => C::class, 'd' => D::class]);

        $this->assertInstanceOf(A::class, $factory->create('a'));
        $this->assertInstanceOf(B::class, $factory->create(B::class));
        $this->assertInstanceOf(D::class, $factory->create('d'));

        $this->setExpectedException(FactoryException::class);
        $c = $factory->create('c');
    }

}