<?php
echo "<pre>";
$subject = file_get_contents('');
$pattern = '';
$blocks = preg_split($pattern,$subject);
unset($blocks[0]);
$rests = [];

foreach ($blocks as $block) {
    $pattern = '';
    $matches = [];
    preg_match_all($pattern,$block,$matches);
    $rests[] = ["name" => $matches[2][0], "link" => $matches[1][0]];


}

$host = '127.0.0.1';
$db = '';
$user = '';
$pass = '';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
PDO::ATTR_EMULATE_PREPARES => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

$stmt = $pdo->prepare("
    INSERT INTO
    `rests` (
        `name`,
        `link`
    ) VALUES (
        :name,
        :link    
    )
");

foreach ($rests as $rest) {
    $stmt->execute([
    ':name' => $rest['name'],
    ':link' => $rest['link']
    ]);
}
