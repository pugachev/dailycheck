<?php
  include 'lib/connect.php';
  include 'lib/daily.php';
  include 'lib/queryDaily.php';
  include 'lib/querySearch.php';

  //画面から取得した検索項目を受け取る
  if ((!empty($_POST['tgtFromdate']) || !empty($_POST['tgtTodate'])))
  {
    // print_r($_POST['tgtFromdate'].'   '.$_POST['tgtTodate']);
    // die();
    //画面から渡された条件で検索する
    $search = new QuerySearch();
    $results = $search->search($_POST['tgtFromdate'],$_POST['tgtTodate']);
    // print_r($results);
    // die();
  }


  //カレンダー画面から取得した「月」と「日」
  // $yearmonth = $_GET['yearmonth'];
 
  // $day = $_GET['day'];


  // $yearmonth = '2022/04';
  // $day = '17';
  // $tgtyearmonthdate=$yearmonth.'/'.$day;
  // $daily = new QueryDaily();
  // $results = $daily->find($tgtyearmonthdate);

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
            <th>日付(To)</th>
            <td><label><input type="date" name="tgtTodate" size="30" value=""></label></td>
            <!-- <th>カテゴリー</th>
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
            </td> -->
            <td>
            <button class="button">検索</button>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
    <?php 
      if(!empty($results))
      {
         echo '<table  class="result-table">';
         echo '<tbody>';
        foreach($results as $result)
        {
          echo "<tr>";
          echo "<th>日付</th>";
          echo "<td>".$result["tgtdate"]."</td>";
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
        echo '</tbody>';
        echo '</table>';
      }
      else
      {
          echo '<div id="alert">データは存在しません！</div>';
      }
   ?>
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
