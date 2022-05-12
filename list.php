<?php
  include 'lib/connect.php';
  include 'lib/daily.php';
  include 'lib/queryDaily.php';

  //「修正」or「削除」ボタン押下時に処理
  if ((!empty($_POST['id']) || !empty($_POST['tgtmoney']) || !empty($_POST['tgtcalory'])))
   {
    //「修正」の場合
    if(!empty($_POST['modify']))
    {
      $id = $_POST['id'];
      $tgtmoney = $_POST['tgtmoney'];
      $tgtcalory  = $_POST['tgtcalory'];

      $daily = new QueryDaily();
      $daily->update($id,$tgtmoney,$tgtcalory);

    }
     //「削除」の場合
    else if(!empty($_POST['delete']))
    {
      $id = $_POST['id'];
      $daily = new QueryDaily();
      $daily->delete($id);
    }

    header('Location: index.php');

  }

  //カレンダー画面から取得した「月」と「日」
  $yearmonth = $_GET['yearmonth'];
  $day = $_GET['day'];
  $tgtyearmonthdate=$yearmonth.'/'.$day;
  $daily = new QueryDaily();
  $results = $daily->find($tgtyearmonthdate);
  $head_reqults = $daily->findTotalByDaily($tgtyearmonthdate);
 
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
              <div class="tgthead"><?php echo  $tgtyearmonthdate; ?></div>
            </div>
            <div class="headinfo">
              <div class="tgthead2">出費計:<?php echo $head_reqults['totalmoeny']; ?> 円(差分:<?php echo $head_reqults['diffmoney']; ?> 円)</div>
              <div class="tgthead2">カロリー計:<?php echo $head_reqults['totalcalory']; ?> Kcal(差分:<?php echo $head_reqults['diffcalory']; ?> kcal)</div>
            </div>
            <tbody>
              <?php 
                foreach($results as $result){
                  echo "<tr>";
                  echo "<form action='list.php' method='post'>";
                  echo "<th>ID</th>";
                  echo '<td><input type="text" value='.$result["id"].' name="id" class="hoge"></td>';
                  echo "<th>出費</th>";
                  echo '<td><input type="text" value='.$result["tgtmoney"].' name="tgtmoney"  class="hoge"></td>';
                  echo "<th>カテゴリー</th>";
                  echo "<td>".$result["tgtcategory"]."</td>";
                  echo "<th>品目</th>";
                  echo "<td>".$result["tgtitem"]."</td>";
                  echo "<th>カロリー</th>";
                  echo '<td><input type="text" value='.$result["tgtcalory"].' name="tgtcalory"  class="hoge"></td>';
                  echo "<td><button class='button' name='modify' value='1' >修正</button></td>";
                  echo "<td><button class='button' name='delete' value='2' >削除</button></td>";
                  echo "</form>";
                  echo "</tr>";
                }
              ?>
            </tbody>
         </table>
        </form>
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