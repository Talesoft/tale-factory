<?php

namespace Tale\Factory;

use Tale\Factory;

/**
 * Class SingletonFactory
 *
 * @package Tale\Factory
 */
class SingletonFactory extends Factory
{

    /**
     * @var array
     */
    private $_instances;

    /**
     * SingletonFactory constructor.
     *
     * @param string $baseClassName
     * @param array  $aliases
     */
    public function __construct($baseClassName, $aliases = null)
    {
        parent::__construct($baseClassName, $aliases);

        $this->_instances = [];
    }

    /**
     * @param string $className
     * @param array  $createArgs
     *
     * @return object
     */
    public function get($className, array $createArgs = null)
    {

        if (isset($this->_instances[$className]))
            return $this->_instances[$className];

        return $this->_instances[$className] = $this->create($className, $createArgs);
    }
}