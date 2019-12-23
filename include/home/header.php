<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="text/javascript" src="jquery-2.1.3.min.js"></script>
    <link rel="stylesheet" href="css/home/home.css"> <!-- 運営元ページ用のcss  -->
    <link rel="icon" href="img/favicon.ico"> <!-- ファビコン  -->
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    

    <title>手のひらストーリ 生産者向け情報登録ページ</title>
</head>
<body>

<!-- headerここから-->
<header>
 <div> <!-- ヘッダーメインロゴ   -->
  <a href="home.php"><img src="./img/main_logo_sm.png" width="230" height="105" alt="手のひらストーリ QRコードから始まるモノガタリ" /></a>
 </div> <!-- ヘッダーメインロゴ 終わり  -->

 <div> <!-- ヘッダーナビゲーションここから   -->
 <?php 
      if(isset($_SESSION["chk_ssid"])){
      if(strcmp($_SESSION["chk_ssid"], session_id()) == 0){ 
  ?>
  <p>ようこそ！<?php echo $_SESSION["users_name"]  ?>さん</p>
<?php 
   }
  }
?>
<ul>
  <li><a href="home.php">会員ホーム</a></li>
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
 <?php 
    if(!isset($_SESSION["chk_ssid"])){
      ?>
       <li><a href="home_login.php">ログイン</a></li>
       <li><a href="home_newacc.php">新規登録</a></li>
   <?php
    }
   ?>
  </ul>
 </div> <!-- ヘッダーナビゲーションここまで  -->
</header>
<!-- headerここまで  -->

<!-- mainここから -->
<main>