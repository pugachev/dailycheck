<?php
include 'lib/connect.php';
include 'lib/daily.php';
include 'lib/queryDaily.php';

$today = date("Y/m");
$daily = new QueryDaily();
$results = $daily->findAll($today);

$json=json_encode($results,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);

// print_r($json);
// die();
echo $json;

?>