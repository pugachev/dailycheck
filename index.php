<?php
include 'lib/connect.php';
include 'lib/daily.php';
include 'lib/queryDaily.php';

$today="";
if ((!empty($_GET['tgtyyyymm']))) 
{
    //「前月へ」と「翌月へ」から取得したyyyyMMを使用する
    $today = $_GET['tgtyyyymm'];
}
else
{
    //画面の初回表示時点のyyyyMMをシステムから取得して使用する
    $today = date("Y/m");
}

$daily = new QueryDaily();
$results = $daily->findAll($today);

$json=json_encode($results,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);

// print_r($json);
// die();
echo $json;

?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="sanitize.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/calendar.css" />
    <title>カレンダー画面</title>
  </head>
  <body>
  <?php include 'header.php';?>
    <main>
    <div id="wrap">
	<div id="mini-calendar"></div>
</div>
    </main>
    <?php include 'footer.php';?>
  </body>
</html>