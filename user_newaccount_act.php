<?php
// session start
session_start();

header("Content-Type: application/json; charset=UTF-8"); //ヘッダー情報の明記。必須。
include('functions.php');

$name = filter_input( INPUT_POST, "name" ); 
$post1 = filter_input( INPUT_POST, "post1" ); 
$post2 = filter_input( INPUT_POST, "post2" );
$pref = filter_input( INPUT_POST, "pref" ); 
$city = filter_input( INPUT_POST, "city" ); 
$address = filter_input( INPUT_POST, "address" ); 
$phone = filter_input( INPUT_POST, "phone" ); 
$email = filter_input( INPUT_POST, "email" ); 
$pwd = filter_input( INPUT_POST, "pwd" ); 

// 郵便番号をハイフンでつなぐ
$post = $post1."-".$post2;

$data = [$name,$post,$pref,$city,$address,$phone,$email,$pwd]; // 一気にhtmlタグエスケープするために配列にしておく

// htmlタグエスケープ hCheck() > functions.phpに用意したユーザー定義関数(htmlspeciachar)
$data = hCheck($data);

// echo json_encode($data); 
// exit; // newaccount.phpでエラーメッセージを表示して終了

$result; // ユーザー登録結果を返す変数(エラーもしくは成功)

// すでに同じメールが登録されていないかチェックする
//1.  DB接続します
$pdo = db_conn(); // include -> functions.php -> function db_conn();

// 渡されたemailでusersテーブルを検索する
$sql ="SELECT * FROM users WHERE users_email=:email LIMIT 1";

//２．$sqlをprepareに渡してステートメントに入れる
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email',$data[6],PDO::PARAM_STR);
$status = $stmt->execute(); // 成功ならtrue, 失敗ならfalse

if($status==false) {
    sql_error($stmt); // include -> functions.php > function sql_error();
  }else{
    $r = $stmt->fetch();
  }

  // DBに同じデータがある > $rに入る > true, DBに同じデータがない > $rはfalse
  if($r){
    // echo json_encode("同じデータがある"); 
    $result = false;
    echo json_encode($result); 
    // $pdo=null;
    exit; // newaccount.phpでエラーメッセージを表示して終了
  }else{
    // echo json_encode("同じデータが無い"); 
    // 同じメアドが無いので、新規ユーザーであることを確認した。DBに新しいユーザーを登録する
   $sql="INSERT INTO users(lpw,users_name,users_address,users_city,users_pref,user_post,users_phone,users_email) VALUES(:lpw,:name,:address,:city,:pref,:post,:phone,:email)";

   $stmt = $pdo->prepare($sql);

   $stmt->bindValue(':lpw', password_hash($data[7], PASSWORD_DEFAULT), PDO::PARAM_STR); // hash化
   $stmt->bindValue(':name', $data[0], PDO::PARAM_STR); 
   $stmt->bindValue(':address', $data[4], PDO::PARAM_STR);
   $stmt->bindValue(':city', $data[3], PDO::PARAM_STR);
   $stmt->bindValue(':pref', $data[2], PDO::PARAM_STR);
   $stmt->bindValue(':post', $data[1], PDO::PARAM_STR);
   $stmt->bindValue(':phone', $data[5], PDO::PARAM_STR);
   $stmt->bindValue(':email', $data[6], PDO::PARAM_STR);

   $status = $stmt->execute(); // 成功ならtrue, 失敗ならfalse

//４．データ登録処理後
 if($status==false){
    sql_error($stmt);
  }else{
    // redirect("index.php");
    $_SESSION["newacc"]=true;
    // redirect("login.php");
    $result = true;
    echo json_encode($result); 
    // $pdo=null;
    exit; // newaccount.phpでエラーメッセージを表示して終了
  }

} // if文ここまで

//$pdo=null;
exit;
?>