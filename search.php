<?php
include 'lib/connect.php';
include 'lib/daily.php';
include 'lib/queryDaily.php';

if ((!empty($_POST['tgtdate']) && !empty($_POST['tgtcategory'])) || (!empty($_GET['tgtitem']))) {

  $tgtdate = $_POST['tgtdate'];
  $tgtcategory = $_POST['tgtcategory'];
  $tgtitem = $_POST['tgtitem'];
  $tgtmoney = $_POST['tgtmoney'];
  $tgtcalory = $_POST['tgtcalory'];

  $daily = new Daily();
  $daily->setDate(str_replace("-","/",$tgtdate));
  $daily->setCategory($tgtcategory);
  $daily->setItem($tgtitem);
  $daily->setMoney($tgtmoney);
  $daily->setCalory($tgtcalory);

  $daily->save();

}
?>
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
    <link rel="stylesheet" href="css/input.css" />
    <title>入力画面</title>
  </head>
  <body>
    <?php include 'header.php';?>
    <main>

    </main>
    <footer>
      <div class="copy">
        <p>Copyright(c) 2005-2022 ikefukuro_40 . All Rights Reserved.</p>
      </div>
    </footer>
    <script src="jquery-3.5.1.min.js"></script>
    <script src="humberger.js"></script>
  </body>
</html>
