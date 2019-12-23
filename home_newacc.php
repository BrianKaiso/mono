<?php
   // session start
   session_start();

   // functions include
   include(__DIR__.'/functions/functions.php');

   // html header include
   include(__DIR__.'/include/home/header.php'); 

   if(isset($_SESSION["chk_ssid"])){
     redirect("home_mypage.php");
    }

?>

<h1>出品者新規登録</h1><br />

<!-- セラー新規登録ページ    -->
<div>
<p>アカウントを作成するには、必要事項を記入して、新規登録ボタンをクリックしてください。</p>
<?php   
if(isset($errMsg)){
  echo $errMsg;
}
?>

<div class="login">
<div id="errmsg"></div> 
<?php //echo $outPut; ?>

<div id="loginBox3">
<!-- newacc_act.php はアカウント新規作成用のPHPです。 -->
<form id="newaccForm" action="#">
<p class="myright"><span>*は必須項目です。</span></p><br />
<h2>ユーザー情報</h2>
<fieldset class="first">
        <dl><dt>社名/商号<span>*</span></dt><dd><input id="users_name" type="text" name="users_name" size="25" maxLength="25" oninput="isInCk(this)" /><span></span></dd></dl>
        <dl><dt>担当者氏名<span>*</span></dt><dd><input id="users_name_in_charge" type="text" name="users_name_in_charge" size="25" maxLength="25" oninput="isInCk(this)" /><span></span></dd></dl>
        <dl><dt>郵便番号<span>*</span></dt><dd><input id="users_post1" type="text" name="users_post1" size="4" maxLength="3" oninput="isRegNumP1(this)" />&nbsp;-&nbsp;<input id="users_post2" type="text" name="users_post2" size="8" maxLength="4" oninput="isRegNumP2(this)"  />
        <br /><span id="postcheck"></span></dd></dl>
        <dl><dt>都道府県<span>*</span></dt><dd>
             <select id="pref" name="users_pref" oninput="isInCk(this)">
<option value="" selected>都道府県</option>
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
</select></dd></dl>
           <dl><dt>市町村<span>*</span></dt><dd><input id="city" type="text" name="users_city" size="25" maxLength="16" oninput="isInCk(this)" /></dd></dl>
           <dl><dt>住所<span>*</span></dt><dd><input id="add" type="text" name="users_address" size="25" maxLength="50" oninput="isInCk(this)" /></dd></dl>
           <dl><dt>電話番号<span>*</span></dt><dd><input id="phone" type="text" name="users_phone" size="25" maxLength="16" onBlur="isRegPh(this)" /><br /><span id="phcheck"></span></dd></dl>
</fieldset>
<h2>ログイン情報</h2>
<fieldset class="second">
        <dl><dt>メール<span>*</span></dt><dd><input id="myemail" type="text" name="users_email" size="25" maxLength="50" placeholder="メール" onBlur="isRegEmail(this)"/><br /><span id="emailcheck"></span></dd></dl>
        <dl><dt>パスワード<span>*</span></dt><dd><input type="password" id="pwd" name="lpw" size="25" maxLength="25" placeholder="パスワード"/><br /><span id="pwdcheck1"></span></dd></dl>
       <dl><dt>パスワード<span>*</span><br /><span class="small">&nbsp;&nbsp;&nbsp;&nbsp;(再入力)</span></dt>
       <dd><input type="password" id="pwd2" name="lpw" size="25" maxLength="25" placeholder="もう一度入力してください。"/>
           <br /><span id="pwdcheck2"></span>
        </dd>
        </dl>
       <dl><dt></dt><dd><input type="checkbox" id="password-check" />&nbsp;&nbsp;パスワードを表示する</dd></dl>
        
        <p class="exp">パスワードに使える文字: 5～16文字以内で半角のアルファベット小文字、大文字、数字を1種類以上含めてください。</p>
</fieldset>
<div id="caub4">
<a id="accBtn3" onclick="newAccAct()">アカウントを作成する</a>
</div>
</form>
</div> <!-- loginBox3 ends here -->

 </div> 
 <!-- フォームここで終わり-->

 <script>
     // フォーム入力: パスワードの表示オンオフ
 const pwd = document.getElementById('pwd');
 const pwd2 = document.getElementById('pwd2');
 const pwdCheck = document.getElementById('password-check');
       pwdCheck.addEventListener('change', function() {
     if(pwdCheck.checked) {
         pwd.setAttribute('type', 'text');
         pwd2.setAttribute('type', 'text');
     } else {
         pwd.setAttribute('type', 'password');
         pwd2.setAttribute('type', 'password');
     }
 }, false);


// フォーム入力の有無チェック
function isInCk(obj){
    const str=obj.value;
    const id=obj.id;
    console.log(id);
    if(!str){
        console.log("入力無");
        document.getElementById(id).classList.remove("com");
    }else{
        console.log("入力あり");
        document.getElementById(id).classList.add("com");
    }
}

// フォーム入力チェック 郵便番号、電話番号、メールアドレス
let postcheckOK=false; // 郵便番号前半部分 正しく入力された際のフラグ
let postcheck2OK=false; // 郵便番号後半部分 正しく入力された際のフラグ
let phonecheckOK=false; // 電話番号 正しく入力された際のフラグ
let mailcheckOK=false; // メール 正しく入力された際のフラグ
let pwdcheckOK=false; // pwd 正しく入力された際のフラグ

function isRegNumP1(obj){
        /* 入力値 */
        const postcheck = document.getElementById('postcheck');
        //const digit=num; // 桁数
        const str=obj.value; /* 数値以外の文字列が含まれていた場合 */
        //const reg=`/^[0-9]{3}$/g`;
        //console.log(reg);
        console.log("onInputイベント");

        if(str.match(/[^0-9]/g)){
            postcheck.innerHTML="*半角数字でご入力ください。";
            document.getElementById("users_post1").classList.remove("com");
            postcheckOK=false; 
        }else if(str.match(/^[0-9]{3}$/g)){
            console.log("桁数=3が正しい");
            postcheck.innerHTML="";
            document.getElementById("users_post1").classList.add("com");
            postcheckOK=true;
        }else{
            postcheck.innerHTML="*桁数が正しいかご確認ください。";
            document.getElementById("users_post1").classList.remove("com");
            postcheckOK=false; 
         }
        
        // if(str.match(reg)){
        //     console.log("桁数が正しい");
        // }else{
        //     postcheck.innerHTML="郵便番号の桁数が正しいかご確認ください。";
        // }
}

function isRegNumP2(obj){
        /* 入力値 */
        const postcheck = document.getElementById('postcheck');
        const str=obj.value; /* 数値以外の文字列が含まれていた場合 */
        if(str.match(/[^0-9]/g)){
            postcheck.innerHTML="*半角数字でご入力ください。";
            document.getElementById("users_post2").classList.remove("com");
            postcheck2OK=false;
        }else if(str.match(/^[0-9]{4}$/g)){
            console.log("桁数正しい");
            postcheck.innerHTML="";
            document.getElementById("users_post2").classList.add("com");
            postcheck2OK=true; 
        }else{
            postcheck.innerHTML="*桁数が正しいかご確認ください。";
            document.getElementById("users_post2").classList.remove("com");
            postcheck2OK=false; 
         }
}
function isRegPh(obj){
        /* 入力値 */
        const phcheck = document.getElementById('phcheck');
        const str=obj.value; /* 数値以外の文字列が含まれていた場合 */
        console.log(str);
        if(!str){
        console.log("入力無");
        document.getElementById("phone").classList.remove("com");
        phcheck.innerHTML="";
        phonecheckOK=false;
        }else if(str.match(/^(0{1}\d{1,4}-{0,1}\d{1,4}-{0,1}\d{4})$/)){
            console.log("正しく入力あり");
            document.getElementById("phone").classList.add("com");
            phcheck.innerHTML="";
            phonecheckOK=true;
        }else{
            phcheck.innerHTML="*半角数字で市外局番から入力してください。";
            document.getElementById("phone").classList.remove("com");
            phonecheckOK=false;
        }
}
function isRegEmail(obj){
    const emailcheck = document.getElementById('emailcheck');
    console.log("Email");
    const str=obj.value; /* 所定の書式以外のEmail文字列が含まれていた場合 */
    if(str.match(/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/g)){
        console.log("Email書式正しい");
        emailcheck.innerHTML="";
        document.getElementById("myemail").classList.add("com");
        mailcheckOK=true;
    }else{
        emailcheck.innerHTML="*メールアドレスの形式が正しくありません。";
        document.getElementById("myemail").classList.remove("com");
        mailcheckOK=false;
    }
    if(!str){
        emailcheck.innerHTML="";
        document.getElementById("myemail").classList.remove("com");
        mailcheckOK=false;
    }
}

let passCheck1=0;  // パスワード1とパスワード2のダブルチェック用フラグ
let passCheck2=0;  // パスワード1とパスワード2のダブルチェック用フラグ
let passMatch=0;
let pwdck1;
let pwdck2;
// パスワードチェック
$("#pwd").blur(function(){
  console.log("PWD 入力ありました");
  const pwdcheck = document.getElementById('pwdcheck1');
  const pwdcheck2 = document.getElementById('pwdcheck2');
  pwdck1=$("#pwd").val();
//   console.log(pwdcheck);
 console.log(pwdck1);
  if(pwdck1.match(/^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)[a-zA-Z\d]{5,16}$/)){
   console.log("書式正しい");
   pwdcheck.innerHTML="";
   document.getElementById("pwd").classList.add("com");
   passCheck1=1;
   if(passCheck2===1){
       if(pwdck2===pwdck1){
         console.log("マッチングしました！");
         pwdcheck.innerHTML="";
         pwdcheck2.innerHTML="*パスワードがマッチしました！";
         passMatch=1;
         console.log(`パスマッチNum= ${passMatch}`);
         pwdcheckOK=true;
       }else{
        pwdcheck2.innerHTML="*パスワードがマッチしません。";
        passMatch=0;
        console.log(`パスマッチNum= ${passMatch}`);
        pwdcheckOK=false;
       }
   }
  }else{
    pwdcheck.innerHTML="*パスワードの形式が正しくありません。";
    pwdcheck2.innerHTML="";
    document.getElementById("pwd").classList.remove("com");
    passCheck1=0;
    console.log(pwdck1);
    pwdcheckOK=false;
  }
  if(!pwdck1){
      console.log("pwd1 入力無");
      document.getElementById("pwd").classList.remove("com");
      pwdcheck.innerHTML="";
      pwdcheck2.innerHTML="";
      passCheck1=0;
      pwdcheckOK=false;
  }
  console.log(passCheck1);
});
$("#pwd2").blur(function(){
  console.log("PWD2 入力ありました");
  const pwdcheck = document.getElementById('pwdcheck2'); 
  pwdck2=$("#pwd2").val();
//   console.log(pwdcheck);
//   console.log(str);
if(pwdck2.match(/^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)[a-zA-Z\d]{5,16}$/)){
   console.log("書式正しい");
   document.getElementById("pwd2").classList.add("com");
   pwdcheck.innerHTML="";
   passCheck2=1;
   console.log(pwdck2);
   if(passCheck1===1){
       if(pwdck2===pwdck1){
          console.log("マッチングしました！");
          pwdcheck.innerHTML="*パスワードがマッチしました！";
          passMatch=1;
          console.log(`パスマッチNum= ${passMatch}`);
          pwdcheckOK=true;
       }else{
        pwdcheck.innerHTML="*パスワードがマッチしません。";
        passMatch=0;
        console.log(`パスマッチNum= ${passMatch}`);
        pwdcheckOK=false;
       }
   }
  }else{
    pwdcheck.innerHTML="*パスワードの形式が正しくありません。";
    document.getElementById("pwd2").classList.remove("com");
    passCheck2=0;
    pwdcheckOK=false;
  }
  if(!pwdck2){
      console.log("pwd2 入力無");
      document.getElementById("pwd2").classList.remove("com");
      pwdcheck.innerHTML="";
      passCheck2=0;
      pwdcheckOK=false;
  }
  console.log(passCheck2);
});

$("#pwd2").on('input',function(){
if(passCheck1===1 && passCheck2===1){
console.log("マッチングしました！")
}
});

// マイアカウント作成ボタンをクリックした際の処理
function newAccAct(){
    console.log("クリック！");
    console.log(`パスワードチェックfalse/true= ${pwdcheckOK}`);
    
    let getPost1;
    let getPost2;
    let getPhone;
    let getMail;
    let getPwd;

    // 郵便番号
    if(postcheckOK){
        getPost1=$("#users_post1").val();
        console.log(`郵便番号前半= ${getPost1}`);
    }
    if(postcheck2OK){
        getPost2=$("#users_post2").val();
        console.log(`郵便番号後半= ${getPost2}`);
    }
    if(phonecheckOK){
        getPhone=$("#phone").val();
        console.log(`電話番号= ${getPhone}`);
    }
    if(mailcheckOK){
        getMail=$("#myemail").val();
        console.log(`メール= ${getMail}`);
    }
    if(pwdcheckOK){
        getPwd=$("#pwd").val();
        console.log(`クリック時のPWD= ${getPwd}`);
    }
    let getName = $("#users_name").val();
    let getName_in_charge = $("#users_name_in_charge").val();
    let getPref = $("#pref").val();
    let getCity = $("#city").val();
    let getAddress = $("#add").val(); 
    console.log(getName);  
    console.log(getPref);  
    console.log(getCity);  
    console.log(getAddress);  

    let Error = [];
    if(!getName){
       Error.push('<p>社名/商号が入力されておりません。</p>');
    }
    if(!getName_in_charge){
       Error.push('<p>担当者氏名が入力されておりません。</p>');
    }
    if(!getPost1 && !getPost2){
        Error.push('<p>郵便番号が正しく入力されておりません。</p>');
    }
    if(!getPref){
        Error.push('<p>都道府県が選択されておりません。</p>');
    }
    if(!getCity){
        Error.push('<p>市町村が入力されておりません。</p>');
    }
    if(!getAddress){
        Error.push('<p>住所が入力されておりません。</p>');
    }
    if(!getPhone){
        Error.push('<p>電話番号が正しく入力されておりません。</p>');
    }
    if(!getMail){
        Error.push('<p>メールアドレスが正しく入力されておりません。</p>');
    }    
    if(!getPwd){
         Error.push('<p>パスワードが正しく入力されておりません。</p>');
    }
    
    //console.log(document.getElementById('caub4'));
    const caub4=document.getElementById('caub4'); // 入力した内容に問題がある場合、id="caub4"の中にエラーメッセージを表示するdivを作る
    const errmsg=document.querySelector(".cau2"); // エラーメッセージを入れるdiv

    if(errmsg){
        errmsg.remove(); // すでにエラーメッセージがあれば一度消去
    }
    if(Error.length > 0){
        caub4.insertAdjacentHTML('afterbegin', "<div class=\"cau2\">"); // エラーメッセージ前半部
        Error.forEach(function(value){ 
            document.querySelector('.cau2').insertAdjacentHTML('afterbegin', value); 
        });
        caub4.insertAdjacentHTML('beforeend', "</div>"); // エラーメッセージ前半部
    }else{
        
        // 全部の入力内容を確認できたので、ajaxでユーザーを追加するnewaccount_act.phpで処理する
       function ajax_newaccountAdd(){
       return $.ajax({
        type: 'post',
        url: 'home_newaccount_act.php',
        data: {
            name:getName,
            name_in_charge:getName_in_charge,
            post1:getPost1,
            post2:getPost2,
            pref:getPref,
            city:getCity,
            address:getAddress,
            phone:getPhone,
            email:getMail,
            pwd:getPwd
        },
        dataType:'json',
       });
     }
     // returnでajaxの処理を返す 
      ajax_newaccountAdd().done(function(result){
          console.log(result);

      // すでに同じEMailが登録した際、エラーメッセージを出す
      if(result===false){
        // ajax側でresultにfalseが入った場合の処理 (すでに同じEMailが登録した際)
        console.log("Ajaxすでに同じメールあり");
        caub4.insertAdjacentHTML('afterbegin', "<div class=\"cau2\">"); // エラーメッセージ前半部
        document.querySelector('.cau2').insertAdjacentHTML('afterbegin', "<p>すでに同じメールアドレスが登録されています。別のアドレスをお使いください。</p>"); 
        caub4.insertAdjacentHTML('beforeend', "</div>"); // エラーメッセージ後半部
    }else if(result===true){
        console.log("Ajax登録成功");
        window.location.href = 'home_login.php'; // login.phpに遷移し、成功メッセージを表示
        // caub4.insertAdjacentHTML('afterbegin', "<div class=\"cau2\">"); // エラーメッセージ前半部
        // document.querySelector('.cau2').insertAdjacentHTML('afterbegin', result); 
        // caub4.insertAdjacentHTML('beforeend', "</div>"); // エラーメッセージ後半部
    }
    }).fail(function(XMLHttpRequest, textStatus, errorThrown){
            alert(errorThrown);
        });
    // ajax処理ここまで！
   }

}
 </script>


<p>すでにアカウントをお持ちですか？ログインは<a href="home_login.php" class="underline">こちら</a></p>
<br />
</div>
<!-- セラー新規登録 ここまで --> 

<?php 
// html header include
   include(__DIR__.'/include/home/footer.php'); 
?>