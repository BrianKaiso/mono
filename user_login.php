<?php 
   // session start
   session_start();

   include(__DIR__.'/header.php');
   //便利な関数を収めたfunctions.phpをinclude
   include(__DIR__.'/functions.php');
  
  // MyCart情報が入ったSessionがあれば取得(クエリ文字列を想定)
  if(isset($_SESSION["mycart"])){
    // 変数$mycartにカート情報が入ったクエリ文字列を格納
    $mycartQuery=$_SESSION["mycart"];
    // クエリ文字列を配列に戻す
     parse_str($mycartQuery,$mycart);
    // HTMLエスケープ ※ PLACE HOLDER  
    //var_dump($mycart);
  }

  // login_act.phpより ログイン情報が正しく無い場合
  if(isset($_SESSION["false"])){
    if($_SESSION["false"]==1){
      $errMsg = "<div class=\"cau\"><p>ログインできませんでした。</p><p>入力に間違いが無いかご確認ください。</p></div>";
      $_SESSION["false"]=0;
    }
  }

  // login_act.phpより 新規アカウントの作成が成功した場合、案内メッセージを表示する
  if(isset($_SESSION["newacc"])){
    if($_SESSION["newacc"]==true){
      $errMsg = "<div class=\"accSuccess\"><p>新しいアカウントが作成できました！</p><p>こちらからログインしてください。</p></div>";
      $_SESSION["newacc"]=false;
    }
    ?>
    <script> 
    $(document).ready(function(){
       $('#tpmsg').hide(); // メッセージを非表示
    });
    </script>
    <?php 
  }

  // checkout.phpより ログインしていない状態でcheckoutページにアクセスがあった場合、案内メッセージを伝え、ログインを促す
  if(isset($_SESSION["checkout"])){
  if(!$_SESSION["checkout"]){
    $errMsg = "<div class=\"accSuccess\"><p>アカウントへログインして、チェックアウトに進みましょう！</p><p>アカウントをお持ちでない方は新規登録を行ってください。</p></div>";
    $_SESSION["checkout"]=true;
    ?>
    <script> 
    $(document).ready(function(){
       $('#tpmsg').hide(); // メッセージを非表示
    });
    </script>
    <?php 
  }
}
  
?>

<!-- <main class="center"> --><!-- contents starts here-->

<main class="login">
<?php //echo $outPut; ?>

<div id="loginBox1">
<h2>ログイン</h2>
<p id="tpmsg" class="logad">こちらからアカウントにログインしてください。</p>
<?php   
if(isset($errMsg)){
  echo $errMsg;
}
?>
<!-- login_act.php は認証処理用のPHPです。 -->
<form id="login_form" name="form1" action="useer_login_act.php" method="post">
<ul>
    <li>
      <input class="email" type="text" name="users_email" size="25" maxLength="15" placeholder="メール" />
    </li>
    <li>
      <input id="pwd" class="key" type="password" name="lpw" size="25" maxLength="15" placeholder="パスワード" /></li>
    <li>
        <input type="checkbox" id="password-check" />&nbsp;&nbsp;パスワードを表示する
    </li>
    <li> 
      <input class="button" type="submit" value="ログイン" />
    </li>
</ul>
</form>

<p class="logad"><a class="border" href="#">パスワードをお忘れですか？</a></p> 
</div> <!-- loginBox1 ends here -->

<div id="loginBox2">
<h2>新規登録</h2>
<p class="logad">新しいユーザーですか？</p>
<p class="logad">こちらから新しいアカウントを作成しましょう！</p>
<a id="accBtn" href="newaccount.php">アカウントを作成</a>
</div> <!-- loginBox2 ends here -->



 </main> <!-- contents ends here-->

 <script>
     // フォーム入力: パスワードの表示オンオフ
 const pwd = document.getElementById('pwd');
 const pwdCheck = document.getElementById('password-check');
       pwdCheck.addEventListener('change', function() {
     if(pwdCheck.checked) {
         pwd.setAttribute('type', 'text');
     } else {
         pwd.setAttribute('type', 'password');
     }
 }, false);
 </script>

<?php
// ページ読み込み時にクッキーmycartが存在する場合、MyCartの横にカートに入っている注文数の合計を入れる
if(isset($mycart)){
?>
<script>
  function addMyCartNum(){
  
    let cartNumTotal=0;
    let mycart=[];
    <?php   
     foreach ($mycart as $key => $value){
      ?> 
      mycart["<?=$key?>"]=<?=$value?>;
    <?php
     }
    ?>
     for(let p in mycart){
        cartNumTotal += Number(mycart[p]);
      }  
      document.getElementById("myCartNum").textContent = `(${cartNumTotal})`;
  }
  addMyCartNum();  
    </script>
<?php
 }
?>

<?php // footer呼び込み
   include('footer.php');
?>
