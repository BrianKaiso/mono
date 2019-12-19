<?php
session_start(); // session start

header("Content-Type: application/json; charset=UTF-8"); //ヘッダー情報の明記。必須。

// functions include
// include(__DIR__.'/functions/functions.php');
include('../functions/functions.php');

// セラーマイページ home_mypage.phpからajaxで渡されたメアドをPOSTで受け取る
$email = $_POST["email"];

// 渡されたPOSTデータを無害化する
$email = hCheck($email);

// DBに接続して、基本情報を更新する。
$pdo = db_conn(); // include -> functions/functions.php -> function db_conn();

// (1) DBに同じEmailが使われていないか確認する
// SQL UPDATE文を作る POST送信されたc_id(email)と同じものかないか確認する。
$sql="SELECT c_id FROM mst_creater WHERE c_id=:email LIMIT 1"; 

//$sqlをprepareに渡してステートメントに入れる
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $email, PDO::PARAM_STR); 
$status = $stmt->execute(); // 成功ならtrue, 失敗ならfalse

// 結果 
if($status==false) {
    $result = "error"; 
    echo $result; // DB接続失敗
    exit;
    //sql_error($stmt); // include -> functions.php > function sql_error();
  }else{
    $r = $stmt->fetch();
    if(!empty($r)){
     // 入力されたメールアドレスをすでに使われています。
     $result = "used"; 
     echo $result; // すでに使われている
     exit;
    }else{
     // 入力されたメールアドレスは使用されていないので、UPDATEお実行する関数
     // SQL UPDATE文を作る
     $sql ="UPDATE mst_creater SET c_id=:email WHERE c_code = '{$_SESSION["users_id"]}'";

     //$sqlをprepareに渡してステートメントに入れる
     $stmt = $pdo->prepare($sql);
     $stmt->bindValue(':email', $email, PDO::PARAM_STR); 
     $status = $stmt->execute(); // 成功ならtrue, 失敗ならfalse

     if($status==false) {
        $result = false; 
        echo $result; // DB接続失敗
        //sql_error($stmt); // include -> functions.php > function sql_error();
     }else{
       //$r = $stmt->fetch();
       $result = true; 
       echo $result; // 接続成功
     }
     exit;
    }
  }

?>