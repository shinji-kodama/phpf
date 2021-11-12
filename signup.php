<?php
session_start();
//ワンタイムトークン発行
$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
$token = $_SESSION['token'];
// click jacking対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

$err = $_GET['duplicate'];
$msg_name = '';
$msg_email = ''; 

if($err=='name'){
    $msg_name .= '<p style="color:red">そのニックネームは既に登録されています</p>';

}
if($err=='email'){
    $msg_email .= '<p style="color:red">そのE-mailアドレスは既に登録されています</p>'; 
}


?>

<!DOCTYPE html>
<html>
<head>
    <style>
    .input:focus:valid{border:2px solid green;background-color: rgb(220, 255, 220);}
    .input:focus:invalid{border:2px solid red;background-color: rgb(255, 220, 220);}
    
    </style>
    <title>会員登録</title>
</head>
<body>
    <h1>会員登録</h1>
    <form action="reg_pre.php" method="post">
        <p style="margin-bottom:0">
            <?=$msg_name?>
            <label>ニックネーム：</label>
            <input class="input" type="text" name="name" pattern="^[0-9A-Za-z]+$" required>
            <p style="margin-top:0px;font-size:12px;">(半角英数)</p>
        </p>
        <p>
            <?=$msg_email?>
            <label>メールアドレス：</label>
            <input class="input" type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
        </p>
        <p style="margin-bottom:0">
            <label>パスワード：</label>
            <input class="input" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" type="password" name="lpw" required>
            <p style="margin-top:0px;font-size:12px;">(0~1, a~z, A~Z各1文字以上を含む８文字以上)</p>
        </p>
        <input type="hidden" name="token" value="<?=$token?>">
        <input id="submit" type="submit" name="submit" value="会員登録する">
    </form>
</body>
</html>