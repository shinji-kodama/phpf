<?php
session_start();
include('funcs.php');
sschk();

//1. POSTデータ取得
$asin = $_POST['asin'];
$isbn = $_POST['isbn'];
$title = $_POST['title'];
$author = $_POST['author'];
$name = $_SESSION['name'];
$url = $_POST['url'];
$img = $_POST['img'];
$star = $_POST['star'];
$c1 = $_POST['c1'];
$c2 = $_POST['c2'];
$c3 = $_POST['c3'];
$outline = $_POST['outline'];

//2. DB接続します
$pdo = db_conn();

//３．データ登録SQL作成   :name バインド変数。php injection?対策
$stmt = $pdo->prepare("INSERT INTO bs_book_table(asin,isbn,title,author,name,url,img,star,class1,class2,class3,outline,indate)VALUES(:asin, :isbn, :title, :author, :name, :url, :img, :star, :c1, :c2, :c3, :outline, sysdate())");
$stmt->bindValue(':asin', $asin, PDO::PARAM_STR);
$stmt->bindValue(':isbn', $isbn, PDO::PARAM_STR);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':author', $author, PDO::PARAM_STR);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':url', $url, PDO::PARAM_STR);
$stmt->bindValue(':img', $img, PDO::PARAM_STR);
$stmt->bindValue(':star', $star, PDO::PARAM_STR);
$stmt->bindValue(':c1', $c1, PDO::PARAM_STR);
$stmt->bindValue(':c2', $c2, PDO::PARAM_STR);
$stmt->bindValue(':c3', $c3, PDO::PARAM_STR);
$stmt->bindValue(':outline', $outline, PDO::PARAM_STR);
$status = $stmt->execute(); //stmtを実行してエラーがあったら返す

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect('index.php');  //{ここは変更する！！}
}
?>
