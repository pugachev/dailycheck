<?php

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
    <title>レスポンシブ対応</title>
  </head>
  <body>
  <?php include 'header.php';?>
    <main>


	<!-- メイン開始 -->
  <form action="post" url="">
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
                <option value="1">食費</option>
                <option value="2">日用品</option>
                <option value="3">Amazon</option>
                <option value="4">医療費</option>
                <option value="5">公共料金</option>
                <option value="6">税金</option>
                <option value="7">外食</option>
                <option value="8">その他</option>
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
