<?php
session_start();
//ワンタイムトークン発行
$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
$token = $_SESSION['token'];
// click jacking対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

include('funcs.php');

$name = $_GET['name'];
$email = $_GET['email'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <h1>本登録</h1>
    <form action="reg_main.php" method="post">
        <p>
            <label>ニックネーム：</label>
            <span><?=h($name)?></span>
            <input type="hidden" name="name" value="<?=h($name)?>">
        </p>
        <p>
            <label>メールアドレス：</label>
            <span><?=h($email)?></span>
            <input type="hidden" name="email" value="<?=h($email)?>">
        </p>
        <input type="hidden" name="token" value="<?=h($token)?>">
        <p style="margin-bottom:0">
            <label>パスワード：</label>
            <input class="input" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" type="password" name="lpw" required>
            <p style="margin-top:0px;font-size:12px;">(0~1, a~z, A~Z各1文字以上を含む８文字以上)</p>
        </p>
        
        <input id="submit" type="submit" name="submit" value="本登録">
    </form>

</body>
</html>