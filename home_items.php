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
   $sql ="SELECT * FROM mst_product WHERE c_code = '{$_SESSION["users_id"]}'";
   $stmt = $pdo->prepare($sql);
   $status = $stmt->execute(); // 成功ならtrue, 失敗ならfalse

   $view = '';
   if($status==false) {
     sql_error($stmt); // include -> functions.php > function sql_error();
   }else{
     while($r2 = $stmt->fetch(PDO::FETCH_ASSOC)){  
       $view .= "<div class=\"intro\"><div><img src='home/items/{$_SESSION["users_id"]}/{$r2['p_img']}' width='100' height='100' /></div><div><p>{$r2['p_name']}</p><p>{$r2{'p_spec'}}</p><p>{$r2['p_text']}</p></div><div><a href='home/home_items_delete.php?id={$r2['p_code']}'>削除</a></div></div>";
     }
    }

 if(empty($view)){
    // データが無いとき
    $view ="<p>商品がまだ1件もありません。さっそく商品を登録しましょう！</p>";
  }
  

 $pdo=null;
// DB接続エンドHere

// JSの処理で使用するのでセッションIDをJSの変数に渡しておく
// $_SESSION["users_id"];

?>

<main> <!-- マイページ コンテンツここから   -->
<h1>マイページ - 商品登録</h1>
<?php
// navigation include
include(__DIR__.'/include/home/mypagenav.php');  
?>

<!-- マイページ基本情報表示と更新  -->
  <p><?=$r["name"] ?>さんの商品をこちらで登録・編集することができます。</p> <!-- 社名/屋号  -->
  <?php
    if(isset($_SESSION["intro_edit_check"])){
      $error="";
      foreach( $_SESSION["intro_edit_check"] as $val ) {
        $error .= "<p>";
        $error .= "$val";
        $error .= "</p>";
    }
        echo $error;
        $_SESSION["intro_edit_check"] = "";
    }

   ?>
  <!-- 登録フォームを表示する   -->
  <fieldset>
    <legend>商品登録</legend>
    <form method="post" action="home/home_item_edit.php" enctype="multipart/form-data">
    <dl>
      <dt>商品名<dt>
      <dd><input type="text" id="title" name="title" size="80" maxLength="30" placeholder="タイトル(30文字以内)" /><dd>
      <dt>商品仕様</dt>
      <dd><textarea type="textarea" id="spec" name="spec" rows="5" cols="100" placeholder="規格・容量・サイズなどなど" /></textarea></dd>
      <dt>商品紹介</dt>
      <dd><textarea type="textarea" id="desc" name="desc" rows="10" cols="100" placeholder="商品の魅力をたっぷりと語ってください！" /></textarea></dd>
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
  

</main> <!-- マイページ コンテンツここまで   -->

<script>

</script>

<?php 
// html header include
   include(__DIR__.'/include/home/footer.php'); 
?>