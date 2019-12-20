<?php
session_start(); // session start

header("Content-Type: application/json; charset=UTF-8"); //ヘッダー情報の明記。必須。

if(!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] != session_id()){
    //ログインしていない状態で訪れた場合、ログイン画面に遷移。メッセージを表示するためのフラグも持たせる
    $_SESSION["checkout"]=true;
    redirect("home_login.php"); 
  }  

// functions include
// include(__DIR__.'/functions/functions.php');
include('../functions/functions.php');

// セラーマイページ home_mypage.phpからajaxで渡された基本内容をPOSTで受け取る
$name_in_charge = $_POST["name_in_charge"];
$postal1 = $_POST["postal1"];
$postal2 = $_POST["postal2"];
$pref = $_POST["pref"];
$city = $_POST["city"];
$address = $_POST["address"];
$tel = $_POST["tel"];

// 渡されたPOSTデータを無害化するために、渡された値を$data配列に入れる
$data=[$name_in_charge,$postal1,$postal2,$pref,$city,$address,$tel];
$data = hCheck($data);

// DBに接続して、基本情報を更新する。
$pdo = db_conn(); // include -> functions/functions.php -> function db_conn();

// SQL UPDATE文を作る
$sql ="UPDATE mst_creater SET name_in_charge=:name_in_charge,postal1=:postal1,postal2=:postal2,pref=:pref,city=:city,address=:address,tel=:tel WHERE c_code = '{$_SESSION["users_id"]}'";

//２．$sqlをprepareに渡してステートメントに入れる
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name_in_charge', $data[0], PDO::PARAM_STR); 
$stmt->bindValue(':address', $data[5], PDO::PARAM_STR);
$stmt->bindValue(':city', $data[4], PDO::PARAM_STR);
$stmt->bindValue(':pref', $data[3], PDO::PARAM_STR);
$stmt->bindValue(':postal1', $data[1], PDO::PARAM_STR);
$stmt->bindValue(':postal2', $data[2], PDO::PARAM_STR);
$stmt->bindValue(':tel', $data[6], PDO::PARAM_STR);
$status = $stmt->execute(); // 成功ならtrue, 失敗ならfalse

if($status==false) {
    $result = false; 
    echo $result;
    //sql_error($stmt); // include -> functions.php > function sql_error();
  }else{
    //$r = $stmt->fetch();
    $result = true; 
    echo $result;
  }
  exit;
?>