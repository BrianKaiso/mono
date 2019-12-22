</main>
<!-- mainここまで  -->
 
 <!-- footerここから -->
<footer>

<div> <!-- footerナビ2段組み   -->
<!-- 手のひらストーリ運営会社紹介 -->
 <ul>
    <li><span>ご案内</span></li>
    <li><a href="index.php">サービスホーム</a></li>
    <li><a href="#">ミッション</a></li>
    <li><a href="#">サービス</a></li>
    <li><a href="#">利用者紹介</a></li>
    <li><a href="#">メディア</a></li>
    <li><a href="#">メンバー</a></li>
    <li><a href="#">運営会社案内</a></li>
    <li><a href="#">お問い合わせ</a></li>
 </ul>

 <ul> <!-- 生産者向けサービスナビゲーション -->
   <li><span>会員メニュー</span></li>
   <li><a href="home.php">会員ホーム</a></li>
  <?php 
    if(!isset($_SESSION["chk_ssid"])){
      ?>
       <li><a href="home_login.php">ログイン</a></li>
       <li><a href="home_newacc.php">新規登録</a></li>
     <?php
     }
     ?>
    <?php 
   if(isset($_SESSION["chk_ssid"])){
   if(strcmp($_SESSION["chk_ssid"], session_id()) == 0){ 
   ?>
  <li><a href="home_mypage.php">マイページ</a></li>
  <li><a href="home_logout.php">ログアウト</a></li>
  <?php 
  }    
  }
  ?>
  </ul> 
</div> <!-- footerナビ2段組み終わり   -->

<!-- SNSアイコン placeholder  -->
<p>SNSイメージここ</p>

</footer> 
<!-- footerここまで -->




<!-- 運営元ページhome.phpおよび付随するページ向けのjs関数を読み込む --> 
<script type="text/javascript" src="js/home/functions.js"></script>

</body>
</html>