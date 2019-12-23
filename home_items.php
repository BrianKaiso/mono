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

   // 商品一覧表示
  //  $sql ="SELECT * FROM mst_product WHERE c_code = '{$_SESSION["users_id"]}'";
   $sql ="SELECT * FROM mst_product LEFT JOIN mst_asset on mst_product.p_code = mst_asset.p_code WHERE mst_product.c_code = '{$_SESSION["users_id"]}'";
  //  $sql ="SELECT * FROM dat_news LEFT JOIN mst_product ON dat_news.p_code = mst_product.p_code WHERE dat_news.c_code = '{$_SESSION["users_id"]}'";


   $stmt = $pdo->prepare($sql);
   $status = $stmt->execute(); // 成功ならtrue, 失敗ならfalse

   $view = '';
   $str_text = '';
   $odd = 0;
   $url = '';
   if($status==false) {
     sql_error($stmt); // include -> functions.php > function sql_error();
   }else{
     while($r2 = $stmt->fetch(PDO::FETCH_ASSOC)){  
      $str_text = '';
      $str_text = mb_substr($r2['p_text'],0,50);
      $str_text .= $str_text."...";
      $url= "p_code={$r2['p_code']}%26c_code={$_SESSION["users_id"]}%26a_code={$r2["a_code"]}";
      $odd++;
      if($odd%2 === 0){
        $view .= "<div class=\"intro bgodd\"><div class=\"sm\"><img src='home/items/{$_SESSION["users_id"]}/{$r2['p_img']}' /></div><div class=\"lg\"><p class=\"space\"><strong>{$r2['p_name']}</strong></p><p>{$r2{'p_spec'}}</p><p>{$str_text}</p></div><div class=\"sm\"><br /><img src=\"https://api.qrserver.com/v1/create-qr-code/?data=http://redturtle44.sakura.ne.jp/mono/user.php?{$url}&size=100x100\" alt=\"{r2['p_name']}のページ\" /><br /><a href=\"http://redturtle44.sakura.ne.jp/mono/user.php?p_code={$r2['p_code']}&c_code={$_SESSION["users_id"]}&a_code={$r2["a_code"]}\"><span class=\"url\">URL<span></a><br /><a class=\"accBtn2\" href='home/home_items_delete.php?id={$r2['p_code']}&img={$r2['p_img']}'>削除</a></div></div>";
      }else{
       $view .= "<div class=\"intro\"><div class=\"sm\"><img src='home/items/{$_SESSION["users_id"]}/{$r2['p_img']}' /></div><div class=\"lg\"><p class=\"space\"><strong>{$r2['p_name']}</strong></p><p>{$r2{'p_spec'}}</p><p>{$str_text}</p></div><div class=\"sm\"><br /><img src=\"https://api.qrserver.com/v1/create-qr-code/?data=http://redturtle44.sakura.ne.jp/mono/user.php?{$url}&size=100x100\" alt=\"{r2['p_name']}のページ\" /><br /><a href=\"http://redturtle44.sakura.ne.jp/mono/user.php?p_code={$r2['p_code']}&c_code={$_SESSION["users_id"]}&a_code={$r2["a_code"]}\"><span class=\"url\">URL<span></a><br /><a class=\"accBtn2\" href='home/home_items_delete.php?id={$r2['p_code']}&img={$r2['p_img']}'>削除</a></div></div>";
     }
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

<h1>マイページ - 商品登録</h1>
<?php
// navigation include
include(__DIR__.'/include/home/mypagenav.php');  
?>

<!-- マイページ基本情報表示と更新  -->
  <p><strong><?=$r["name"] ?></strong>さんの商品を登録・編集・削除することができます。</p> <!-- 社名/屋号  -->
  <p>商品を登録すると即座に商品ページのURLとQRコードが発行されます。URLをシェアしたり、QRコードを商品パッケージに印刷したり、お店に掲示しよう！</p>
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
      <dd><input type="text" id="title" name="title" size="35" maxLength="30" placeholder="タイトル(30文字以内)" /><dd>
      <dt>商品仕様</dt>
      <dd><textarea type="textarea" id="spec" name="spec" rows="5" placeholder="規格・容量・サイズなどなど"></textarea></dd>
      <dt>商品紹介</dt>
      <dd><textarea type="textarea" id="desc" name="desc" rows="10" placeholder="商品の魅力をたっぷりと語ってください！"></textarea></dd>
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