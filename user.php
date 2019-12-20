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
$stmt_p = $pdo->prepare("SELECT * FROM mst_product WHERE p_code = $p_code");
$status_p = $stmt_p->execute();
foreach ($stmt_p as $r_p) {
  // データベースのフィールド名で出力。
  // echo $row['p_name'];みたいな感じで書いたらHTML内に持ってこれるで。
  }
$stmt = $pdo->prepare("SELECT * FROM mst_asset WHERE a_code = $a_code");
$status = $stmt->execute();
foreach ($stmt as $r) {
  // データベースのフィールド名で出力。
  // echo $row['p_name'];みたいな感じで書いたらHTML内に持ってこれるで。
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
    <title>サービス名</title>
</head>
<body>
<div id="wrapper"> <!-- すべてのコンテンツを囲むwrapper   -->
<!-- include header.php ここまで    -->

<li><a href="index.php?shop=aaaa&itemsxxxx">soxil</a></li> <!-- (1) サービストップページ URLに生産者名と商品ID   -->

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
     <li><a href="index.php?shop=aaaa&itemsxxxx">soxil</a></li> <!-- (1) サービストップページ URLに生産者名と商品ID   -->
     <li><a href="profile.php?shop=aaaa">生産者紹介</a></li> <!-- (2) 生産者紹介・こだわり URLは生産者名   --> 
     <li><a href="contens.php?shop=aaa&items=xxx">使い方</a></li> <!--  (3) How toコンテンツページ URLは生産者名、商品ID、コンテンツID  -->
     <li><a href="news.php?shop=aaa&items=xxx">お知らせ</a></li> <!-- (4) ニュース URLは生産者生と商品ID   -->
     <li><a href="list.php?shop=aaa">商品一覧</a></li> <!-- (5) 同生産者が販売するアイテム一覧 URLは生産者名  -->
     <li><a href="msg.php?shop=aaa&items=xxx">生産者と話す</a></li> <!-- (6) メッセージ  URLは生産者と商品ID   -->
     <li><a href="mypage.php">マイページ</a></li> <!-- My page ログイン中のみ表示   --> 
     <li><a href="login.php">ログイン</a></li> <!-- 新規ログイン⇒アカウント無い方は新規登録 myaccount.phpへアクセス  -->
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

 <header> 
 <!--    
   headerで表示する要素
   1. 商品トップコンテンツ (動画 or 写真)
   2. 商品フォロー機能
   3. サービス運営ページアイコンリンク

 -->
   <h1>商品トップコンテンツ (動画 or 写真)</h1>

   <!-- 動画表示 -->
   <video id="video" controls>
     <?php
      echo'<source src="upload/'.$r["a_id"].'"type="video/mp4;" codecs="avc1.42E01E, mp4a.40.2">'
     ?>
   </video>

   <ul>
    <li><a href="nice.php">いいね！</a></li>
    <li><a href="follow.php">商品をフォロー</a></li>
    <li><a href="home.php">運営元ページ</a></li>
   </ul>
 </header>

 <main>
 <!--  
   コンテンツを表示 トップページの場合、リード(導入部分)の表示となる
   1. 商品名
   2. 商品詳細
   3. コンテンツ リード部分
   4. ニュース 例 3件だけ表示
 --> 
  <section> 
    <h2><?php echo $r_p['p_name'];?></h2> <!-- 1. 商品の名称・品名・品番など  -->
    <a href="products.php?shop=aaa&items=xxx">もっと見る</a> <!-- 商品詳細ページへのリンク  -->
    <!-- 商品詳細  -->
    <p><?php echo $r_p['p_comment']?></p>
    <p>追加画像など・・・</p>
  </section>
 
   <section>
     <h2>使い方(コンテンツ)</h2> <!-- (3) コンテンツ How to 例: 登録されたうち1件を表示   -->
     <a href="contens.php?shop=aaa&items=xxx">もっと見る</a> <!-- コンテンツページへのリンク  -->
     <p>動画・写真</p>
     <iframe width=100% height=600px scrolling=no src=../team/creator_test.jpg></iframe>
     <p>コンテンツテキスト コンテンツテキスト コンテンツテキスト コンテンツテキスト コンテンツテキスト コンテンツテキスト コンテンツテキスト コンテンツテキスト </p>
   </section>

   <section>
     <h2>お知らせ</h2>
     <dl><dt>タイトル</dt><dd>本文抜粋 本文抜粋 本文抜粋 本文抜粋 本文抜粋 本文抜粋 本文抜粋...<a href="#"><span>もっと読む</span></a></dd></dl>
     <dl><dt>タイトル</dt><dd>本文抜粋 本文抜粋 本文抜粋 本文抜粋 本文抜粋 本文抜粋 本文抜粋...<a href="#"><span>もっと読む</span></a></dd></dl>
     <dl><dt>タイトル</dt><dd>本文抜粋 本文抜粋 本文抜粋 本文抜粋 本文抜粋 本文抜粋 本文抜粋...<a href="#"><span>もっと読む</span></a></dd></dl>
   </section>

 </main>

 <!-- include footer.php ここから   -->
 <footer>
 <!-- 
  footer 各ページへのリンク、SNSアイコン等表示
 -->
 </footer>
 <!-- include footer.php ここまで  -->

</div>  <!-- wrapper ここで終わり   -->

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

  </script>

</body>
</html>
<!-- include footer.php ここまで -->