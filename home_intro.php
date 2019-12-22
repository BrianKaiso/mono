<?php
   // session start
   session_start();

   // functions include
   include(__DIR__.'/functions/functions.php'); 

   if(!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] != session_id()){
     //ログインしていない状態で訪れた場合、ログイン画面に遷移。メッセージを表示するためのフラグも持たせる
     $_SESSION["checkout"]=true;
     redirect("home_login.php"); 
   }    

   // html header include
   include(__DIR__.'/include/home/header.php'); 

   // DBよりセラー情報を取得
   // var_dump($_SESSION["users_id"]); セラーidが入っている

   // 1.  DB接続します
   $pdo = db_conn(); // include -> functions.php -> function db_conn();

   // 2. $sql ="SELECT * FROM products WHERE products_cat_id = 2 ORDER BY products_id DESC";
   $sql ="SELECT * FROM mst_creater WHERE c_code = '{$_SESSION["users_id"]}'";

   //3 ．$sqlをprepareに渡してステートメントに入れる
   $stmt = $pdo->prepare($sql);
   $status = $stmt->execute(); // 成功ならtrue, 失敗ならfalse
 
   if($status==false) {
     sql_error($stmt); // include -> functions.php > function sql_error();
   }else{
     $r = $stmt->fetch();
 }

   // 自己紹介文一覧表示
   $sql ="SELECT * FROM mst_intro WHERE c_code = '{$_SESSION["users_id"]}'";
   $stmt = $pdo->prepare($sql);
   $status = $stmt->execute(); // 成功ならtrue, 失敗ならfalse
 
   $view = '';
   $str_text = '';
   $odd = 0;
   if($status==false) {
     sql_error($stmt); // include -> functions.php > function sql_error();
   }else{
    while($r2 = $stmt->fetch(PDO::FETCH_ASSOC)){  
      $str_text = '';
      $str_text = mb_substr($r2['text'],0,50);
      $str_text .= $str_text."...";
      $odd++;
      if($odd%2 === 0){
        $view .= "<div class=\"intro bgodd\"><div class=\"sm\"><img src='home/intro/{$_SESSION["users_id"]}/{$r2['media']}' /></div><div class=\"lg\"><p>{$r2['title']}</p><pre>{$str_text}</pre></div><div class=\"sm\"><a class=\"accBtn2\" href='home/home_intro_delete.php?id={$r2['id']}&media={$r2['media']}'>削除</a></div></div>";
      }else{
      $view .= "<div class=\"intro\"><div class=\"sm\"><img src='home/intro/{$_SESSION["users_id"]}/{$r2['media']}' /></div><div class=\"lg\"><p>{$r2['title']}</p><pre>{$str_text}</pre></div><div class=\"sm\"><a class=\"accBtn2\" href='home/home_intro_delete.php?id={$r2['id']}&media={$r2['media']}'>削除</a></div></div>";
    }  
  }
 }

if(empty($view)){
  // データが無いとき
  $view ="<p>自己紹介ページ用のコンテンツはまだ投稿されておりません。さっそく情報を登録しましょう！</p><br />";
}

$pdo=null;
// DB接続エンドHere

// JSの処理で使用するのでセッションIDをJSの変数に渡しておく
// $_SESSION["users_id"];

?>

<h1>マイページ - 自己紹介</h1>
<?php
// navigation include
include(__DIR__.'/include/home/mypagenav.php');  
?>

<!-- マイページ基本情報表示と更新  -->
  <p class="space"><strong><?=$r["name"] ?></strong>さんのストーリー、こだわりを教えてください！ここで登録した情報は自己紹介ページで表示されます。</p> <!-- 社名/屋号  -->
  <!-- 登録フォームを表示する   -->
  <h2>情報登録</h2>

  <?php
  // エラーメッセージ表示
    if(isset($_SESSION["intro_edit_check"])){
      $error="";
      foreach( $_SESSION["intro_edit_check"] as $val ) {
        $error .= "<p class=\"space red\">";
        $error .= "$val";
        $error .= "</p>";
    }
        echo $error;
        $_SESSION["intro_edit_check"] = "";
    }

   ?>

  <fieldset>
    <form method="post" action="home/home_intro_edit.php" enctype="multipart/form-data">
    <dl>
      <dt>タイトル<dt>
      <dd><input type="text" id="title" name="title" size="35" maxLength="100" placeholder="タイトル" /><dd>
      <dt>本文</dt>
      <dd><textarea type="textarea" id="textarea" name="textarea" rows="10" placeholder="本文"></textarea></dd>
      <dt>メディア<dt>
      <dd><input type="file" name="upfile"></dd>
    </dl>
    <input type="submit" value="登録する">
    </form>
  </fieldset> 


  <!-- 以下一覧表示   -->
  <?php
   echo $view; 
  ?>
  
<?php 
// html header include
   include(__DIR__.'/include/home/footer.php'); 
?>