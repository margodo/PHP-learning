<?php


class Hero implements HeroInterface
{
    private string $name;
    private int $hp;
    private int $dmg;

    public function __construct(string $_name, int $_hp, int $_dmg)
    {
        $this->name = $name;
        $this->hp = $_hp;
        $this->dmg = $_dmg;

 }    

    public function getName(): string 
        {
            return $this->name;
        }
   
    public function getHp(): string 
    {
        return $this->hp;
    }
    public function getDamage(): string 
    {
        return $this->dmg;
    }
}