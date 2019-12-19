<?php
   // session start
   session_start();

   // functions include
   include(__DIR__.'/functions/functions.php'); 

   if(!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] != session_id()){
     //ログインしていない状態で訪れた場合、ログイン画面に遷移。メッセージを表示するためのフラグも持たせる
     $_SESSION["checkout"]=true;
     redirect("home_login.php"); 
   }    

   // html header include
   include(__DIR__.'/include/home/header.php'); 

   // DBよりセラー情報を取得
   // var_dump($_SESSION["users_id"]); セラーidが入っている

   // 1.  DB接続します
   $pdo = db_conn(); // include -> functions.php -> function db_conn();

   // 2. $sql ="SELECT * FROM products WHERE products_cat_id = 2 ORDER BY products_id DESC";
   $sql ="SELECT * FROM mst_creater WHERE c_code = '{$_SESSION["users_id"]}'";

   //3 ．$sqlをprepareに渡してステートメントに入れる
   $stmt = $pdo->prepare($sql);
   $status = $stmt->execute(); // 成功ならtrue, 失敗ならfalse
 
   if($status==false) {
     sql_error($stmt); // include -> functions.php > function sql_error();
   }else{
     $r = $stmt->fetch();
 }

$pdo=null;
// DB接続エンドHere

?>

<main> <!-- マイページ コンテンツここから   -->
<h1>マイページ</h1>
<ul>
<li><a href="/mono/home_mypage.php">マイページ</a></li>
<li><a href="/mono/home/home_items.php">商品</a></li>
<li><a href="/mono/home/home_news.php">ニュース</a></li>
<li><a href="/mono/home/home_contents.php">コンテンツ</a></li>
</ul>

<!-- マイページ基本情報表示と更新  -->
<div>
  <p><?=$r["name"] ?></p> <!-- 社名/屋号  -->
  <div> <!-- 基本情報前半 -->
    <p>写真アップロードここ</p>
    <button>写真アップロード</button>
  </div> <!-- 基本情報前半終わりここ -->
  
  <div> <!-- 基本情報後半 --> 
  <fieldset>
    <legend>基本情報</legend>
    <dl>
      <dt>担当者<dt>
      <dd><input type="text" id="name_in_charge" name="name_in_charge" size="25" maxLength="25" value="<?=$r["name_in_charge"]?>" /><dd>
      <dt>郵便番号<dt>
      <dd><input type="text" id="postal1" name="postal1" size="4" maxLength="3" value="<?=$r["postal1"]?>" />&nbsp;-&nbsp;<input type="text" id="postal2" name="postal2" size="6" maxLength="4" value="<?=$r["postal2"]?>" /><dd>
      <dt>都道府県<dt>
      <dd><select id="pref" name="pref">
<option value="<?=$r["pref"]?>" selected><?=$r["pref"]?></option>
<option value="北海道">北海道</option>
<option value="青森県">青森県</option>
<option value="岩手県">岩手県</option>
<option value="宮城県">宮城県</option>
<option value="秋田県">秋田県</option>
<option value="山形県">山形県</option>
<option value="福島県">福島県</option>
<option value="茨城県">茨城県</option>
<option value="栃木県">栃木県</option>
<option value="群馬県">群馬県</option>
<option value="埼玉県">埼玉県</option>
<option value="千葉県">千葉県</option>
<option value="東京都">東京都</option>
<option value="神奈川県">神奈川県</option>
<option value="新潟県">新潟県</option>
<option value="富山県">富山県</option>
<option value="石川県">石川県</option>
<option value="福井県">福井県</option>
<option value="山梨県">山梨県</option>
<option value="長野県">長野県</option>
<option value="岐阜県">岐阜県</option>
<option value="静岡県">静岡県</option>
<option value="愛知県">愛知県</option>
<option value="三重県">三重県</option>
<option value="滋賀県">滋賀県</option>
<option value="京都府">京都府</option>
<option value="大阪府">大阪府</option>
<option value="兵庫県">兵庫県</option>
<option value="奈良県">奈良県</option>
<option value="和歌山県">和歌山県</option>
<option value="鳥取県">鳥取県</option>
<option value="島根県">島根県</option>
<option value="岡山県">岡山県</option>
<option value="広島県">広島県</option>
<option value="山口県">山口県</option>
<option value="徳島県">徳島県</option>
<option value="香川県">香川県</option>
<option value="愛媛県">愛媛県</option>
<option value="高知県">高知県</option>
<option value="福岡県">福岡県</option>
<option value="佐賀県">佐賀県</option>
<option value="長崎県">長崎県</option>
<option value="熊本県">熊本県</option>
<option value="大分県">大分県</option>
<option value="宮崎県">宮崎県</option>
<option value="鹿児島県">鹿児島県</option>
<option value="沖縄県">沖縄県</option>
</select><dd>
      <dt>市町村<dt>
      <dd><input type="text" id="city" name="city" size="25" maxLength="16" value="<?=$r["city"]?>" /><dd>
      <dt>住所<dt>
      <dd><input type="text" id="address" name="address" size="25" maxLength="50" value="<?=$r["address"]?>" /><dd>
      <dt>電話番号<dt>
      <dd><input type="text" id="tel" name="tel" size="25" maxLength="16" value="<?=$r["tel"]?>" /><dd>
    </dl>
    <button onclick=update_basic()>基本情報を更新</button>&nbsp;&nbsp;&nbsp;<span id="basicUpdated"><span>
    <!-- 基本情報が適切に更新された際にメッセージを表示します  -->
    </fieldset>

    <fieldset>
      <legend>ログイン情報</legend>
      <dl>
      <dt>Email<dt>
      <dd><input type="text" id="email" name="email" size="25" maxLength="50" value="<?=$r["c_id"]?>" /></dd>
      <button onclick=update_email()>メールアドレスを更新</button>
      <p id="emailUpdated"></p>
      <dt>ログインパスワード<dt>
      <dd><input type="text" id="pwd_old" name="pwd_old" size="25" maxLength="25" placeholder="現在のパスワード" /><br /><input type="text" id="pwd_new" name="pwd_new" size="25" maxLength="25" placeholder="新しいパスワード" /><dd>
      </dl>
      <button onclick=update_pwd()>パスワードを更新</button>&nbsp;&nbsp;&nbsp;<span id="pwdUpdated"><span>
      <!-- ログイン情報が適切に更新された際にメッセージを表示します  -->
     </fieldset>
    

  </div> <!-- 基本情報後半終わりここ -->


</div>

</main> <!-- マイページ コンテンツここまで   -->

<script>
// 基本情報更新
function update_basic(){
 console.log("ボタン押したよ！");
 //console.log($("#tel").val());

 // フォームの内容を取得
 let name_in_charge = $("#name_in_charge").val();
 let postal1 = $("#postal1").val();
 let postal2 = $("#postal2").val();
 let pref = $("#pref").val();
 let city = $("#city").val();
 let address = $("#address").val();
 let tel = $("#tel").val();

 // Ajaxでhome/home_mypage_basicinfo_update.phpで更新処理
 function ajax_mybasicupdate(){
       return $.ajax({
        type: 'post',
        url: 'home/home_mypage_basicinfo_update.php',
        data: {
            name_in_charge: name_in_charge,
            postal1:postal1,
            postal2:postal2,
            pref:pref,
            city:city,
            address:address,
            tel:tel,
        },
        dataType:'html',
       });
    }
    // returnでajaxの処理を返す 
    ajax_mybasicupdate().done(function(result){
     // result = trueの場合 = 成功
     if(result){
      console.log('ajax基本情報updateしました。');
      console.log(result);
      //console.log(`ajaxデータ= ${mycart[get_products_id]}`); 
      //document.getElementById("basicUpdated").textContent = `(${cartNumTotal})`;
      $("#basicUpdated").fadeIn(700).text("基本情報を更新しました。");
      $(function(){
      setTimeout(function(){
        $("#basicUpdated").fadeOut(600);
       },1900);
     });
     }else{
      console.log('ajax基本情報update失敗');
      console.log(result);
      $("#basicUpdated").fadeIn(700).text("基本情報の更新に失敗しました。管理までお問い合わせください。");
      $(function(){
      setTimeout(function(){
        $("#basicUpdated").fadeOut(600);
       },1900);
     });
     }
    }).fail(function(XMLHttpRequest, textStatus, errorThrown){
            alert(errorThrown);
    });

} // 基本情報更新ここまで


// Email更新
function update_email(){
 console.log("Email更新ボタン押したよ！");
 
 // フォームの内容を取得
 let email = $("#email").val();
 
 // Ajaxでhome/home_mypage_email_update.phpで更新処理
 function ajax_myemailupdate(){
       return $.ajax({
        type: 'post',
        url: 'home/home_mypage_email_update.php',
        data: {
            email:email,
        },
        dataType:'html',
       });
    }
    // returnでajaxの処理を返す 
    ajax_myemailupdate().done(function(result){
      // result = trueの場合 = 成功
      console.log(result);

     if(result==='used'){
      console.log('ajaxメールアドレスすでに使用されている');
      console.log(result);
      $("#emailUpdated").fadeIn(700).text("入力されたメールアドレスはすでに使用されています。別のメールアドレスを入力してください。");
      $(function(){
      setTimeout(function(){
        $("#emailUpdated").fadeOut(600);
       },1900);
     });
     }else if(result){
      console.log('ajax Email updateしました。');
      console.log(result);
      $("#emailUpdated").fadeIn(700).text("メールアドレスを更新しました。");
      $(function(){
      setTimeout(function(){
        $("#emailUpdated").fadeOut(600);
       },1900);
     });
     }else if(!result){
      console.log('ajaxメールアドレスupdate失敗');
      console.log(result);
      $("#emailUpdated").fadeIn(700).text("メールアドレスを更新できませんでした。管理者までお問い合わせください。");
      $(function(){
      setTimeout(function(){
        $("#emailUpdated").fadeOut(600);
       },1900);
     });
     }else if(result==='error'){
      console.log('ajaxメールアドレスDBアクセス失敗');
      console.log(result);
      $("#emailUpdated").fadeIn(700).text("メールアドレスを更新できませんでした。管理者までお問い合わせください。");
      $(function(){
      setTimeout(function(){
        $("#emailUpdated").fadeOut(600);
       },1900);
     });
     }
    }).fail(function(XMLHttpRequest, textStatus, errorThrown){
            alert(errorThrown);
    });

} // Email情報更新ここまで

// パスワード更新ここから
function update_pwd(){
  console.log("ボタンが押されました！");
  $("#pwdUpdated").fadeIn(700).text("メールアドレス更新 Placeholder 未実装部分");
      $(function(){
      setTimeout(function(){
        $("#pwdUpdated").fadeOut(600);
       },1900);
     });
}

</script>

<?php 
// html header include
   include(__DIR__.'/include/home/footer.php'); 
?>