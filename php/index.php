<?php

header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: application/json');

$todoElementStr = file_get_contents('data.json');
echo $todoElementStr;

?>