<?php
session_start();
require_once "../functions.php";
require_once "../classes/UserLogic.php";

$result = UserLogic::checkLogin();
if($result){
  header("location: mypage.php");
  return;
}



$login_err = isset($_SESSION["login_err"]) ? $_SESSION["login_err"] : null;
unset($_SESSION["login_err"]);
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ユーザー登録画面</title>
  </head>

  <body>
    <h2>ユーザー登録フォーム</h2>
    <?php if(isset($login_err)): ?>
      <p style="color:red;"><?php echo $login_err; ?></p>
    <?php endif; ?>
    <form method="post" action="register.php">
      <p>
        <label>ユーザー名：<input type="text" name="username" /></label>
      </p>
      <p>
        <label>メールアドレス：<input type="text" name="email" /></label>
      </p>
      <p>
        <label>パスワード：<input type="password" name="password" /></label>
      </p>
      <p>
        <label
          >パスワード確認：<input type="password" name="password_conf"
        /></label>
      </p>

      <input type="hidden" name="csrf_token" value="<?php echo h(setToken()); ?>">

      <button type="submit">新規登録</button>
    </form>
    <a href="./login_form.php">ログインはこちら</a>
  
  </body>
</html>
