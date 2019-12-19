<?php
ini_set('display_errors', "On");
error_reporting(E_ALL);

session_start();
include('./funcs.php');

?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>動画アップロードテスト</title>
</head>
<body>
    <form method="POST" action="file_add_check.php" enctype="multipart/form-data">
    <fieldset>
       動画を選んでください<br/>
        <input type="file" name="upload"><br/>
        <select name="a_lw">
            <option value="1">縦撮影の動画</option>
            <option value="2">横撮影の動画</option>
        </select>
        <input type="submit" value="送信">
    </fieldset>
    </form>
</body>
</html>