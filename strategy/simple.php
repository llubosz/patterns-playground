<?php

interface Strategy
{
    public function doSomething();
}

class FirstStrategy
{
    public function doSomething() {
        return "I'm working under primary strategy!";
    }
}

class SecondStrategy
{
    public function doSomething() {
        return "I'm working under secondary strategy!";
    }
}

class Context
{
    private $strategy;

    public function __construct($condition)
    {
        switch ($condition)
        {
            case 1:
                $this->strategy = new FirstStrategy();
                break;
            case 2:
                $this->strategy = new SecondStrategy();
                break;
            default:
                throw new RuntimeException('Unexpected condition');
        }
    }

    public function doSomethingUnderStrategy()
    {
        return $this->strategy->doSomething();
    }
}

$firstContext = new Context(1);
echo $firstContext->doSomethingUnderStrategy() . PHP_EOL;
$secondContext = new Context(2);
echo $secondContext->doSomethingUnderStrategy() . PHP_EOL;