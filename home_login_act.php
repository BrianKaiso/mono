<?php
// session start
session_start();

// functions include
include(__DIR__.'/functions/functions.php');

//POST値
$users_email = $_POST["c_id"];
//$lpw = $_POST["c_pass"];
$lpw = filter_input( INPUT_POST, "c_pass" ); 

//無害化
$user_email = hCheck($users_email);
$lpw = hCheck($lpw);

//1.  DB接続します
$pdo = db_conn();

//2. データ登録SQL作成
//$sql="SELECT * from gs_user_table WHERE lid=:lid AND lpw=:lpw AND life_flg=1"; //バインド変数 life_fgは退会した人
// $sql="SELECT * FROM users WHERE users_email=:users_email AND lpw=:lpw AND life_fla=1";
$sql="SELECT * FROM mst_creater WHERE c_id=:users_email"; // hash化したpwdは下記でverifyするので、SQL文から外す
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':users_email',$users_email,PDO::PARAM_STR);
// $stmt->bindValue(':lpw',$lpw,PDO::PARAM_STR); //* Hash化する場合はコメントする
$status = $stmt->execute();// 成功ならtrue, 失敗ならfalse

// $sql="SELECT * FROM users WHERE lid=\"{$lid}\" AND lpw=\"{$lpw}\" AND life_fla=1";
// $stmt = $pdo->prepare($sql);
// $status = $stmt->execute();// 成功ならtrue, 失敗ならfalse

//var_dump($status);


//3. SQL実行時にエラーがある場合STOP
if($status==false){
   sql_error($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();         //1レコードだけ取得する方法 一致するユーザーは一人だけのはず
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()
//var_dump($val);

//5. 該当レコードがあればSESSIONに値を代入
if(password_verify($lpw, $val["c_pass"])){
 if( $val["c_id"] != "" ){
  //Login成功時
  session_regenerate_id(true); // 新しいidを取得 regenerateを他のページに置くと、更新ボタン連打でセッション切れが起きる
  $_SESSION["chk_ssid"]  = session_id(); //ログインが通った現在のsession idを渡す
  $_SESSION["user_auth"] = $val['user_auth']; //管理フラグを入れる 役員以上は削除できる、部長以上は編集できるなどレベル分けの振り分けが可能
  $_SESSION["users_name"] = $val['name']; 
  $_SESSION["users_id"] = $val['c_code'];
  
  // ログイン成功！Mypageに飛ばす
  redirect("home_mypage.php"); // 商品がカートに入っていない場合はindex.phpに飛ばす
 }
}else{
 //Login失敗時(Logout経由)
 $_SESSION["false"]=true;
 redirect("home_login.php");
}

exit();

?>

