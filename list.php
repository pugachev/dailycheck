<?php
  include 'lib/connect.php';
  include 'lib/daily.php';
  include 'lib/queryDaily.php';

  //カレンダー画面から取得した「月」と「日」
  $month = $_GET['month'];
  $day = $_GET['date'];
  $daily = new QueryDaily();
  $results = $daily->findAll($today);


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
                <tr>
                    <th>出費</th>
                    <td>1200円</td>
                    <th>カテゴリー</th>
                    <td>食品</td>
                    <th>品目</th>
                    <td>うどん</td>
                    <th>カロリー</th>
                    <td>450kcal</td>
                </tr>
                <tr>
                    <th>出費</th>
                    <td>4440円</td>
                    <th>カテゴリー</th>
                    <td>公共料金</td>
                    <th>品目</th>
                    <td>水道代</td>
                    <th>カロリー</th>
                    <td>0kcal</td>
                </tr>
                <tr>
                    <th>出費</th>
                    <td>1080円</td>
                    <th>カテゴリー</th>
                    <td>食品</td>
                    <th>品目</th>
                    <td>うどん焼き</td>
                    <th>カロリー</th>
                    <td>831kcal</td>
                </tr>
                <tr>
                    <th>出費</th>
                    <td>6350円</td>
                    <th>カテゴリー</th>
                    <td>Amazon</td>
                    <th>品目</th>
                    <td>キーボード</td>
                    <th>カロリー</th>
                    <td>0kcal</td>
                </tr>
                <tr>
                    <th>出費</th>
                    <td>1200円</td>
                    <th>カテゴリー</th>
                    <td>食品</td>
                    <th>品目</th>
                    <td>うどん</td>
                    <th>カロリー</th>
                    <td>450kcal</td>
                </tr>
                <tr>
                    <th>出費</th>
                    <td>1200円</td>
                    <th>カテゴリー</th>
                    <td>食品</td>
                    <th>品目</th>
                    <td>うどん</td>
                    <th>カロリー</th>
                    <td>450kcal</td>
                </tr>
                <tr>
                    <th>出費</th>
                    <td>1200円</td>
                    <th>カテゴリー</th>
                    <td>食品</td>
                    <th>品目</th>
                    <td>うどん</td>
                    <th>カロリー</th>
                    <td>450kcal</td>
                </tr>                <tr>
                    <th>出費</th>
                    <td>6350円</td>
                    <th>カテゴリー</th>
                    <td>Amazon</td>
                    <th>品目</th>
                    <td>キーボード</td>
                    <th>カロリー</th>
                    <td>0kcal</td>
                </tr>
                <tr>
                    <th>出費</th>
                    <td>1200円</td>
                    <th>カテゴリー</th>
                    <td>食品</td>
                    <th>品目</th>
                    <td>うどん</td>
                    <th>カロリー</th>
                    <td>450kcal</td>
                </tr>
                <tr>
                    <th>出費</th>
                    <td>1200円</td>
                    <th>カテゴリー</th>
                    <td>食品</td>
                    <th>品目</th>
                    <td>うどん</td>
                    <th>カロリー</th>
                    <td>450kcal</td>
                </tr>
                <tr>
                    <th>出費</th>
                    <td>1200円</td>
                    <th>カテゴリー</th>
                    <td>食品</td>
                    <th>品目</th>
                    <td>うどん</td>
                    <th>カロリー</th>
                    <td>450kcal</td>
                </tr>				
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