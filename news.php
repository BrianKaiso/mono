<?php
// index.phpから送られてきたID
$id = $_GET["p_code"];

// DB接続
$pdo = db_conn();

$sql = "SELECT * FROM dat_news WHERE = '{$id}";

//２．$sqlをprepareに渡してステートメントに入れる
$stmt = $pdo->prepare($sql);
$status = $stmt->execute(); // 成功ならtrue, 失敗ならfalse

if($status==false) {
  sql_error($stmt); // include -> functions.php > function sql_error();
  }else{
  $r = $stmt->fetchAll();
}

$pdo=null;
// DB接続エンドHere

$view ="<div class=\"newsBox\">";
$view .="<img src=\"img/{$r["n_img"]}\" />";
$view .= "</div><div class=\"prodetailBox2\"><h1>{$r["title"]}</h1>";
$view .= "<h2>{$r["article"]}</h2>";
$view .= "<p>{$r["date"]}</p>";
$view .= "</div>"; // 終了タグ
echo $view;

?>