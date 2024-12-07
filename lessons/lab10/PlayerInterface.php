<?php

interface PlayerInterface
{
    public function attack(Player $_enemyPlayer, int $_turn): void;
    public function heroesLeft(): bool;
}
