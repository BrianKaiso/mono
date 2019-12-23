<!-- PHPの制御・必要に応じて修正-->
<?php
ini_set('display_errors', "On");
error_reporting(E_ALL);

session_start();
// include('funcs.php');
// sschk();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP:400,700|Noto+Serif+JP:400,700&display=swap" rel="stylesheet"> 
       <!-- font-family: 'Noto Serif JP', serif;
        font-family: 'Noto Sans JP', sans-serif; -->
    <link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style_about.css">
    <title>手のひらストーリーって？</title>
</head>
<body class="top" onload="init()">
<!-- ヘッダー領域 -->
<header> 
        <div class="header-wrap">
            <video id="video" src="asset/index_people_mono.mp4" muted loop autoplay playsinline></video>
            <div class="nav-wrap">
                <div id="logo">
                    <a href="">
                    <img src="asset/logo_white1.png" alt="手のひらストーリー">
                    </a>
                </div>
            </div>
            <p>
                <a class="link" href="aboutus.php" >会員登録する</a>
                <a class="link" href="aboutus.php" >生産者登録する</a>
            </p>
        </div>
    </header>
<!-- コンテンツ領域 -->
<main id="main" class="site-main">
    <section id="about">
        <h3><span class="under">「手のひらストーリー」とは</span></h3>
        <article>
<h4>◾️「？」を「！（Wow!）」へ。</h4>
<br>
売り場はストーリーのテーマパーク。<br>
<br>
何かに惹かれてものを買ったり、思い立ってどこかへ足を伸ばしたり。<br>
それをだれかに伝えたくなったり。<br>
私たちは、実は、目の前のモノだけでなく、<br>
モノが語るコト、コトがつなぐヒト、<br>
その背景にあるストーリーに心を動かされ、<br>
記憶に刻んでいることに気づきました。<br>
<br>
世界は今、飛び交う情報であふれています。<br>
だからこそ、<br>
その人ならではの「アンテナ」が動く瞬間を逃さず、大切にしたい。<br>
全国各地で埋もれている、<br>
体温を持ったものづくりのストーリーに気づいてほしい。<br>
<br>
ただモノの消費を促す「売り場」ではなく、<br>
一期一会の出会いが生む「？」を「！」に変え、<br>
距離を超えて人と人がつながる空間へ。<br>
<br>
2020。手のひらストーリー、始まります。<br>
<br>
<br>
    </article>
    <br>
    </section>
    <section id="projects">
        <h3>
            <p>
                まずは広島県の<br>
                ブランドショップTAU（たう）から<br>
                思いをともにする<br>
                首都圏のアンテナショップへ<br>
            </p>
        </h3>
        <article>
            <div>
              <div id="map" style="width:80%;height:200px;"></div>
            </div>
        </article>
        <br>
    </section>
    <section id="thought">
        <h3><span class="under">私たちが目指していること</span></h3>
        <article>
                ううう
        </article>
        <br>
    </section>
    <section id="about_us">
        <h3><span class="under">WE ARE</span></h3>
        <article>
            <br>
            <div class="big-img">
                <img src="https://paper.dropbox.com/ep/redirect/image?url=https%3A%2F%2Fpaper-attachments.dropbox.com%2Fs_DE8A41C2892CAD293F4AA8425B4F484FBD64FB5A5B56E56A36DB2B6AF1C310D3_1576894429678_image.png&hmac=UUL6HWp1%2FItbFSr823ilxT%2FMHRyFb%2BrbVDIC2wgO9rw%3D&width=1490" alt="">
            </div>
            <div class="us_text">
                えええ
            </div>
           
        </article>
    </section>
    <section id="credit">
        <h3><span class="under"></span></h3>
        <article>
            おおお
        </article>
        <br>
    </section>
</main>

<!-- フッター領域（仮設置） -->
<footer>
    <span style="font-family: 'M PLUS Rounded 1c', sans-serif">©︎　手のひらストーリー</span>
</footer>

<script src="http://maps.google.com/maps/api/js?key=AIzaSyCGPRERWKgyKDrfHWTZR-ospE2Ve_U4U58&language=ja"></script>    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script>
let map;
let marker;
function init() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {
            lat: 35.6743077,
            lng: 139.767353
        },
        zoom: 15, // 地図のズームを指定
        scaleControl: true, 
    });
    marker = new google.maps.Marker({
        position: {lat:35.6743077,lng:139.767353},
        map: map,
    });
    let info = new google.maps.InfoWindow({
        content:
         'ひろしまブランドショップTAU<br>東京都中央区銀座１丁目６−１０ 銀座上一ビルディング',
    });
    info.open(map,marker);

}
</script>

</body>
</html>