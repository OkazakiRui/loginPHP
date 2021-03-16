<?php

session_start();

require_once "../classes/UserLogic.php";

// エラーメッセージ
$err = [];

// バリデーション
if(!$email = filter_input(INPUT_POST, "email")){
  $err["email"] = "メールアドレスを入力してください。";
}
$password = filter_input(INPUT_POST, "password");
if(!$password){
  $err["password"] = "パスワードを入力してください。";
}

// エラーがあった場合の処理
if(count($err) !== 0){
  // エラーがあった場合は戻す
  header("location: login_form.php");
  $_SESSION = $err;
  return;
}

// ログイン可否のリクエスト
$result = UserLogic::login($email, $password);

// ログイン失敗時の処理
if(!$result){
  header("location: login_form.php");
  return;
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン完了</title>
</head>

<body>
  <?php if(count($err) !== 0) : ?>
    <?php foreach($err as $e): ?>
      <p><?php echo $e ?></p>
    <?php endforeach ?>
  <?php else: ?>
    <h2>ログイン完了</h2>
    <p>ログインしました。</p>
  <?php endif ?>

  <a href="./mypage.php">マイページへ</a>
</body>

</html>