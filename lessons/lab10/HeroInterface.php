<?php
interface HeroInterface
{
    public function attacj (Player $_enemyPlayer): void;
    public function takeDamage(int $_dmg): void;
}
