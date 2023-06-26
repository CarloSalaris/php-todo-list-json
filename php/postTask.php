<?php

header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: application/json');

$file = "data.json";

//receive
$newTask = $_POST;
$newTask["doneTask"] = false;

//decode
$dataStr = file_get_contents($file);
$data = json_decode($dataStr);

//Action
if ($newTask["text"] !== "") {
    $data[] = $newTask; //Push newTask to $data Array
}


//encode
$encData = json_encode($data);

//save + send
file_put_contents($file, $encData);
echo $encData;

?>