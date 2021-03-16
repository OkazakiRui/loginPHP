<?php
session_start();
$err = $_SESSION;
$_SESSION = array();
session_destroy();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン画面</title>
</head>
<body>
    <h2>ログインフォーム</h2>
    <?php if(isset($err["msg"])): ?>
      <p style="color:red;"><?php echo $err["msg"]; ?></p>
    <?php endif; ?>
    <form method="post" action="top.php">
      <p>
        <label>メールアドレス：<input type="text" name="email" /></label>
        <p style="color:red;">
          <?php echo $err["email"]? $err["email"] : ""; ?>
        </p>
      </p>
      <p>
        <label>パスワード：<input type="password" name="password" /></label>
        <?php if(isset($err["password"])): ?>
          <p style="color:red;"><?php echo $err["password"]; ?></p>
        <?php endif; ?>
      </p>
      <button type="submit">ログイン</button>
    </form>
    <a href="./signup_form.php">新規登録はこちら</a>
  
</body>
</html>