<?php
  include 'lib/connect.php';
  include 'lib/daily.php';
  include 'lib/queryDaily.php';

  //カレンダー画面から取得した「月」と「日」
  $yearmonth = $_GET['yearmonth'];
  $day = $_GET['day'];

  $tgtyearmonthdate=$yearmonth.'/'.$day;
  $daily = new QueryDaily();
  $results = $daily->find($tgtyearmonthdate);

 
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
    <link rel="stylesheet" href="css/list.css" />
    <title>一覧画面</title>
  </head>
  <body>
  <?php include 'header.php';?>
    <main>
	<table>
            <div class="headinfo">
              <div class="tgthead">2022年05月05日</div>
              <div class="tgthead">出費計:3000</div>
              <div class="tgthead">カロリー計:1580</div>
            </div>
            <tbody>
              <?php 
                foreach($results as $result){
                  echo "<tr>";
                  echo "<th>出費</th>";
                  echo "<td>".$result["tgtmoney"]."</td>";
                  echo "<th>カテゴリー</th>";
                  echo "<td>".$result["tgtcategory"]."</td>";
                  echo "<th>品目</th>";
                  echo "<td>".$result["tgtitem"]."</td>";
                  echo "<th>カロリー</th>";
                  echo "<td>".$result["tgtcalory"]."</td>";
                  echo "</tr>";
                }
              ?>
            </tbody>
        </table>
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