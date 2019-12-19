<?php
ini_set('display_errors', "On");
error_reporting(E_ALL);

session_start();
include('./funcs.php');
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>動画アップロードテスト</title>
</head>
<body>
    <?php
            $a_id = $_POST['a_id'];
            $a_path = $_POST['a_path'];
            $a_size = $_POST['a_size']; 
            $a_type = $_POST['a_type']; 
            $a_lw = $_POST['a_lw']; 

            $pdo = db_conn();

            $stmt = $pdo->prepare('INSERT INTO mst_asset(a_code,a_id,a_path,date,a_size,a_type,a_lw) VALUES(NULL, :a_id, :a_path,sysdate(), :a_size, :a_type, :a_lw)');
            $stmt->bindValue(':a_id', $a_id, PDO::PARAM_STR);
            $stmt->bindValue(':a_path', $a_path, PDO::PARAM_STR);
            $stmt->bindValue(':a_size', $a_size, PDO::PARAM_INT);
            $stmt->bindValue(':a_type', $a_type, PDO::PARAM_STR);
            $stmt->bindValue(':a_lw', $a_lw, PDO::PARAM_INT);
            $status = $stmt->execute();

    echo $a_id;
    echo 'を追加しました<br/>';
    echo '<a href="file_add.php">戻る</a>';

            if($status==false){
                sql_error($stmt);
            }else{
                return;
            }

    ?>
    
</body>
</html>
