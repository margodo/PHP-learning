<?php

class Suit 
{
    private $isTrump = false;
    private $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function setTrump($trump)
    {
        $this->isTrump = $trump;
    }

    public function isTrump()
    {
        return $this->isTrump;
    }
}

class Card
{
    private $rank;
    private $label;
    private $suit;

    public function __construct($rank, $label, $suit)
    {
        $this->rank = $rank;
        $this->label = $label;
        $this->suit = $suit;
    }

    public function getSuit()
    {
        return $this->suit;
    }

    public function setRank($rank)
    {
        $this->rank = $rank;
    }

    public function getRank()
    {
        $level = 0;
        if($this->suit->isTrump()) {
            $level = 10;
        }
        return $this->rank+$level;
    }
}

class Player
{
    private $name;
    private $cards = [];

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function setCard($card)
    {
        $this->cards[] = $card;
    }

    public function calc()
    {
        $power = 0;
        foreach ($this->cards as $card)
        {
            $power += $card->getRank();
        }
        return $power;
    }
}

$ranks = ['6','7','8','9','10','J','Q','K','A'];

$suits = [new Suit('hearts'), new Suit ('diamonds'), new Suit('spades'),new Suit('clubs')];

$cards = [];
foreach($suits as $suit) {
    foreach($ranks as $rank => $label) {
        $cards[] = new Card($rank + 1, $label, $suit);
    }
}

shuffle($cards);

$players = [new Player('Vasya'),new Player('Alex')];

$i = 0;
foreach ($cards as $card) {
    $players[$i%2]->setCard($card);
    if ($i == 11) {
        break;
    }
    $i ++;
}

$trumpSuit = $cards[++$i]->getSuit();
$trumpSuit->setTrump(true);

var_dump($players[0]->calc(),
        $players[1]->calc());

var_dump($trumpSuit);
var_dump($players);