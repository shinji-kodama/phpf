<?php
session_start();

include('funcs.php');

//ワンタイムトークン発行
$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
$token = $_SESSION['token'];
// click jacking対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

 $prop = $_GET['prop'];
 if($prop=='csrf'){
    $msg = "不正なアクセスが検出されました";
    $stl = 'color:red; background-color:orange;margin-left:10px;width:450px;text-align:center;border-radius:5px;border:solid 1px brown;';
 }else if($prop=='deleted'){
    $msg = "<a href='resignup.php'>退会済みアカウントです。<br>アカウントを再発行する場合はこちらをクリックしてください</a>";
    $stl = 'color:red; background-color:orange;margin-left:10px;width:450px;text-align:center;border-radius:5px;border:solid 1px brown;';
 }else if($prop){
   $msg = "E-mailアドレスが登録されていないか、パスワードが間違っています";
   $stl = 'color:red; background-color:orange;margin-left:10px;width:450px;text-align:center;border-radius:5px;border:solid 1px brown;';
 }else{
   $msg = null;
 }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<!-- <link rel="stylesheet" href="css/main.css" /> -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Cinzel&display=swap" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
<title>ログイン</title>
</head>
<body style="background: url('img/book.jpg') no-repeat 0 0 /cover;color:white;background-color:black">

<header>
  <nav class="navbar navbar-dark bg-dark">
    <div style="font-family: 'Cinzel', serif;" class="navbar-brand">NEST for book-worms <span style="margin-left:40px;font-size:14px;">~本で緩く繋がる Social Media ~</span></div>
  </nav>
</header>

<!-- lLOGINogin_act.php は認証処理用のPHPです。 -->

<p style="<?=$stl?>"><?=$msg?></p>
<form name="form1" action="login_act.php" method="post" style="margin-left:20px;">
    <p style="font-family:serif;width:100px;margin-top:20px;">E-mail</p><input style="color:black" type="text" name="email" required />
    <p style="font-family:serif;width:100px;margin-top:20px;">Password</p><input style="color:black" type="password" name="lpw" required />
    <input type="hidden" name="token" value="<?=$token?>">
    <input style="color:black" type="submit" value="LOGIN" />
</form>

<p style="font-family:serif;margin-top:100px; margin-left:20px;">初めての方は<a style="font-weight:bold" href="signup.php">こちら</a></p>

</body>
</html>