<?php

session_start(); // session start

include('../functions/functions.php'); // 関数をinclude

if(!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] != session_id()){
    //ログインしていない状態で訪れた場合、ログイン画面に遷移。メッセージを表示するためのフラグも持たせる
    $_SESSION["checkout"]=true;
    redirect("home_login.php"); 
  }  

$fileroot = __DIR__."/news/".$_SESSION["users_id"]; // 保存先のフォルダー

// 保存先のフォルダーが存在するかどうか確認する
if(!file_exists($fileroot)){
    //フォルダーが存在しないので作成する
    mkdir($fileroot, 0644);
}

// エラーを返すための変数を宣言
$error=[];
$_SESSION["intro_edit_check"]="";

//postで送られてきたテキストデータを変数に渡す
$p_code = $_POST["products_code"];
$title = $_POST["title"];
$article = $_POST["article"];

//無害化
$title = hCheck($title);
$p_code = hCheck($p_code);
$article = hCheck($article);

if(empty($p_code)){
    $error[]="表示先商品が選択されておりません";
}

if(empty($title)){
  $error[]="タイトルが入力されておりません。";
}

if(empty($article)){
  $error[]="本文が入力されておりません。";
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
            
            if($p_code==='all'){
             //全商品に表示が選択されると all_flagを"1"にし、p_codeには"0"を入れる
              $sql ="INSERT INTO dat_news (p_code,c_code,n_img,title,article,all_flag) VALUES (:p_code,:c_code,:n_img,:title,:article,:all_flag)";
            }else{
              //個別に商品が選ばれた場合 p_codeに特定の商品
              $sql ="INSERT INTO dat_news (p_code,c_code,n_img,title,article) VALUES (:p_code,:c_code,:n_img,:title,:article)";
            }
            
            $stmt = $pdo->prepare($sql);

            if($p_code==='all'){
                //全商品に表示が選択されると all_flagを"1"にし、p_codeには"0"を入れる
                $stmt->bindValue(':p_code', 0, PDO::PARAM_STR); 
                $stmt->bindValue(':all_flag', 1, PDO::PARAM_STR); 
               }else{
                 //個別に商品が選ばれた場合 p_codeに特定の商品
                 $stmt->bindValue(':p_code', $p_code, PDO::PARAM_STR); 
               }

            $stmt->bindValue(':c_code', $_SESSION["users_id"], PDO::PARAM_STR); 
            $stmt->bindValue(':title', $title, PDO::PARAM_STR); 
            $stmt->bindValue(':article', $article, PDO::PARAM_STR); 
            $stmt->bindValue(':n_img', $file_name, PDO::PARAM_STR); 
            $status = $stmt->execute(); // 成功ならtrue, 失敗ならfalse

            if($status==false) {
                $error[]="データーベースに接続ができませんでした。";
                $_SESSION["intro_edit_check"]=$error;
                redirect("../home_news.php");
                exit;
            }else{
               // $error=[];
                $error[]="登録が完了しました！";
                $_SESSION["intro_edit_check"]=$error;
                redirect("../home_news.php");
                exit;
            }     

        } else {
            $error[]= "Error:アップロードできませんでした。";
            redirect("../home_news.php");
            exit;
        }
    }
  }else{
    $error[]= "Error:画像が送信されていません";
    $_SESSION["intro_edit_check"]=$error;
    redirect("../home_news.php");
    exit;
  }
}else{
 // title,spec, descが入力されていなければ、ファイルアップロードせずにループを抜ける
 $_SESSION["intro_edit_check"]=$error;

 //var_dump($_SESSION["intro_edit_check"]);
 
 redirect("../home_news.php");
 exit;
 
} 


exit;

?>