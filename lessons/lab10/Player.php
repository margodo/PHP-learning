<?php

class Player implements PlayerInterface
{
    private string $name;
    private array $heroes;

    public function __construct(string $_name, array $_heroes)
    {
        $this->name=$_name;
        $this->heroes = $_heroes;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getHeroes()
    {
        return $this->heroes;
    }

     
}