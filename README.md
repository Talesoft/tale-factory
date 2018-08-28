
Tale Factory
============

What is Tale Factory?
-----------------------

A generic implementation of the factory pattern.

Installation
------------

```bash
composer require talesoft/tale-factory
```

Usage
-----

```php
use Tale\Factory;

interface AdapterInterface
{
    public function sayHello(): void;
}

class TestAdapter
{
    private $message;
    
    public function __construct(string $message)
    {
        $this->message = $message;
    }
    
    public function sayHello(): void
    {
        echo $this->message;
    }
}

$factory = new Factory(
    AdapterInterface::class,
    ['Hello from adapter!'],
    [
        'test' => TestAdapter::class
    ]
);


$instance = $factory->get('test');
$instance->sayHello(); //"Hello from adapter!"
```

TODO: More docs.