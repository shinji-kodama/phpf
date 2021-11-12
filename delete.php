<?php
session_start();

include('funcs.php');
sschk();

//1. POSTデータ取得
$id = $_GET["id"];

//2. DB接続します
$pdo = db_conn();   //function内のnew PDO部分を受け取る

//３．データ登録SQL作成
$sql = "DELETE FROM bm_table WHERE bm_id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect('select.php');
}
?>
