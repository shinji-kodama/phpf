<?php
session_start();

// click jacking対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

include('funcs.php');
// セッションチェック
sschk();

$name = $_SESSION['name'];
if(isset($_GET['prop'])){
    $prop = $_GET['prop'];
    $msg = '予期せぬエラーで退会できませんでした。少し時間を置いてから再度お試しください。';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="text-align:center;">
  <h1>退会</h1>
    <form action="del_act.php" method="post">
        <p><?=h($name)?>さん、本当に退会しますか？</p>
        <span></span>
        <input type="hidden" name="name" value="<?=h($name)?>">
        <input style="margin-top:10px;width:60px"; id="submit" type="submit" name="submit" value="はい">
    </form>
    <a href="index.php"><button style="margin-top:10px;width:60px;">いいえ</button></a>

</body>
</html>