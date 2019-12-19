<?php
// index.phpから送られてきたID
$id = $_GET["p_code"];

// DB接続
$pdo = db_conn();

$sql = "SELECT * FROM mst_content WHERE = '{$id}";

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

$view ="<div class=\"contentBox1\">";
$view .="<img src=\"img/{$r["c_file"]}\" />";
$view .= "</div><div class=\"contentBox2\"><h1>{$r["c_title"]}</h1>";
$view .= "<h2>{$r["comment"]}</h2>";
$view .= "<p>{$r["c_date"]}</p>";
$view .= "</div></div>"; // 終了タグ
echo $view;

?>