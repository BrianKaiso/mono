<?php

session_start(); // session start

include('../functions/functions.php'); // 関数をinclude

if(!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] != session_id()){
    //ログインしていない状態で訪れた場合、ログイン画面に遷移。メッセージを表示するためのフラグも持たせる
    $_SESSION["checkout"]=true;
    redirect("home_login.php"); 
  }  

// 消去リンクで送られてきたid番号を取得し、無害化する
$id=$_GET["id"];
$id=hCheck($id);

//$_SESSION["users_id"];

// エラーを返すための変数を宣言
// $error=[];
// $_SESSION["intro_edit_check"]="";

// 該当するレコードをDBから削除する
            
$pdo = db_conn(); // include -> functions.php -> function db_conn();
$sql ="DELETE FROM mst_intro WHERE id=:id and c_code=:cid";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR); 
$stmt->bindValue(':cid', $_SESSION["users_id"], PDO::PARAM_STR); 
$status = $stmt->execute(); // 成功ならtrue, 失敗ならfalse

if($status==false) {
  $error[]="データーベースに接続ができませんでした。";
  $_SESSION["intro_edit_check"]=$error;
  redirect("../home_intro.php");
  exit;
}else{
  $error[]="一件削除しました！";
  $_SESSION["intro_edit_check"]=$error;
  redirect("../home_intro.php");
  exit;
}   

?>