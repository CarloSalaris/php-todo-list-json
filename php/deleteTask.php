<?php

header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: application/json');

$file = "data.json";

//receive
$index = $_POST['index'];

//decode
$dataStr = file_get_contents($file);
$tasks = json_decode($dataStr);

array_splice($tasks, $index, 1);

//encode
$dataStr = json_encode($tasks);

//save + send
file_put_contents($file, $dataStr);
echo $dataStr;

?>