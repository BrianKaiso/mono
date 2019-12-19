<!DOCTYPE html>
    <html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>動画アップロード</title>
    </head>
    <body>

<?php
ini_set('display_errors', "On");
error_reporting(E_ALL);

    $upload = $_FILES['upload'];
    $a_lw = $_POST['a_lw'];

    if($upload['size'] > 0){
        // if($upload['size'] > 50000000){
        //     echo '動画のサイズが大きすぎます';
        // }else{
        move_uploaded_file($upload['tmp_name'],'./upload/'.$upload['name']);
        echo '<img src="./upload/'.$upload['name'].'">';
        echo '<br/>';

        echo '上記の動画を追加します<br/>';
        echo '<form method="post" action="file_add_done.php">';
        echo '<input type="hidden" name="a_id" value="'.$upload['name'].'">';
        echo '<input type="hidden" name="a_path" value="'.$upload['tmp_name'].'">';
        echo '<input type="hidden" name="a_size" value="'.$upload['size'].'">';
        echo '<input type="hidden" name="a_type" value="'.$upload['type'].'">';
        echo '<input type="hidden" name="a_lw" value="'.$a_lw.'">';
        echo '<br/>';
        echo '<input type="button" onclick="history.back()" value="戻る">';
        echo '<input type="submit" value="OK">';
        echo '</form>';
    }   
    
?>

</body>
    </html>