<?php

require_once "../dbconnect.php";

class UserLogic{
  /**
   * ユーザーを登録する。
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
   * ユーザーにログインする。
   * @param array $userData
   * @return boolean $result
   */

}

?>