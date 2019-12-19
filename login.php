<?php 
   // session start
   session_start();

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
  <form id="login_form" name="form1" action="login_act.php" method="post">
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
  <p class="logad">アカウントの新規登録はこちらから</p>
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