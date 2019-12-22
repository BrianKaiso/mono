</main>
<!-- mainここまで  -->
 
 <!-- footerここから -->
<footer>

<!-- 手のひらストーリ運営会社紹介 -->
<div>
 <ul>
    <li><h3>ご案内</h3></li>
    <li><a href="#">初めての方へ</a></li>
    <li><a href="#">ご利用ガイド</a></li>
    <li><a href="#">FAQ</a></li>
    <li><a href="#">出品したい</a></li>
    <li><a href="#">購入したい</a></li>
    <li><a href="#">店舗運営の方へ</a></li>
 </ul>

 <ul>
    <li><h3>手のひらストーリ</h3></li>
    <li><a href="#">ミッション</a></li>
    <li><a href="#">提供サービス</a></li>
    <li><a href="#">利用者の声</a></li>
    <li><a href="#">メディア</a></li>
    <li><a href="#">運営会社案内</a></li>
    <li><a href="#">お問い合わせ</a></li>
 </ul>

 <ul> <!-- 生産者向けサービスナビゲーション -->
   <li><h3>会員メニュー</h3></li>
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
</div>

<!-- SNSアイコン placeholder  -->
<p class="center sns"><a href="#"><img src="/mono/img/sns/fb.png" width="35" height="35"/></a><a href="#"><img src="/mono/img/sns/in.png" width="35" height="35"/></a><a href="#"><img src="/mono/img/sns/li.png" width="35" height="35"/></a><a href="#"><img src="/mono/img/sns/tw.png" width="35" height="35"/></a></p>
<p class="center small001">&copy;2019&nbsp; 手のひらストーリ Ltd. all rights reserved</p>

</footer> 
<!-- footerここまで -->




<!-- 運営元ページhome.phpおよび付随するページ向けのjs関数を読み込む --> 
<script type="text/javascript" src="js/home/functions.js"></script>

</body>
</html>