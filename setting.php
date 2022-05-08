<?php
  include 'lib/connect.php';
  include 'lib/setting.php';
  include 'lib/querySetting.php';

  //入力処理
  if ((!empty($_POST['tgtmaxcalory']) || !empty($_POST['tgtmaxmoney'])) || (!empty($_GET['tgtmailaddress'])))
  {

    $tgtmaxcalory = $_POST['tgtmaxcalory'];
    $tgtmaxmoney = $_POST['tgtmaxmoney'];
    $tgtmailaddress = $_POST['tgtmailaddress'];


    $setting = new Setting();

    //パターン1 idがある場合(update)
    if ((!empty($_POST['id'])))
    {
      $setting->setId($_POST['id']);
      // print_r( $setting->getId());
      // die();
    }

    $setting->setTgtmaxcalory($tgtmaxcalory);
    $setting->setTgtmaxmoney($tgtmaxmoney);
    $setting->setTgtmailaddress($tgtmailaddress);

    $setting->save();

    header('Location: setting.php');

  }
  //通常の画面表示
  else
  {
    print_r("postしていない場合の通り道");
    //既存の値を取得して画面にだす
    $setting = new QuerySetting();
    $result = $setting->find();
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
    <title>設定画面</title>
  </head>
  <body>
    <?php include 'header.php';?>
    <main>
        <form action="setting.php" method="post">
          <table class="form-table">
            <tbody>
              <tr>
                <th>カロリー上限値</th>
                <td><input type="text" name="tgtmaxcalory" size="60" value="<?php if(!empty($result['tgtmaxcalory'])) { echo $result['tgtmaxcalory'];} ?>">
              </tr>
              <tr>
                <th>出費上限値</th>
                <td><input type="text" name="tgtmaxmoney" size="60" value="<?php if(!empty($result['tgtmaxmoney'])) { echo $result['tgtmaxmoney'];} ?>">
                </td>
              </tr>
              <tr>
                <th>メールアドレス</th>
                <td><input type="text" name="tgtmailaddress" size="60" value="<?php if(!empty($result['tgtmailaddress'])) { echo $result['tgtmailaddress'];} ?>">
                </td>
              </tr>
            </tbody>
          </table>
          <div class="button_wrapper">
            <input type="hidden" name="id" value="<?php if(!empty($result['id'])) { echo $result['id'];} ?>">
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
