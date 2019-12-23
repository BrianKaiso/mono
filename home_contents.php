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

   // コンテンツ一覧表示
  // $sql ="SELECT * FROM mst_content WHERE c_code = '{$_SESSION["users_id"]}'";
   $sql ="SELECT * FROM mst_content JOIN mst_product ON mst_content.p_code = mst_product.p_code WHERE mst_content.c_code = '{$_SESSION["users_id"]}'";

   $stmt = $pdo->prepare($sql);
   $status = $stmt->execute(); // 成功ならtrue, 失敗ならfalse

   $view = '';
   $odd = 0;
   if($status==false) {
     sql_error($stmt); // include -> functions.php > function sql_error();
   }else{
     while($r2 = $stmt->fetch(PDO::FETCH_ASSOC)){ 
      $odd++;
      if($odd%2 === 0){
        $view .= "<div class=\"intro bgodd\"><div class=\"sm\"><p class=\"small001\"><span>投稿日時:&nbsp;</span>{$r2['time_stamp']}<br /><span>表示先商品:&nbsp;</span>{$r2['p_name']}</p><img src='home/contents/{$_SESSION["users_id"]}/{$r2['c_file']}' /></div><div class=\"lg\"><p>{$r2['title']}</p><p>{$r2{'comment'}}</p></div><div class=\"sm\"><a class=\"accBtn2\" href='home/home_contents_delete.php?id={$r2['id']}&file={$r2['c_file']}'>削除</a></div></div>";
      }else{
        $view .= "<div class=\"intro\"><div class=\"sm\"><p class=\"small001\"><span>投稿日時:&nbsp;</span>{$r2['time_stamp']}<br /><span>表示先商品:&nbsp;</span>{$r2['p_name']}</p><img src='home/contents/{$_SESSION["users_id"]}/{$r2['c_file']}' /></div><div class=\"lg\"><p>{$r2['title']}</p><p>{$r2{'comment'}}</p></div><div class=\"sm\"><a class=\"accBtn2\" href='home/home_contents_delete.php?id={$r2['id']}&file={$r2['c_file']}'>削除</a></div></div>";
      }
     }
    }

 if(empty($view)){
    // データが無いとき
    $view ="<p>コンテンツがまだ1件もありません。さっそくを登録しましょう！</p>";
  }

     // セラーの商品コード一覧表示
     $sql ="SELECT * FROM mst_product WHERE c_code = '{$_SESSION["users_id"]}'";
     $stmt = $pdo->prepare($sql);
     $status = $stmt->execute(); // 成功ならtrue, 失敗ならfalse
  
     $view2 = '<select name="products_code" size="5">';
     if($status==false) {
       sql_error($stmt); // include -> functions.php > function sql_error();
     }else{
       while($r3 = $stmt->fetch(PDO::FETCH_ASSOC)){  
         $view2 .= "<option value=\"{$r3["p_code"]}\">{$r3["p_name"]}</option>";
       }
      }
    $view2 .= "</select>";

 $pdo=null;
// DB接続エンドHere

// JSの処理で使用するのでセッションIDをJSの変数に渡しておく
// $_SESSION["users_id"];

?>

<h1>マイページ - コンテンツ登録</h1>
<?php
// navigation include
include(__DIR__.'/include/home/mypagenav.php');  
?>

<!-- マイページ基本情報表示と更新  -->
  <p><strong><?=$r["name"] ?></strong>さんの商品の魅力を紹介するコンテンツ（使い方、How toなど）をこちらで登録・編集することができます。</p> <!-- 社名/屋号  -->
  <?php
    if(isset($_SESSION["intro_edit_check"])){
      $error="";
      foreach( $_SESSION["intro_edit_check"] as $val ) {
        $error .= "<p class=\"red\">";
        $error .= "$val";
        $error .= "</p>";
    }
        echo $error,"<br \>";
        $_SESSION["intro_edit_check"] = "";
    }

   ?>
   <h2>コンテンツ登録</h2>
  <!-- 登録フォームを表示する   -->
  <fieldset>
    <form method="post" action="home/home_contents_edit.php" enctype="multipart/form-data">
    <dl>
      <dt>表示先商品</dt><dd><?=$view2?></dd>
      <dt>タイトル</dt><dd><input type="text" id="title" name="title" size="30" maxLength="30" placeholder="タイトル(30文字以内)" /></dd>
      <dt>本文</dt>
      <dd><textarea type="textarea" id="comment" name="comment" rows="5" placeholder="表示した写真や動画についての説明" ></textarea></dd>
      <dt>メディア</dt><dd><input type="file" name="upfile"></dd>
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