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
$title      = $_POST['title'];
$star       = $_POST['star'];
$asin       = $_POST['asin'];
$imp        = $_POST['imp'];
$rev        = $_POST['rev'];
$fin        = $_POST['fin']=='on' ? 1 : 0;
$fav        = $_POST['fav']=='on' ? 1 : 0;
$rel        = $_POST['rel']=='on' ? 1 : 0;      // 公開=release
$name       = $_SESSION['name'];
//2. DB接続します
$pdo = db_conn();   //function内のnew PDO部分を受け取る

//３．データ登録SQL作成
$sql = "INSERT INTO fav_book_table(name, asin, star, impression, review, fav_book_flg, rel_flg, fin_read_flg, indate, uddate)VALUES(:name, :asin, :star, :imp, :rev, :fav, :rel, :fin, sysdate(), sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':asin', $asin, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
if(empty($star) || intval($star)===0){$star = (float)0;}
$stmt->bindValue(':star', $star, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':imp', $imp, PDO::PARAM_STR);
$stmt->bindValue(':rev', $rev, PDO::PARAM_STR);
$stmt->bindValue(':fav', $fav, PDO::PARAM_INT);
$stmt->bindValue(':rel', $rel, PDO::PARAM_INT);
$stmt->bindValue(':fin', $fin, PDO::PARAM_INT);
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect('book_reg.php');
}
?>