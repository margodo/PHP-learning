<?php
$host = '127.0.0.1';
$db = 'movie_archive';
$user = 'root';
$pass = '';
$charset = 'utf8';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $opt);
    echo "Подключение успешно!\n";
} catch (PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
    exit;
}

// Функция для извлечения информации из HTML с использованием регулярных выражений
function extractFilmData($html) {
    $filmData = [];

    // Извлечение страны
    if (preg_match('/<h2>Страна<\/h2>:.*?<a href="[^"]+">([^<]+)<\/a>/', $html, $matches)) {
        $filmData['country'] = $matches[1];
    }

    // Извлечение IMDb рейтинга
    if (preg_match('/<span class="b-post__info_rates imdb"><a href="[^"]+">IMDb<\/a>: <span class="bold">([^<]+)<\/span>/', $html, $matches)) {
        $filmData['imdb_rating'] = $matches[1];
    }

    // Извлечение Кинопоиск рейтинга
    if (preg_match('/<span class="b-post__info_rates kp"><a href="[^"]+">Кинопоиск<\/a>: <span class="bold">([^<]+)<\/span>/', $html, $matches)) {
        $filmData['kp_rating'] = $matches[1];
    }

    // Извлечение даты выхода
    if (preg_match('/<h2>Дата выхода<\/h2>:</td> <td>(.*?)<\/td>/', $html, $matches)) {
        $filmData['release_date'] = $matches[1];
    }

    // Извлечение слогана
    if (preg_match('/<h2>Слоган<\/h2>:</td> <td>(.*?)<\/td>/', $html, $matches)) {
        $filmData['slogan'] = $matches[1];
    }

    return $filmData;
}

// Пример обработки HTML
$html = file_get_contents('film_page.html'); // Чтение файла HTML
$filmData = extractFilmData($html);

// Вставка данных в таблицы базы данных
try {
    // Вставка данных о фильме
    $stmt = $pdo->prepare("INSERT INTO films (title, release_date, duration, slogan, imdb_rating, kp_rating) 
                           VALUES (:title, :release_date, :duration, :slogan, :imdb_rating, :kp_rating)");

    $stmt->execute([
        'title' => 'Название фильма', // Здесь подставьте название фильма
        'release_date' => $filmData['release_date'],
        'duration' => 165, // Замените на правильную продолжительность
        'slogan' => $filmData['slogan'],
        'imdb_rating' => $filmData['imdb_rating'],
        'kp_rating' => $filmData['kp_rating']
    ]);

    // Получаем ID фильма
    $filmId = $pdo->lastInsertId();

    // Вставка страны в таблицу countries, если она еще не существует
    $stmt = $pdo->prepare("SELECT id FROM countries WHERE name = :name");
    $stmt->execute(['name' => $filmData['country']]);
    $country = $stmt->fetch();

    if (!$country) {
        // Если страна не найдена, вставляем ее в таблицу
        $stmt = $pdo->prepare("INSERT INTO countries (name) VALUES (:name)");
        $stmt->execute(['name' => $filmData['country']]);
        $countryId = $pdo->lastInsertId();
    } else {
        $countryId = $country['id'];
    }

    // Связываем фильм с его страной
    $stmt = $pdo->prepare("INSERT INTO film_country (film_id, country_id) VALUES (:film_id, :country_id)");
    $stmt->execute([
        'film_id' => $filmId,
        'country_id' => $countryId
    ]);

    echo "Данные успешно вставлены!\n";
} catch (PDOException $e) {
    echo "Ошибка при вставке данных: " . $e->getMessage();
}