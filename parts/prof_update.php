<?php

session_start();

include('../funcs.php');

sschk();

$address    = $_POST['address'];
$name       = $_POST['name'];
$age        = $_POST['age'];
$f_book     = $_POST['f_book'];
$f_auth     = $_POST['f_auth'];
$intro      = $_POST['intro'];

//2. DB接続します
$pdo = db_conn();   //function内のnew PDO部分を受け取る

$img = fileUpload('upfile1','../img/');
$img_bg = fileUpload('upfile2','../img/');

//３．データ登録SQL作成
$sql = "UPDATE bs_usr_table 
    SET name=:name, address=:address, age=:age, no1book=:f_book, fav_author=:f_auth, intro=:intro, uddate=sysdate(), img=:img, img_bg=:img_bg
    WHERE name=:name";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':address', $address, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':age', $age, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':f_book', $f_book, PDO::PARAM_STR);
$stmt->bindValue(':f_auth', $f_auth, PDO::PARAM_STR);
$stmt->bindValue(':intro', $intro, PDO::PARAM_STR);
$stmt->bindValue(':img', 'img/'.$img, PDO::PARAM_STR);
$stmt->bindValue(':img_bg', 'img/'.$img_bg, PDO::PARAM_STR);
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect('../worms.php?worm='.$name.'&page=msg');
}
?>
