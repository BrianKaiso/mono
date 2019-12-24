<?php
session_start();

include("functions/home/functions.php");
// sschk();
$pdo = db_conn();

//データ登録SQL作成(content)
$stmt = $pdo->prepare("SELECT * FROM mst_content INNER JOIN mst_creater ON mst_content.c_code = mst_creater.c_code ORDER BY time_stamp DESC");
$status = $stmt->execute();

$stmt_n = $pdo->prepare("SELECT * FROM mst_creater INNER JOIN dat_news ON mst_creater.c_code = dat_news.c_code ");
$status_n = $stmt_n->execute();
// $stmt = $pdo->prepare("SELECT * FROM mst_content");
// $status = $stmt->execute();

//データ登録SQL作成(creater)
// $stmt_c = $pdo->prepare("SELECT * FROM mst_content INNER JOIN mst_creater ON mst_content.c_code = mst_creater.c_code");
// $status_c = $stmt_c->execute();
// foreach ($stmt_c as $r_c) {
//   // データベースのフィールド名で出力。
//   // echo $row['p_name'];みたいな感じで書いたらHTML内に持ってこれるで。
//   }



//新着情報
$view="";
if($status==false) {
  sql_error();
}else{
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<div class="swiper-slide">';
    $view .= '<img class="new" src="home/contents//'.$r["c_code"].'/'.$r["c_file"].'">';
    $view .= '<div class="swiper-slide_min">';
    $view .= '<p class="company">'.$r["name"].'</p>';
    $view .= '</div>';
    $view .= '</div>';
  }
}
$view_n="";
if($status==false) {
  sql_error();
}else{
  while( $r_n = $stmt_n->fetch(PDO::FETCH_ASSOC)){
    $view_n .= '<div class="swiper-slide">';
    $view_n .= '<img class="new" src="home/news/'.$r_n["c_code"].'/'.$r_n["n_img"].'">';
    $view_n .= '<div class="swiper-slide_min_n">';
    $view_n .= '<p class="company">'.$r_n["name"].'</p><br>';
    $view_n .= '<p>'.$r_n["title"].'</p><br>';
    $view_n .= '</div>';
    $view_n .= '</div>';
  }
}

?>




<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="jquery-2.1.3.min.js"></script>
    <script src="js/jquery.japan-map.js"></script>
    <link rel="stylesheet" href="reset.css" />
    <link rel="stylesheet" href="index.css" />
    <link rel="stylesheet" type="text/css" href="css/slick-theme.css"/>
    <link rel="stylesheet" type="text/css" href="css/slick.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/js/swiper.min.js"></script>
    <title>サービス名</title>
    </head>
    <body>
    
    <!-- ハンバーガーメニュー -->
    <header>
  <nav class="globalMenu">
     <ul>
       <li><a href="top.php?shop=aaaa&itemsxxxx">HOME</a></li> <!-- (1) サービストップページ URLに生産者名と商品ID   -->
       <li><a href="profile.php?shop=aaaa">モノを探す</a></li> <!-- (2) ページ内へスクロール   --> 
       <li><a href="contens.php?shop=aaa&items=xxx">使い方</a></li> <!--  (3) How toコンテンツページ URLは生産者名、商品ID、コンテンツID  -->
       <li><a href="news.php?shop=aaa&items=xxx">お知らせ</a></li> <!-- (4) ニュース URLは生産者生と商品ID   -->
       <li><a href="list.php?shop=aaa">購入・EC</a></li> <!-- (5) 同生産者が販売するアイテム一覧 URLは生産者名  -->
       <li><a href="mypage.php">マイページ</a></li> <!--  新規ログイン⇒アカウント無い方は新規登録 myaccount.phpへアクセス   --> 
       <li><a href="home.php">生産業者様</a></li> <!-- home.phpへアクセス  -->
     </ul>
   </nav>
   <!-- include navitation.php ここまで  -->
  
  <div class="navToggle">
  <span></span> 
  <span></span> 
  <span></span> 
  <span>menu</span> 
  </div>
</header>
<!-- ハンバーガーメニューここまで -->

<!-- トップ画像 -->
<!-- <div class="video_wrapper"> -->
<div class="video_wrapper">
  <img class="monogatari" src="img/logo_white1.png">
  <img id="catchcopy" src="img/title.png">
  <video id="video" loop autoplay muted playsinline>
    <source src="img/index_movie.mp4" type="video/mp4;" codecs="avc1.42E01E, mp4a.40.2">
  </video>
</div>

<div id = "intro">
  <div class="intro_child1">
    <!-- <img class="logo" src="img/logo_backwhite.png"> -->
    <!-- <h1>てのひらストーリー</h1> -->
    <p>QRを読み込んだら産地へひとっとび。モノにまつわるストーリーをお届けします。　|<a id="aboutus" href="aboutus.php">  もっと詳しく</a></p>
  </div>
  <div class="intro_child2">
    <p>出品者の方は</br>こちら</p>
    <!-- <div class="half">
    </div> -->
    <a href="home.php"><img id="hazemoto" src="img/index/noka.jpg"></a>
  </div>
</div>



<div id="user">
  <div class="container_user">
  <a href="user_login.php" class="btn-icon">買いたい方はこちら</a>
  </div>
  <!-- <a class="btn-flat-border" href="home.php">生産者登録</a> -->
</div>

<!-- </div> -->
<!-- <img id="top_img" src=img/index/index01.png> -->
<!-- <p>都道府県</p>
<p>カテゴリー</p>
<p>コンテンツ</p>
<p>ECページ</p>
<h1>検索フォーム</h1>
<p>検索</p> -->


<!-- 新着 -->
<h1 class="title">--------  新着  --------</h1>
<div class="swiper-container">
  <div class="swiper-wrapper" id="view"><?=$view?></div>
</div>


<h1 class="title">--------  ニュース  --------</h1>
<div class="swiper-container">
<div class="swiper-wrapper" id="view"><?=$view_n?></div>
</div>
<!-- <a class="btn-flat-border" href="home.php">生産者登録</a> -->

<div class="sns_button">
  <ul class="snsbtniti">
    <div id="sns-area"></div>
  </ul>
</div>

<footer>
<a href="">利用規約 </a>
<p> | </p>
<a href="">個人情報保護方針 </a>
<p> | </p>
<a href="">ご利用にあたって </a>
<p> | </p>
<a href="">運営会社</a>

</footer>

<!-- <div class="test">
  <img class="test_img" src="upload/images.jpeg" alt="">
</div> -->

<script>

// ハンバーガーメニュー
$(function(){
    $('.navToggle').click(function(){
    $(this).toggleClass('active');
    console.log(this);
    if($(this).hasClass('active')){
        $('.globalMenu').addClass('active');
    }else{
    $('.globalMenu').removeClass('active');
    }
    });
});

// SNSボタンを追加するエリア
var snsArea = document.getElementById('sns-area');
 
// シェア時に使用する値
var shareUrl = 'location.href'; // URL.現在のページURLを使用する場合 location.href;
var shareText = '『手のひらストーリー』モノとヒトを繋げます。'; // 現在のページタイトルを使用する場合 document.title;
 
generate_share_button(snsArea, shareUrl, shareText);
 
// シェアボタンを生成する関数
function generate_share_button(area, url, text) {
    // シェアボタンの作成
    var twBtn = document.createElement('div');
    twBtn.className = 'twitter-btn';
    var fbBtn = document.createElement('div');
    fbBtn.className = 'facebook-btn';
    var liBtn = document.createElement('div');
    liBtn.className = 'line-btn';
 
    // 各シェアボタンのリンク先
    var twHref = 'https://twitter.com/share?text='+encodeURIComponent(text)+'&url='+encodeURIComponent(url);
    var fbHref = 'http://www.facebook.com/share.php?u='+encodeURIComponent(url);
    var liHref = 'https://line.me/R/msg/text/?'+encodeURIComponent(text)+' '+encodeURIComponent(url);
 
    // シェアボタンにリンクを追加
    var clickEv = 'onclick="popupWindow(this.href); return false;"';
    var twLink = '<li><a class="flowbtn7 fl_tw7" href="' + twHref + '" ' + clickEv + '><i class="fab fa-twitter"></i></a></li>';
    var fbLink = '<li><a class="flowbtn7 fl_fb7" href="' + fbHref + '" ' + clickEv + '><i class="fab fa-facebook-f"></a></li>';
    var liLink = '<a class="flowbtn7 fl_li7" href="' + liHref + '" target="_blank"><i class="fab fa-line"></a></li>';
    twBtn.innerHTML = twLink;
    fbBtn.innerHTML = fbLink;
    liBtn.innerHTML = liLink;
 
    // シェアボタンを表示
    area.appendChild(twBtn);
    area.appendChild(fbBtn);
    area.appendChild(liBtn);
}
 
// クリック時にポップアップで表示させる関数
function popupWindow(url) {
    window.open(url, '', 'width=580,height=400,menubar=no,toolbar=no,scrollbars=yes');
}

//スライダー
var mySwiper = new Swiper ('.swiper-container', {
    // オプションパラメータ(一部のみ抜粋)
    loop: true, // 最後のスライドまで到達した場合、最初に戻らずに続けてスライド可能にするか。
    speed: 600, // スライドが切り替わるトランジション時間(ミリ秒)。
    slidesPerView: 4, // 何枚のスライドを表示するか
    spaceBetween: 10, // スライド間の余白サイズ(ピクセル)
    direction: 'horizontal', // スライド方向。 'horizontal'(水平) か 'vertical'(垂直)。effectオプションが 'slide' 以外は無効。
    effect: 'slide', // "slide", "fade"(フェード), "cube"(キューブ回転), "coverflow"(カバーフロー) または "flip"(平面回転)
 
    // スライダーの自動再生
    // autoplay: true 　のみなら既定値での自動再生
    autoplay: {
      delay: 3000, // スライドが切り替わるまでの表示時間(ミリ秒)
      stopOnLast: false, // 最後のスライドまで表示されたら自動再生を中止するか
      disableOnInteraction: true // ユーザーのスワイプ操作を検出したら自動再生を中止するか
    },
 
    // レスポンシブ化条件
    breakpoints: {
      // 980ピクセル幅以下になったら
      980: {
        slidesPerView: 3,
        spaceBetween: 30
      },
      // 640ピクセル幅以下になったら
      640: {
        slidesPerView: 2,
        spaceBetween: 20
      }
    },
 
    // ページネーションを表示する場合
    pagination: {
      el: '.swiper-pagination',　 // ページネーションを表示するセレクタ
    },
 
    // 前後スライドへのナビゲーションを表示する場合
    navigation: {
      nextEl: '.swiper-button-next', // 次のスライドボタンのセレクタ
      prevEl: '.swiper-button-prev', // 前のスライドボタンのセレクタ
    },
 
    // スクロールバーを表示する場合
    scrollbar: {
      el: '.swiper-scrollbar', // スクロールバーを表示するセレクタ
    }
  });

</script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</body>