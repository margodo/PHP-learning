<?php

interface FightableInterface
{
    public function takeDamage($amount, FightableInterface $hero = null);
    public function attack(FightableInterface $hero);
    public function getStrength();
    public function getHealth();
    public function getNumber();
    public function getPlayer();
}

class Bunker implements FightableInterface
{
    private $heroes = [];
    private $health;
    private $player;
    private $number = 'Bunker';

    public function __construct($heroes, $player)
    {
        $this->heroes = $heroes;
        $this->health = rand(1000,2000);
        $this->player = $player;
    }

    public function getStrength()
    {
        $damage = 0;
        foreach ($this->heroes as $hero) {
            $damage += $hero->getStrength();
        }
        return $damage;
    }

    public function getHealth()
    {
        return $this->health;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getPlayer()
    {
        return $this->player;   
    }
    
    public function takeDamage($amount, FightableInterface $hero = null)
    {
        $this->health -= $amount;
        if ($this->health <= 0) {
            $this->player->setHeroes($this->heroes);
        }
    }

    public function attack(FightableInterface $hero)
    {
        if ($this->health > 0) {
            $damage = $this->getStrength();
            echo 'Heroes from Bunker dealing collective damage(' . $damage . ') to hero' . $hero->getNumber() . ' (' . $hero->getHealth() . ').' . "<br>";
            $hero->takeDamage($damage, $this);

        }
    }

}

class Hero implements FightableInterface
{   
    private $number;
    /** Health */
    private $health;
    private $originalHealth;
    /** Strength */
    private $strength;
    private $player;

    public function __construct($number,$health){
        /** Generate random health and strength */
        $this->number = $number;
        $this->health = $health;
        $this->originalHealth = $health;
        $this->strength = rand(100,170);
    }

    public function setPlayer($player) {
        $this->player = $player;
    }

    public function getHealth()
    {
        return $this->health;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getPlayer()
    {
        return $this->player;
    }

    public function takeDamage($amount, FightableInterface $hero=null){
        $this->health -= $amount;
        if ($this->health <= 0) {
            if ($hero !== null) {
                $hero->takeDamage($this->strength*0.1);
                if(rand(0,1)) {
                   echo 'Hero ' . $this->number . ' made his last attack with strength - ' . 
                    $this->strength*0.1 . '<br>'; 
                } else {
                    echo 'Enemy hero ' . $this->number . ' used grenade with strength - ' . 
                        $this->strength*2 . '!<br>';
                    foreach($hero->getPlayer()->getHeroes() as $enemyHero) {
                        $enemyHero->takeDamage($this->strength*2);
                    }
                }
            }
            $this->player->removeHero($this);
        } else {
            $tenPercent = $this->originalHealth * 0.1;
            if ($this->health < $tenPercent) {
                $tenPercent *= 0.5;
                $this->health += $tenPercent;
                echo 'Hero ' . $this->number . ' received adrenaline shot
                    and got + ' . $tenPercent . ' to health!<br>';
            }

        }
    }

    public function attack(FightableInterface $enemyHero){
        if ($this->health > 0) {
            echo 'Hero ' . $this->number . ' (' . $this->health . ') is attacking enemy hero ' .
                $enemyHero->getNumber() . ' (' . $enemyHero->getHealth() . ').' . "<br>";
            $enemyHero->takeDamage($this->strength,$this);
    }
    }

    public function getStrength()
    {
        return $this->strength;
    }
}

class Player
{
    private $heroes = [];
    private $bunkerUsed = false;

    public function __construct($heroes){
        foreach($heroes as $hero){
            $hero->setPlayer($this);
        }
        $this->heroes = $heroes;
    }

    public function setHeroes($heroes)
    {
        $this->heroes = $heroes;
    }

    public function getHeroes()
    {
        return $this->heroes;
    }

    public function removeHero($diedHero) {
        foreach($this->heroes as $key=>$hero) {
            if ($hero === $diedHero) {
                unset($this->heroes[$key]);
            }
        }
        if (! $this->bunkerUsed) {
            echo "Player has put his heroes into bunker.<br>";
            $this->heroes = [new Bunker($this->heroes, $this)];
            $this->bunkerUsed = true;
        }
    }

}

class Game
{
    private $player1;
    private $player2;

    public function __construct($player1, $player2){
        $this->player1 = $player1;
        $this->player2 = $player2;
    }
    
    public function battle(){
        while (true){
            if (!$this->player1->getHeroes()) {
                echo 'Player 2 wins';
                break;
            } elseif (!$this->player2->getHeroes()) {
                echo 'Player 1 wins';
                break;
            } 
            echo '<hr><br>Player 1 turn <br>';
            foreach ($this->player1->getHeroes() as $hero1) {
                foreach ($this->player2->getHeroes() as $hero2) {
                    $hero1->attack($hero2);   
                }
                echo '<br>';
            }
            if (count($this->player2->getHeroes()) !== 0) {
               echo '<hr><br>Player 2 turn <br>';
            foreach ($this->player2->getHeroes() as $hero2) {
                foreach ($this->player1->getHeroes() as $hero1) {
                    $hero2->attack($hero1);
                    
                }
                echo '<br>';
            }  
            }
    }
        
    }
}

$heroes1 = $heroes2 = [];

for ($i=0;$i<5;$i++) {
    $heroes1[] = new Hero($i+1,rand(1000,2500));
    $heroes2[] = new Hero($i+1,rand(1000,2500));
}

$game = new Game(new Player($heroes1),new Player($heroes2));

$game->battle();
