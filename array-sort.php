<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$arr = array(
    0 => array(
        'id' => 1,
        'name' => 'abc',
        'marks' => 10
    ),
    1 => array(
        'id' => 2,
        'name' => 'bcd',
        'marks' => 11
    ),
    2 => array(
        'id' => 3,
        'name' => 'cde',
        'marks' => 9
    ),
);

function sortArray($array, $key, $sort){
    $sort = [];
    foreach ($array as $k => $v) {
        $sort[$key][$k] = $v[$key];
    }
    if(count($array) > 0){
        if($sort == 'asc'){
            array_multisort($sort[$key], SORT_ASC, $array);
        }else{
            array_multisort($sort[$key], SORT_DESC, $array);
        }
    }
    return $array;
}

var_dump($arr);
var_dump(sortArray($arr, 'marks', 'desc'));
