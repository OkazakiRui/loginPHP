<?php
require_once "../functions.php";
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
  </body>
</html>
