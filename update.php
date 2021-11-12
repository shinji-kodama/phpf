<?php

session_start();

//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
//   POSTデータ受信 → DB接続 → SQL実行 → 前ページへ戻る
//2. $id = POST["id"]を追加
//3. SQL修正
//   "UPDATE テーブル名 SET 変更したいカラムを並べる WHERE 条件"
//   bindValueにも「id」の項目を追加
//4. header関数"Location"を「select.php」に変更
include('funcs.php');

// セッションチェック
sschk();

//1. POSTデータ取得
$url        = $_POST['url'];
$name       = $_POST['name'];
$am_asin    = $_POST['asin'];
$gp_id      = $_POST['id'];
$title      = $_POST['title'];
$author     = $_POST['author'];
$price      = $_POST['price'];
$list_price = $_POST['list_price'];
$k_ul       = $_POST['kindle_ul'];
$star       = $_POST['star'];
$img        = $_POST['img'];
$free       = $_POST['free'];
$id         = $_POST["bm_id"];      // updateはid必要(detail.phpからpostされる)

//2. DB接続します
$pdo = db_conn();   //function内のnew PDO部分を受け取る

//３．データ登録SQL作成
$sql = "UPDATE bm_table SET name=:name, title=:title, author=:author, price=:price, list_price=:list_price, star=:star, url=:url, img=:img, asin=:am_asin, gp_id=:gp_id, other=:other, free=:free WHERE bm_id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':title', $title, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':author', $author, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':price', $price, PDO::PARAM_INT);
$stmt->bindValue(':list_price', $list_price, PDO::PARAM_INT);
$stmt->bindValue(':star', $star, PDO::PARAM_STR);
$stmt->bindValue(':url', $url, PDO::PARAM_STR);
$stmt->bindValue(':img', $img, PDO::PARAM_STR);
$stmt->bindValue(':am_asin', $am_asin, PDO::PARAM_STR);
$stmt->bindValue(':gp_id', $gp_id, PDO::PARAM_STR);
$stmt->bindValue(':other', $k_ul, PDO::PARAM_STR);
$stmt->bindValue(':free', $free, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect('select.php');
}
?>
