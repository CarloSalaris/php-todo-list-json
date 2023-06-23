<?php

header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: application/json');

$file = "data.json";

//receive
$index = $_POST['index'];

//decode
$dataStr = file_get_contents($file);
$tasks = json_decode($dataStr, true);

//Action
if ($tasks[$index]["doneTask"] == "true") {
    $tasks[$index]["doneTask"] = "false";
}else {
    $tasks[$index]["doneTask"] = "true";
};



//encode
$dataStr = json_encode($tasks);

//save + send
file_put_contents($file, $dataStr);
echo $dataStr;

?>