<?php
require_once 'HeroInterface.php';
require_once 'PlayerInterface.php';
require_once 'Hero.php';
require_once 'Player.php';


$names1 = ['1','2','3','4','5'];
$names2 = ['6','7','8','9','10'];

$heroes1 = [];
$heroes2 = [];

for ($i=0; $i<count($names1); $i++) {
    $heroes1[$i] = new Hero ($names1[$i], rand(1000,2500), rand(100,170));
    $heroes2[$i] = new Hero ($names2[$i], rand(1000,2500), rand(100,170));
}