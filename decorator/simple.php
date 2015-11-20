<?php

interface SomeFancyInterface
{
    public function getInfo();
}

class BasicObject implements SomeFancyInterface
{
    public function getInfo()
    {
        return "I'm basic object";
    }
}

class Decorator implements SomeFancyInterface
{
    private $object;

    public function __construct(SomeFancyInterface $object)
    {
        $this->object = $object;
    }

    public function getInfo()
    {
        return $this->object->getInfo() . " decorated!";
    }
}

$object = new BasicObject();
$object = new Decorator($object);

echo $object->getInfo() . PHP_EOL; // I'm basic object decorated!