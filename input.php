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


	<!-- メイン開始 -->
  <form action="input.php" method="post">
    <table class="form-table">
      <tbody>
        <tr>
          <th>日付</th>
          <td><label><input type="date" name="tgtdate" size="30" value=""></label>
          </td>
        </tr>
        <tr>
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
        </tr>
        <tr>
          <th>品目</th>
          <td><input type="text" name="tgtitem" size="60" value="">
          </td>
        </tr>
        <tr>
          <th>出費</th>
          <td><input type="text" name="tgtmoney" size="60" value="">
          </td>
        </tr>
        <tr>
          <th>カロリー</th>
          <td><input type="text" name="tgtcalory" size="60" value="">
          </td>
        </tr>
      </tbody>
    </table>
    <div class="button_wrapper">
      <button class="button">登録</button>
      <button class="button">キャンセル</button>
    </div>
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
