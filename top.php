!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="jquery-2.1.3.min.js"></script>
    <script src="js/jquery.japan-map.js"></script>
    <link rel="stylesheet" href="reset.css" />
    <link rel="stylesheet" href="index.css" />
    <title>サービス名</title>
</head>
<body>

<p>メイン背景</p>
<p>メインロゴ</p>
<!-- ハンバーガーメニュー -->
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
<!-- ハンバーガーメニューここまで -->

<p>都道府県</p>
<p>カテゴリー</p>
<p>コンテンツ</p>
<p>ECページ</p>
<h1>検索フォーム</h1>
<p>検索</p>


<div id="sns-area"></div>

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
    var twLink = '<a href="' + twHref + '" ' + clickEv + '>twitter</a>';
    var fbLink = '<a href="' + fbHref + '" ' + clickEv + '>facebook</a>';
    var liLink = '<a href="' + liHref + '" target="_blank">line</a>';
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
</script>


</body>