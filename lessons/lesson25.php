<?php
// $text = 'Рейтинги:	IMDb: 8.7 (1 891 305)Кинопоиск: 8.50 (645 180)
// Входит в списки:	Лучшая фантастика 1999 года (1 место)
// Лучшие боевики 1999 года (1 место)
// Лучшие зарубежные фильмы 1999 года (4 место)
// Слоган:	«Добро пожаловать в реальный мир»
// Дата выхода:	24 марта 1999 года
// Страна:	США
// Режиссер:	
// Лана Вачовски, Лилли Вачовски
// Жанр:	Фантастика, Боевики, Зарубежные
// Возраст:	16+ для более зрелых и понимающих
// Время:	136 мин.
// Из серии:	Фильмы в жанре киберпанк, Фильмы про роботов, 
// Фильмы про сверхспособности
// В ролях актеры:Киану Ривз, Лоренс Фишбёрн, Кэрри-Энн Мосс, 
// Хьюго Уивинг, Глория Фостер, Джо Пантольяно, Маркус Чонг, Джулиан Араханга, 
// Мэтт Доран, Белинда МакКлори и другие';

// $pattern = '/[А-ЯЁ][А-Яа-яё\-]{1,15} [А-ЯЁ][А-Яа-яё\-]{1,15}/u';
// $matches = [];

// preg_match_all($pattern,$text,$matches);

// $arr = [
//     "h" => "Hello",
//     "Ey"
// ];
// foreach($arr as $key => $value) {
//     echo $key . " => " . $value . "<br>";
// }
function get_people($file) {
    $desc = file_get_contents($file);
    $pattern = '/<span itemprop="name">(.+?)<\/span>/u';
    $matches = [];
    preg_match_all($pattern,$desc,$matches);
    return $matches[1];
}
$names = [];
$dir = "./films/";
$files = scandir($dir);
foreach ($files as $file) {
    if ($file == '.' || $file == '..') {
        continue;
    }
    $members = get_people($dir.$file);
    foreach($members as $item) {
        if (!isset($names[$item])) {
            $names[$item] = 0;
        }
        $names[$item] += 1;
}
}
print_r($names);
 