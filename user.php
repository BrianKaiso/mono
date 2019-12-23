<?php
session_start();

include("functions/home/functions.php");
// // sschk();
$pdo = db_conn();

//クエリの商品idを変数化
$query = $_SERVER['QUERY_STRING'];
parse_str($query);
//商品id名：$p_code

// //２．データ登録SQL作成
// プロダクトのDBより
$stmt_p = $pdo->prepare("SELECT * FROM mst_product WHERE p_code = $p_code");
$status_p = $stmt_p->execute();
foreach ($stmt_p as $r_p) {
  // データベースのフィールド名で出力。
  // echo $row['p_name'];みたいな感じで書いたらHTML内に持ってこれるで。
}
$view_p .="<img src=\"home/items/{$_GET["c_code"]}/{$r_p["p_img"]}\" />";

// コンテンツのDBより
$stmt_c = $pdo->prepare("SELECT * FROM mst_content WHERE p_code = $p_code");
$status_c = $stmt_c->execute();
foreach ($stmt_c as $r_c) {
}
$view_c .="<img src=\"home/contents/{$_GET["c_code"]}/{$r_c["c_file"]}\" />";

// ニュースのDBより
$stmt_n = $pdo->prepare("SELECT * FROM dat_news WHERE p_code = $c_code");
$status_n = $stmt_n->execute();
foreach ($stmt_n as $r_n) {
}
$view_n .="<img src=\"home/news/{$_GET["c_code"]}/{$r_n["n_img"]}\" />";

// 生産者のDBより
$stmt_s = $pdo->prepare("SELECT * FROM mst_creater WHERE c_code = $c_code");
$status_s = $stmt_s->execute();
foreach ($stmt_s as $r_s) {
}
$view_s .="<img src=\"home/intro/{$_GET["c_code"]}/{$r_s["media"]}\" />";

// top動画のDBより
$stmt = $pdo->prepare("SELECT * FROM mst_asset WHERE a_code = $a_code");
$status = $stmt->execute();
foreach ($stmt as $r) {
  }

// いいね機能
// カウント数取得関数
function get_count($file) {
	$filename = 'data/'.$file.'.dat';
	$fp = @fopen($filename, 'r');
	if ($fp) {
		$vote = fgets($fp, 9182);
	} else {
		$vote = 0;
	}
	return $vote;
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="jquery-2.1.3.min.js"></script>
    <link rel="stylesheet" href="reset.css" />
    <link rel="stylesheet" href="user.css" />
    <link rel="stylesheet" href="video.css" />
    <link rel="stylesheet" href="css/style.css">
    <title>手のひらストーリー</title>
</head>
<body>
<div id="wrapper"> <!-- すべてのコンテンツを囲むwrapper   -->
<!-- include header.php ここまで    -->


<nav class="icon">
<a  href="index.php?shop=aaaa&itemsxxxx"><img src="../mono/img/image_preview.png" style=width:80px; alt="手のひらストーリー"></a> <!-- (1) サービストップページ URLに生産者名と商品ID   -->
</nav>

<!-- include navitation.php ここから  -->
 <nav class="globalMenu">
 <!--
   navigation 各ページへのリンク ※全ページ共通のコンポーネント
   1. Top 商品トップページ
   2. Story 生産者紹介・こだわり
   3. Contents 商品のことをもっと知る How to...コンテンツページ
   4. News ニュースページ
   5. Items 同生産者が販売するアイテム一覧
   6. Message メッセージページ 生産者とのダイレクトなコミュニケーション
   7. My page ユーザーマイページ (ログイン中のみ表示)
   8. Log in ログインページ (OAuthによるSNSログイン・Emailログイン、または新規登録)
 -->
<ul>
  <li><a href="index.php?shop=aaaa&itemsxxxx">HOME</a></li> <!-- (1) サービストップページ URLに生産者名と商品ID   -->
  <li><a href="user_newaccount.php">新規会員登録</a></li> 
  <li><a href="user_newaccount.php">マイページ</a></li> 
  <li><a href="home.php">手のひらストーリーって？</a></li> <!-- サービスの説明ページへ移動  -->
</ul>
</nav>
<!-- include navitation.php ここまで  -->
<!-- ハンバーガーメニュー -->

<div class="navToggle">
<span></span> 
<span></span> 
<span></span> 
<span>menu</span> 
</div>
 <!--    
   headerで表示する要素
   1. 商品トップコンテンツ (動画 or 写真)
   2. 商品フォロー機能
   3. サービス運営ページアイコンリンク
 -->

<!-- 動画表示 -->
<video id="video" loop autoplay muted playsinline controls>
  <?php
  echo'<source src="upload/'.$r["a_id"].'"type="video/mp4;" codecs="avc1.42E01E, mp4a.40.2">'
  ?>
</video>

<section>
<div class="btn_area">
<h2><?php echo $r_p['p_name'];?></h2>
<p class="ico_heart vote_01"><?= get_count('vote_01') ?></p>
<p class="btn_vote" id="vote_01"></p>
</div><!-- /btn_area -->

<h2><?php echo $r_s['name'];?></h2>
<h2><?php echo $r_s['name_in_charge'];?></h2>
<a href="follow.php">商品をフォロー</a>
</section>

</div>
<section>
<div class="menu1">
  <div class=btn1><a href="#story" class="btn1_e">こだわり</a></div> <!-- ストーリーにあたる  -->
  <div class=btn1><a href="#contents" class="btn1_e">使い方</a></div> <!--  (3) How toコンテンツページ URLは生産者名、商品ID、コンテンツID  -->
  <div class=btn1><a href="#news" class="btn1_e">お知らせ</a></div> <!-- (4) ニュース URLは生産者生と商品ID   -->
</div>
<div class="menu2">
  <div class=btn1><a href="#profile" class="btn1_e">生産者紹介</a></div> <!-- (2) 生産者紹介・こだわり URLは生産者名   --> 
  <div class=btn1><a href="#list" class="btn1_e">他の製品</a></div> <!-- list.php   -->
  <div class=btn1><a href="user_newaccount.php?shop=aaaa" class="btn1_e">マイページ</a></div> <!-- loginへ   --> 
</div>
</section>

 <main>
 <!--  
   コンテンツを表示 トップページの場合、リード(導入部分)の表示となる
   1. 商品名
   2. 商品詳細
   3. コンテンツ リード部分
   4. ニュース 例 3件だけ表示
 --> 
 
 <section> 
  <h3><?php echo $view_p;?></h3> <!-- 1. 商品の画像  -->
  <pre><?php echo $r_p['p_spec'];?></pre> <!-- 1. 商品の名称・品名・品番など  -->

</section>

<section id="story">
<h1>こだわり</h1>
  <pre><?php echo $r_p['p_text'];?></pre> <!-- 1. 商品の名称・品名・品番など  -->
  <a href="user_story.php?shop=aaa&items=xxx" class="more">more</a> <!-- 商品詳細ページへのリンク  -->
</section>

<section id="contents">
  <h1>使い方</h1> <!-- (3) コンテンツ How to 例: 登録されたうち1件を表示   -->
  <pre><?php echo $r_c['title'];?></pre> 
  <h3><?php echo $view_c;?></h3> <!-- 画像イメージ -->
  <pre><?php echo $r_c['comment'];?></pre> 
  <a href="user_contents.php?shop=aaa&items=xxx" class="more">more</a> <!-- コンテンツページへのリンク  -->
 </section>

<section id="news">
<h1>ニュース</h1> <!-- ニュース -->
<pre><?php echo $r_n['title'];?></pre> 
<h3><?php echo $view_n;?></h3> <!-- 画像イメージ -->
  <pre><?php echo $r_n['text'];?></pre> 
  <a href="user_news.php?shop=aaa&items=xxx" class="more">more</a> <!-- コンテンツページへのリンク  -->
  </section>

  <section id="profile">
  <h1>生産者</h1> <!-- (3) コンテンツ How to 例: 登録されたうち1件を表示   -->
  <h3><?php echo $view_s;?></h3> 
  <pre><?php echo $r_s['name'];?></pre> 
  <pre><?php echo $r_s['name_in_charge'];?></pre> <!-- 画像イメージ -->
  <a href="user_profile.php?shop=aaa&items=xxx" class="more">more</a> <!-- コンテンツページへのリンク  -->
 </section>

  <section  id="list">
  <h1>製品一覧</h1> <!-- (3) コンテンツ How to 例: 登録されたうち1件を表示   -->
  <pre><?php echo $r_p['p_name'];?></pre> 
  <h3><?php echo $view_p;?></h3>
  <a href="user_list.php?shop=aaa&items=xxx" class="more">more</a> <!-- コンテンツページへのリンク  -->
 </section>

 </main>

 <!-- include footer.php ここから   -->
 <footer>
 <!-- 
  footer 各ページへのリンク、SNSアイコン等表示
 -->
 </footer>
 <!-- include footer.php ここまで  -->

</header>  <!-- wrapper ここで終わり   -->

<!-- いいね用Ajax -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script>

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

// 動画の縦横をmst_assetのa_lawの値によってcssの条件を分岐
// a_law=1:縦、a_law=2:横
let a_law = <?php echo $r['a_lw'];?>;
// console.log(a_law);
if(a_law == 1){
  var video_law = document.getElementById("video");
  video_law.id = "video_1";
}else if(a_law == 2){
  var video_law = document.getElementById("video");
  video_law.id = "video_2";
}

// スクロールアニメーション付与
$(function(){
   // #で始まるアンカーをクリックした場合に処理
   $('a[href^=#]').click(function() {
      // スクロールの速度
      var speed = 400; // ミリ秒
      // アンカーの値取得
      var href= $(this).attr("href");
      // 移動先を取得
      var target = $(href == "#" || href == "" ? 'html' : href);
      // 移動先を数値で取得
      var position = target.offset().top;
      // スムーススクロール
      $('body,html').animate({scrollTop:position}, speed, 'swing');
      return false;
   });
});

// いいね機能
$(function() {
	allowAjax = true;
	$('.btn_vote').click(function() {
		if (allowAjax) {
			allowAjax = false;
			$(this).toggleClass('on');
			var id = $(this).attr('id');
			$(this).hasClass('on') ? Vote(id, 'plus') : Vote(id, 'minus');
		}
	});
});
function Vote(id, plus) {
	cls = $('.' + id);
	cls_num = Number(cls.html());
	count = plus == 'minus' ? cls_num - 1 : cls_num + 1;
	$.post('vote.php', {'file': id, 'count': count}, function(data) {
		if (data == 'success') cls.html(count);
		setTimeout(function() {
			allowAjax = true;
		}, 1000);
	});
}

</script>

</body>
</html>
<!-- include footer.php ここまで -->