<?php

function getRandomHero($index) {
    $health = rand(1000,2500);
    return [
        'number' => $index,
        'health' => $health,
        'original-health' => $health,
        'strength' => rand(100,170)
    ];
}

function filterHeroes($heroes){
    foreach ($heroes as $key => $hero) {
        if ($hero['health'] <= 0){
            unset($heroes[$key]);
        }
    }
    return $heroes;
}

function battle($heroes1,$heroes2,$player){
    foreach ($heroes1 as $key1 => &$hero1) {
        foreach ($heroes2 as $key2 => &$hero2) {
            $result = attackHero($hero1, $hero2);
            $hero1 = $result[0];
            $hero2 = $result[1];
            if ($hero2['health'] <= 0) {
                unset($heroes2[$key2]);
            }
        }
    }
    echo '--------------------------------' . '<br>';
    return [$heroes1, $heroes2];
}

function attackHero($hero1, $hero2) {
    $hero2['health'] -= $hero1['strength'];
    echo 'Hero ' . $hero1['number'] . ' ('. $hero1['health'] . ') is attackacking hero ' . $hero2['number'] . ' ('. $hero2['health'] . ') from opposing team.' .'<br>';
    if ($hero2['health'] > 0) {
        $tenPercent = $hero2['original-health']*0.1;
        if ($hero2['health'] < $tenPercent){
            $tenPercent *= 0.5;
            $hero2['health'] += $tenPercent;
            echo 'Hero ' . $hero2['number'] . ' received adrenaline and got + ' . $tenPercent . ' to health!<br>';
        }
    } else {
        $hero1['health'] -= $hero2['strength']*0.1;
        echo 'Hero ' . $hero2['number'] . ' made his last attack with strength + ' . $hero2['strength']*0.1 . '<br>';

    }
    return [$hero1, $hero2];
}

$heroes1 = $heroes2 = [];

for ($i = 0; $i <5; $i ++){
    $heroes1[] = getRandomHero($i+1);
    $heroes2[] = getRandomHero($i+1);
}

$gameover = false;
$i = 0;
while ($gameover !== true) {
    $heroes1 = filterHeroes($heroes1);
    $heroes2 = filterHeroes($heroes2);

    if (count($heroes1) == 0 || count($heroes2) == 0) {
        if (count($heroes1) == 0) {
            echo 'Player 2 won!';
        } elseif (count($heroes2) == 0) {
            echo 'Player 1 won!';
        }
        break;
    }

    $result = battle($heroes1,$heroes2,1);
    $heroes1 = $result[0];
    $heroes2 = $result[1];
    
    $result = battle($heroes2,$heroes1,2);
    $heroes2 = $result[0];
    $heroes1 = $result[1];
}