<?php
   // session start
   session_start();

   // functions include
   include(__DIR__.'/functions/functions.php'); 

   // html header include
   include(__DIR__.'/include/home/header.php'); 

   if(isset($_SESSION["chk_ssid"])){
     redirect("home_mypage.php");
    }

?>
<h1>販売者様ログイン</h1>

<!-- セラーログインページ    -->
<div>
<p id="tpmsg" class="logad">こちらからアカウントにログインしてください。</p>

<?php
// 新規登録が成功した場合、home_newacc.phpからここに飛ぶ
if(isset($_SESSION["newacc"])){
  if($_SESSION["newacc"]){
    ?>
    <script>
    $("#tpmsg").remove(); // 新規登録の場合のメッセージを表示したいのでデフォルトのメッセージを非表示にする
    </script>
    <?php
    echo "<p>新規登録できたよ！ここからログインしてね。</p>"; // 新規登録できた場合
    $_SESSION["newacc"]=false;
    //var_dump($_SESSION["newacc"]);
  }
}

if(isset($_SESSION["false"])){
  if($_SESSION["false"]){
  ?>
  <script>
  $("#tpmsg").remove(); // ログインに失敗した場合、エラーメッセージを表示したいので、デフォルトのメッセージを非表示にする
  </script>
  <?php
   echo "<p id=\"tpmsg\" class=\"logad\">ログインに失敗しました。入力したメールアドレスとパスワードが正しいかどうか確認してください。</p>";
    $_SESSION["false"]=false;
  }
}

if(isset($_SESSION["checkout"])){
    if($_SESSION["checkout"]){
    ?>
    <script>
    $("#tpmsg").remove(); // ログインに失敗した場合、エラーメッセージを表示したいので、デフォルトのメッセージを非表示にする
    </script>
    <?php
     echo "<p id=\"tpmsg\" class=\"logad\">マイページにアクセスするには、こちらでログインしてください。</p>";
     $_SESSION["checkout"]=false;
    }
  }

?>



<?php   
if(isset($errMsg)){
  echo $errMsg;
}

?>
<!-- login_act.php は認証処理用のPHPです。 -->
<form id="login_form" name="form1" action="home_login_act.php" method="post">
<ul>
    <li>
      <input class="email" type="text" name="c_id" size="30" maxLength="50" placeholder="メール" />
    </li>
    <li>
      <input id="pwd" class="key" type="password" name="c_pass" size="30" maxLength="32" placeholder="パスワード" /></li>
    <li> 
      <input class="button" type="submit" value="ログイン" />
    </li>
</ul>
</form>

<p>新規登録は<a href="home_newacc.php">こちら</a></p>
</div>
<!-- セラーログイン ここまで --> 

<?php 
// html header include
   include(__DIR__.'/include/home/footer.php'); 
?>