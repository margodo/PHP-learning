<?php
// Task 1
function generateRandomStr($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    $maxIndex = strlen($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $randomIndex = rand(0, $maxIndex);
        if ($randomIndex % 2 == 1) {
            $randomString .= "<b>".$characters[$randomIndex]."</b>";
        } else {
            $randomString .= $characters[$randomIndex];
        }
    }

    return $randomString;
}

// Task 2
function generateRandomString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    $maxIndex = strlen($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $randomIndex = rand(0, $maxIndex);
        $randomString .= $characters[$randomIndex];
    }
    return $randomString;
}

function isVowel($char) {
    $vowels = "aeiouAEIOU";
    return strpos($vowels,$char) !== false;
}

function formatString($string) {
    $formatted = "";
    for ($ind = 0; $ind < strlen($string); $ind++) {
        if (isVowel($string[$ind])) {   
            $formatted .= strtoupper($string[$ind]);
        } 
        else {
            $formatted .= "<i>" . $string[$ind] . "</i>";
        }
    }
    return $formatted;
}

// Task 3
function translit($string) {
    $letters = [
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'ye', 'ё' => 'yo', 'ж' => 'zh', 'з' => 'z',
        'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r',
        'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'ts', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
        'ы' => 'y', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya',

        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh', 'З' => 'Z',
        'И' => 'I', 'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O', 'П' => 'P', 'Р' => 'R',
        'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'Ts', 'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',
        'Ы' => 'Y', 'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya'
    ];
    $result = '';
    for ($i = 0; $i < strlen($string); $i++) {
        $char = $string[$i];
        if (! isset($letters[$char])) {
            $result .= $letters[$char];
        } else {
            $result .= $char;
        }
    }
    return $result;
}

// Task 4
function generateNumberString($length = 10) {
    $num = '';
    for ($i = 0; $i < $length; $i++) {
        $num .= strval(rand(0,9));
    }
    return $num;
}

function decode($strNum) {
    $letters = "abcdefghijklmnopqrstuvwxyz";
    $result = "";
    $i = 0;
    while ($i < strlen($strNum)) {
        if (mb_substr($strNum,$i,1) == 0) {
            $result .= $letters[0];
        }
        if ($i + 1 < strlen($strNum)) {
            $curr = mb_substr($strNum,$i,2);
            if (intval($curr) < strlen($letters)) {
                $result .= $letters[intval($curr)];
                $i += 2;
            } }
        $curr = mb_substr($strNum,$i,1);
        $result .= $letters[intval($curr)];
        $i += 1;
    }
    return $result;
}

// Task 5

$characters = 'abcdefghijklmnopqrstuvwxyz';

function randomString($length) {
    global $characters;
    $randomString = '';
    $maxIndex = strlen($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $randomIndex = rand(0, $maxIndex);
        $randomString .= $characters[$randomIndex];
    }
    return $randomString;
}

function createArr() {
    $myArr = [];
    for ($j = 0; $j < 10; $j ++) {
        $myArr[] = randomString(rand(10,25));
    }
    return $myArr;
}

function sumOfStringNumb($arr) {
    global $characters;
    $sum = [];
    for ($k=0;$k<count($arr);$k++) {
        $temp = 0;
        for ($l=0;$l<strlen($arr[$k]);$l++) {
            $temp += strval(strpos($characters,$arr[$k][$l]));
        }
        $sum[] = $temp;
    }
    return $sum;
}

function convertNumbToChar($strNum) {
    $letters = "abcdefghijklmnopqrstuvwxyz";
    $result = "";
    $i = 0;
    while ($i < strlen($strNum)) {
        if (mb_substr($strNum,$i,1) == 0) {
            $result .= $letters[0];
        }
        if ($i + 1 < strlen($strNum)) {
            $curr = mb_substr($strNum,$i,2);
            if (intval($curr) < strlen($letters)) {
                $result .= $letters[intval($curr)];
                $i += 2;
            } }
        $curr = mb_substr($strNum,$i,1);
        $result .= $letters[intval($curr)];
        $i += 1;
    }
    return $result;
}

function convertNumbArrToStrArr($arr) {
    $sumArr = [];
    $result = '';
    for ($i=0; $i<count($arr); $i++) {
        $sumArr[] = convertNumbToChar($arr[$i]);
        $result .= $sumArr[$i]; 
    }
    echo $result;
    return $sumArr;
}

$arr = createArr();
$sum = sumOfStringNumb($arr);
echo "<pre>";
print_r($arr);
print_r($sum);
print_r(convertNumbArrToStrArr($sum));

// Task 6
$operationTypes = [
    'increaseBy',
    'reduceBy',
    'increaseByTimes',
    'reduceByTimes'
];

function applyOperation($operation, $value, $argument) {
    if ($operation == 'increaseBy') {
        return $value + $argument;
    } elseif ($operation =='reduceBy') {
        return $value - $argument;
    } elseif ($operation =='increaseByTimes') {
        return $value * $argument;
    } elseif ($operation =='reduceByTimes') {
        return $value / $argument;
    } else {
        return $value;
    }
}

function generateRandomOperations($count) {
    global $operationTypes;
    $operations = [];
    for ($i = 0; $i < $count; $i++) {
        $operations[] = $operationTypes[rand(0,count($operationTypes)-1)];
    }
    return $operations;
}

function generateRandomArrays($size) {
    $array = [];
    for ($i = 0; $i < $size; $i++) {
        $array[] = rand(1, 100);
    }
    return $array;
}

// Main logic
$operations = generateRandomOperations(5);
$array1 = generateRandomArrays(10);
$array2 = generateRandomArrays(10);
$results = [];
foreach ($array1 as $index => $value) {
    $val = $value;
    for ($j = 0; $j < count($operations); $j ++){
        $operation = $operations[$j];
        $argument = $array2[$index];
        $val = round(applyOperation($operation, $val, $argument),2);
    }
    $results[] = $val;   
}
echo "Operations:<pre>";
print_r($operations);
echo "First array:<pre>";
print_r($array1);
echo "Second array(arguments):<pre>";
print_r($array2);
echo "Result:<pre>";
print_r($results);
