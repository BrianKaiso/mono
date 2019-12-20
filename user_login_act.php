<?php
session_start();

//POST値
$users_email = $_POST["users_email"];
$users_lpw = $_POST["users_lpw"];

//1.  DB接続します
//便利な関数を収めたfunctions.phpをinclude
include(__DIR__.'/functions.php');
$pdo = db_conn();

$sql="SELECT * FROM users WHERE users_email=:users_email"; // hash化したpwdは下記でverifyするので、SQL文から外す
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':users_email',$users_email,PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status==false){
    sql_error($stmt);
 }

 //4. 抽出データ数を取得
$val = $stmt->fetch();         //1レコードだけ取得する方法 一致するユーザーは一人だけのはず

//5. 該当レコードがあればSESSIONに値を代入
if(password_verify($lpw, $val["lpw"])){
    if( $val["users_email"] != "" ){
     //Login成功時
     $_SESSION["chk_ssid"]  = session_id(); //ログインが通った現在のsession idを渡す
     $_SESSION["user_auth"] = $val['user_auth']; //管理フラグを入れる 役員以上は削除できる、部長以上は編集できるなどレベル分けの振り分けが可能
     $_SESSION["users_name"] = $val['users_name']; 
     $_SESSION["users_id"] = $val['users_id'];
   
        if($_SESSION["checkout"]){
        redirect("user.php"); 
      }
    }else{
      //Login失敗時(Logout経由)
     $_SESSION["false"]=1;
     redirect("user_login.php");
    }
  }
    exit();