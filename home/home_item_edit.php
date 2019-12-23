<?php

session_start(); // session start

include('../functions/functions.php'); // 関数をinclude

if(!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] != session_id()){
    //ログインしていない状態で訪れた場合、ログイン画面に遷移。メッセージを表示するためのフラグも持たせる
    $_SESSION["checkout"]=true;
    redirect("home_login.php"); 
  }  

$fileroot = __DIR__."/items/".$_SESSION["users_id"]; // 保存先のフォルダー

// 保存先のフォルダーが存在するかどうか確認する
if(!file_exists($fileroot)){
    //フォルダーが存在しないので作成する
    // mkdir($fileroot, 0644);
    mkdir($fileroot);
}

// エラーを返すための変数を宣言
$error=[];
$_SESSION["intro_edit_check"]="";

//postで送られてきたテキストデータを変数に渡す
$title = $_POST["title"];
$spec = $_POST["spec"];
$desc = $_POST["desc"];

//無害化
$title = hCheck($title);
$spec = hCheck($spec);
$desc = hCheck($desc);

if(empty($title)){
  $error[]="タイトルが入力されておりません。";
}

if(empty($spec)){
  $error[]="商品仕様が入力されておりません。";
}

if(empty($desc)){
    $error[]="商品紹介が入力されておりません。";
  }

// $_SESSION["intro_edit_check"]=$error;

// 本文およびテキストがなければ、一旦returnしてエラーを表示
//media Fileが送信されてきているのか？チェック！

if(empty($error)){
 if (isset($_FILES["upfile"] ) && $_FILES["upfile"]["error"] ==0 ) {
    // $errorをグローバル化
    global $error;
    //情報取得
    $file_name = $_FILES["upfile"]["name"];
    $tmp_path  = $_FILES["upfile"]["tmp_name"];
    //ユニークファイル名作成
    $extension = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_name = date("YmdHis").md5(session_id()) . "." . $extension;
    // FileUpload [--Start--]
    
    $file_dir_path = $fileroot."/".$file_name;
    
     if (is_uploaded_file($tmp_path)) {
           if (move_uploaded_file($tmp_path, $file_dir_path)) {
            // chmod( $file_dir_path, 0644 );
 
            // すべて揃ったのでDBに登録する
            // ファイル名をDBにアップロードする。
            $pdo = db_conn(); // include -> functions.php -> function db_conn();
            $sql ="INSERT INTO mst_product (c_code,p_name,p_spec,p_text,p_img) VALUES (:c_code,:title,:spec,:desc,:media)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':c_code', $_SESSION["users_id"], PDO::PARAM_STR); 
            $stmt->bindValue(':title', $title, PDO::PARAM_STR); 
            $stmt->bindValue(':spec', $spec, PDO::PARAM_STR); 
            $stmt->bindValue(':desc', $desc, PDO::PARAM_STR); 
            $stmt->bindValue(':media', $file_name, PDO::PARAM_STR); 
            $status = $stmt->execute(); // 成功ならtrue, 失敗ならfalse
            
            // 直前でINSERTしたp_codeを取得する
            $sql = "SELECT LAST_INSERT_ID()";
            $stmt = $pdo->prepare($sql);
            $status2 = $stmt->execute(); // 成功ならtrue, 失敗ならfalse
            $r = $stmt->fetch();
            //var_dump($r["LAST_INSERT_ID()"]);
            
            if($status==false || $status2==false) {
                $error[]="データーベースに接続ができませんでした。";
                $_SESSION["intro_edit_check"]=$error;
                redirect("../home_items.php");
                exit;
            }else{
                $sql ="INSERT INTO mst_asset (p_code,a_id,a_path,a_size,a_type,a_lw) VALUES (:p_code,:a_id,:a_path,:a_size,:a_type,:a_lw)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':p_code', $r["LAST_INSERT_ID()"], PDO::PARAM_STR); 
                $stmt->bindValue(':a_id', $file_name, PDO::PARAM_STR); 
                $stmt->bindValue(':a_path', "test", PDO::PARAM_STR); 
                $stmt->bindValue(':a_size', "100", PDO::PARAM_INT); 
                $stmt->bindValue(':a_type', "test", PDO::PARAM_STR); 
                $stmt->bindValue(':a_lw', "2", PDO::PARAM_INT); 
                $status3 = $stmt->execute(); // 成功ならtrue, 失敗ならfalse

                if($status3==false){
                  $error[]="データーベースに接続ができませんでした。";
                  $_SESSION["intro_edit_check"]=$error;
                  redirect("../home_items.php");
                  exit;
                }else{
                    // $error=[];
                    $error[]="登録が完了しました！";
                    $_SESSION["intro_edit_check"]=$error;
                    redirect("../home_items.php");
                    exit;
                }  
            }     
        } else {
            $error[]= "Error:アップロードできませんでした。";
            redirect("../home_items.php");
            exit;
        }
    }
  }else{
    $error[]= "Error:画像が送信されていません";
    $_SESSION["intro_edit_check"]=$error;
    redirect("../home_items.php");
    exit;
  }
}else{
 // title,spec, descが入力されていなければ、ファイルアップロードせずにループを抜ける
 $_SESSION["intro_edit_check"]=$error;

 //var_dump($_SESSION["intro_edit_check"]);
 
 redirect("../home_items.php");
 exit;
 
} 


exit;

?>