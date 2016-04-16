<?php

abstract class TestCase extends PHPUnit_Framework_TestCase
{
    protected function getProtectedMethod($class, $method)
    {
        $reflector = new ReflectionClass($class);

        $method = $reflector->getMethod($method);
        $method->setAccessible(true);

        return $method;
    }

    protected function getProtectedProperty($class, $property)
    {
        $reflector = new ReflectionClass($class);

        $property = $reflector->getProperty($property);
        $property->setAccessible(true);

        return $property;
    }
}