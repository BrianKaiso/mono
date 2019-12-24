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

   // ニュース一覧表示
  // $sql ="SELECT * FROM mst_content WHERE c_code = '{$_SESSION["users_id"]}'";
  //  $sql ="SELECT * FROM dat_news JOIN mst_product ON dat_news.p_code = mst_product.p_code WHERE dat_news.c_code = '{$_SESSION["users_id"]}'";
  $sql ="SELECT * FROM dat_news LEFT JOIN mst_product ON dat_news.p_code = mst_product.p_code WHERE dat_news.c_code = '{$_SESSION["users_id"]}'";


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
        $view .= "<div class=\"intro bgodd\">";
      }else{
        $view .= "<div class=\"intro\">";
      }
       if($r2['all_flag']==='1'){
        $view .= "<div class=\"sm\"><p class=\"small001\"><span>投稿日時:&nbsp;</span>{$r2['n_date']}<br /><span>表示先商品:&nbsp;</span>全商品</p><img src='home/news/{$_SESSION["users_id"]}/{$r2['n_img']}' /></div><div class=\"lg\"><p>{$r2['title']}</p><p>{$r2{'article'}}</p></div><div class=\"sm\"><a class=\"accBtn2\" href='home/home_news_delete.php?id={$r2['n_code']}&file={$r2['n_img']}'>削除</a></div></div>"; 
      }else{
        $view .= "<div class=\"sm\"><p class=\"small001\"><span>投稿日時:&nbsp;</span>{$r2['n_date']}<br /><span>表示先商品:&nbsp;</span>{$r2['p_name']}</p><img src='home/news/{$_SESSION["users_id"]}/{$r2['n_img']}' /></div><div class=\"lg\"><p>{$r2['title']}</p><p>{$r2{'article'}}</p></div><div class=\"sm\"><a class=\"accBtn2\" href='home/home_news_delete.php?id={$r2['n_code']}&file={$r2['n_img']}'>削除</a></div></div>";
      }
     }
    }

 if(empty($view)){
    // データが無いとき
    $view ="<p>ニュースがまだ1件もありません。さっそくを登録しましょう！</p>";
  }

     // セラーの商品コード一覧表示
     $sql ="SELECT * FROM mst_product WHERE c_code = '{$_SESSION["users_id"]}'";
     $stmt = $pdo->prepare($sql);
     $status = $stmt->execute(); // 成功ならtrue, 失敗ならfalse
  
     $view2 = '<select name="products_code" size="5">';
     $view2 .= '<option value="all">★全商品ページに表示★</option>';
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

<h1>マイページ - ニュース登録</h1>
<?php
// navigation include
include(__DIR__.'/include/home/mypagenav.php');  
?>

<!-- マイページ基本情報表示と更新  -->
  <p><strong><?=$r["name"] ?></strong>さんの商品の最新ニュースを届けよう！</p>
  <p>登録一覧から”全商品ページに表示”を選択すると、すべての商品ページで表示されるニュースを登録することもできます。</p><!-- 社名/屋号  -->
  <?php
    if(isset($_SESSION["intro_edit_check"])){
      $error="";
      foreach( $_SESSION["intro_edit_check"] as $val ) {
        $error .= "<p class=\"red\">";
        $error .= "$val";
        $error .= "</p>";
    }
        echo $error,"<br />";
        $_SESSION["intro_edit_check"] = "";
    }

   ?>
   <h2>ニュース登録</h2>
  <!-- 登録フォームを表示する   -->
  <fieldset>
    <form method="post" action="home/home_news_edit.php" enctype="multipart/form-data">
    <dl>
      <dt>表示先商品</dt><dd><?=$view2?></dd>
      <dt>タイトル<dt>
      <dd><input type="text" id="title" name="title" size="35" maxLength="30" placeholder="タイトル(30文字以内)" /><dd>
      <dt>本文</dt>
      <dd><textarea type="textarea" id="article" name="article" rows="5" placeholder="ニュースの本文部分"></textarea></dd>
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