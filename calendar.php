<?php
include 'lib/connect.php';
include 'lib/daily.php';
include 'lib/queryDaily.php';

$today = date("Y/m");
$daily = new Daily();
$results = $daily->findAll($today);






?>