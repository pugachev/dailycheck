<?php
  include 'lib/connect.php';
  include 'lib/daily.php';
  include 'lib/queryDaily.php';


  //画面から取得した検索項目を受け取る
  if ((!empty($_POST['tgtFromdate']) || !empty($_POST['tgtTodate'])) || (!empty($_GET['tgtcategory'])))
  {


  }


  //カレンダー画面から取得した「月」と「日」
  // $yearmonth = $_GET['yearmonth'];
  $yearmonth = '2022/04';
  // $day = $_GET['day'];
  $day = '17';

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
    <link rel="stylesheet" href="css/search.css" />
    <link rel="stylesheet" href="css/list.css" />
    <title>入力画面</title>
  </head>
  <body>
    <?php include 'header.php';?>
    <main>
    <!-- 検索要テーブル -->
    <form action="search.php" method="post">
      <table class="search-table">
        <tbody>
          <tr>
            <th>日付(From)</th>
            <td><label><input type="date" name="tgtFromdate" size="30" value=""></label></td>
            <th>日付(From)</th>
            <td><label><input type="date" name="tgtTodate" size="30" value=""></label></td>
            <th>カテゴリー</th>
            <td>
              <div class="category cate">
                <select name="tgtcategory">
                  <option value="" hidden>選ぶ</option>
                  <option value="食費">食費</option>
                  <option value="日用品">日用品</option>
                  <option value="Amazon">Amazon</option>
                  <option value="医療費">医療費</option>
                  <option value="公共料金">公共料金</option>
                  <option value="税金">税金</option>
                  <option value="外食">外食</option>
                  <option value="その他">その他</option>
                </select>
              </div>
            </td>
            <td>
            <button class="button">検索</button>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
    <table  class="result-table">
            <div class="headinfo">
              <div class="tgthead">2022年05月05日</div>
              <div class="tgthead">出費計:3000</div>
              <div class="tgthead">カロリー計:1580</div>
            </div>
            <tbody>
              <?php 
                if(!empty($results))
                {
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
                }
                else
                {
                    echo "データが存在しません";
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
