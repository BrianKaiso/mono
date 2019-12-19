<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="text/javascript" src="jquery-2.1.3.min.js"></script>
    <link rel="stylesheet" href="css/home/home.css"> <!-- 運営元ページ用のcss  -->
    <title>サービスの運営元ホーム</title>
</head>
<body>
<div class="wrapper">

<!-- headerここから-->
<header> 
 <div>
  <a href="home.php"><img src="./img/home/service_logo.png" width="255" height="287" alt="モノガタリ サービスロゴ" /></a>
 </div>

 <div>

 <?php 
 if(isset($_SESSION["chk_ssid"])){
  if(strcmp($_SESSION["chk_ssid"], session_id()) == 0){ 
  ?>
<div id="logged_menu">
<ul>
<li>ようこそ！<?php echo $_SESSION["users_name"]  ?>さん</li>
<li><a href="home_mypage.php">My Page</a></li>
<li><a href="home_logout.php">Log out</a></li>
</ul>
</div>

<?php 
 }
}
?>

  <ul>
    <li><a href="home.php">Top</a></li>
    <li><a href="#">Misson</a></li>
    <li><a href="#">Service</a></li>
    <li><a href="#">User</a></li>
    <li><a href="#">Media</a></li>
    <li><a href="#">Member</a></li>
    <?php 
    if(!isset($_SESSION["chk_ssid"])){
      ?>
       <li><a href="home_login.php">Log In</a></li>
       <li><a href="home_newacc.php">New Account</a></li>
     <?php
     }
     ?>
  </ul>
 </div>
</header>
<!-- headerここまで  -->

