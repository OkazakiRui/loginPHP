<?php

require_once "../dbconnect.php";

class UserLogic{

  /**
   * 新規登録の処理
   * @param array $userData
   * @return boolean $result
   */

  public static function createUser($userData){
    $result = false;

    $sql = "insert into users (name, email, password) value (?, ?, ?)";
    // ユーザーデータを配列に入れる
    $arr = [];
    $arr[] = $userData["username"];
    $arr[] = $userData["email"];
    $arr[] = password_hash($userData["password"], PASSWORD_DEFAULT);
    // password_hash($userData["password"], PASSWORD_DEFAULT); パスワードをハッシュ化している

    try{
      $stmt = connect() -> prepare($sql);
      // connect() -> prepare($sql); 接続の準備をしている。
      $result = $stmt -> execute($arr);
      // execute($arr); で実行 正しく実行できた場合は true が返る
      return $result;
      
    }catch(\Exception $e){
      return $result;
    }
  }

  /**
   * ログイン処理
   * @param string $email
   * @param string $password
   * @return boolean $result
   */

  public static function login($email, $password){
    // 結果
    $result = false;

    // ユーザーをemailから検索して取得
    $user = self::getUserByEmail($email);
    // self::getUserByEmail($email); → 同じクラス内なので self:: を使う(js → this)
     
    if(!$user){
      $_SESSION["msg"] = "メールアドレスが一致しません。";
      return $result;
    }

    // パスワードの照会
    if(password_verify($password, $user["password"])){
      // セッションハイジャック対策
      session_regenerate_id(true);
      // セッションを新しく作り直す

      // ログイン成功
      $_SESSION["login_user"] = $user;
      $result = true;
      return $result;

    }else{
      $_SESSION["msg"] = "パスワードが一致しません。";
      return $result;
    }

  }

  /**
   * emailからユーザーを取得
   * @param string $email
   * @return array|boolean $user|false
   */

  public static function getUserByEmail($email){
    $result = false;
    
    // SQLの準備
    $sql = "select * from users where email = ?";
    
    $arr = [];
    $arr[] = $email;
    
    // SQLの実行
    try{
      $stmt = connect() -> prepare($sql);
      // $result = $stmt -> execute($email);
      $stmt -> execute($arr);
      // executeの引数は配列である必要がある。
      
      // SQLの結果を返す
      $user = $stmt -> fetch();
      return $user;
      
    }catch(\Exception $e){
      return false;
    }
  }


  /**
   * ログインしているかを判別する
   * @param void
   * @return boolean $result
   */
  public static function checkLogin(){
    $result = false;

    // セッションにログインユーザーが履いていなかったらfalse
    if(isset($_SESSION["login_user"]) && $_SESSION["login_user"]["id"] !== 0 ){
      return $result = true;
    }

    return $result;
  }

  /**
   * ログアウト処理
   * @param void
   * @return void
   */
  public static function logout(){
    // セッション変数を全て解除する
    $_SESSION = array();
    
    // セッションを切断するにはセッションクッキーも削除する。
    // Note: セッション情報だけでなくセッションを破壊する。
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    // 最終的に、セッションを破壊する
    session_destroy();
  }

}

?>