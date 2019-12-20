<?php

session_start(); // session start

include('../functions/functions.php'); // 関数をinclude

if(!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] != session_id()){
    //ログインしていない状態で訪れた場合、ログイン画面に遷移。メッセージを表示するためのフラグも持たせる
    $_SESSION["checkout"]=true;
    redirect("home_login.php"); 
  }  

// アップロードするファイル名が送信されたか＝選択されたかどうか判定。無ければfalseを返して終了
$file_name = $_FILES["file_1"]["name"];

if(empty($file_name)){
    echo "false";
    exit;
}

// 保存先にすでにフォルダーかどうか確認する
// 生産者紹介ページに使用するファイルのディレクトリ構造
// mono/home/upload/お客様番号
// アップロードの度にファイルが増えてしまう。
// それを防ぐためにアップロードの度に、以前保存したものを消去しよう

// お客様固有のアップロード先
$fileroot = __DIR__."/upload/".$_SESSION["users_id"]; 

// 再帰的にディレクトリを削除する関数
function remove_directory($dir) {
    $files = array_diff(scandir($dir), array('.','..'));
    foreach ($files as $file) {
        // ファイルかディレクトリによって処理を分ける
        if (is_dir("$dir/$file")) {
            // ディレクトリなら再度同じ関数を呼び出す
            remove_directory("$dir/$file");
        } else {
            // ファイルなら削除
            unlink("$dir/$file");
           //  echo "ファイル:" . $dir . "/" . $file . "を削除\n";
        }
    }
    // 指定したディレクトリを削除
    //echo "ディレクトリ:" . $dir . "を削除\n";
    return rmdir($dir);
}

// 上記関数を利用して”該当フォルダーがあった場合”中身ごと消去
remove_directory($fileroot); 

// 新規にフォルダーを作成する。
// if (mkdir($fileroot, 0700)){
//     echo 'フォルダを作成しました。';
//   }else{
//     echo 'フォルダの作成が失敗しました。';
//   }
mkdir($fileroot, 0700);

$extension = pathinfo($file_name, PATHINFO_EXTENSION);

// ユニークなファイル名をつける
$file_name = $_SESSION["users_id"]."_".date("YmdHis").md5(session_id()).".".$extension;

// ファイル名をDBにアップロードする。
$pdo = db_conn(); // include -> functions.php -> function db_conn();
$sql ="UPDATE mst_creater SET media=:file_name WHERE c_code = '{$_SESSION["users_id"]}'";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':file_name', $file_name, PDO::PARAM_STR); 
$status = $stmt->execute(); // 成功ならtrue, 失敗ならfalse

if($status==false) {
    echo "false";
    exit;
    //sql_error($stmt); // include -> functions.php > function sql_error();
  }else{
    
// 一時アップロード先ファイルパス
$file_tmp  = $_FILES["file_1"]["tmp_name"];

// 正式保存先ファイルパス
//$file_save = __DIR__."/upload/". $_FILES["file_1"]["name"];
$file_save = $fileroot."/".$file_name;

// var_dump($file_save);
// exit;

// ファイル移動
$result = @move_uploaded_file($file_tmp, $file_save);
if ( $result === true ) {
    echo $file_name;
 } else {
    echo "false";
 }
}

?>