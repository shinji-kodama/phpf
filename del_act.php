<?php

session_start();
include('funcs.php');

// セッションチェック
sschk();

//1. POSTデータ取得
$name = $_POST['name'];
//2. DB接続します
$pdo = db_conn();   //function内のnew PDO部分を受け取る

//３．データ登録SQL作成
$sql = "UPDATE bm_usr_table SET life_flg=2 WHERE name=:name";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect('del_fin.html');
}
?>
