<?php

class Hero
{   
    var $number;
    /** Health */
    var $health;
    var $originalHealth;
    /** Strength */
    var $strength;
    var $player;

    function __construct($number,$health){
        /** Generate random health and strength */
        $this->number = $number;
        $this->health = $health;
        $this->originalHealth = $health;
        $this->strength = rand(100,170);
    }

    function setPlayer($player) {
        $this->player = $player;
    }

    function takeDamage($amount,$hero=null){
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
                    foreach($hero->player->heroes as $enemyHero) {
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

    function attack($enemyHero){

    if ($this->health > 0) {
        echo 'Hero ' . $this->number . ' (' . $this->health . ') is attacking enemy hero ' .
            $enemyHero->number . ' (' . $enemyHero->health . ').' . "<br>";
        $enemyHero->takeDamage($this->strength,$this);
    }
        
        
    }
}

class Player
{
    var $heroes = [];

    function __construct($heroes){
        foreach($heroes as $hero){
            $hero->setPlayer($this);
        }
        $this->heroes = $heroes;
    }

    function removeHero($diedHero) {
        foreach($this->heroes as $key=>$hero) {
            if ($hero === $diedHero) {
                unset($this->heroes[$key]);
            }
        }
    }

}

class Game
{
    var $player1;
    var $player2;

    function __construct($player1, $player2){
        $this->player1 = $player1;
        $this->player2 = $player2;
    }
    
    function battle(){
        while (true){
            if (!$this->player1->heroes) {
                echo 'Player 2 wins';
                break;
            } elseif (!$this->player2->heroes) {
                echo 'Player 1 wins';
                break;
            } 
            echo '<hr><br>Player 1 turn <br>';
            foreach ($this->player1->heroes as $hero1) {
                foreach ($this->player2->heroes as $hero2) {
                    $hero1->attack($hero2);
                    
                }
                echo '<br>';
            }
            if (count($this->player2->heroes) !== 0) {
               echo '<hr><br>Player 2 turn <br>';
            foreach ($this->player2->heroes as $hero2) {
                foreach ($this->player1->heroes as $hero1) {
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
