<?php
include('../funcs.php');

$c_name = $_GET['c_name'];
$name = $_GET['name'];
$j_flg = $_GET['join_flg'];

// セッションチェック
// sschk();
//1.  DB接続します
$pdo = db_conn();

if($j_flg==1){ //すでに参加済み。com_usr_tableからdelete

    $sql="DELETE FROM com_usr_table
        WHERE com_name=:c_name AND com_usr_name =:name";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':c_name', $c_name, PDO::PARAM_STR);
    $status = $stmt->execute();

    if($status==false){
        sql_error($stmt);
    }else{
        $view = "☆JOIN";
    }

}else if($f_flg==0){  // 未参加の場合、com_usr_tableにレコードをINSERTする
    $sql="INSERT INTO com_usr_table(com_name,com_usr_name,com_kanri_flg,com_life_flg,com_indate)VALUES(:c_name,:name,0,0,sysdate())";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name',$name, PDO::PARAM_STR);
    $stmt->bindValue(':c_name',$c_name, PDO::PARAM_STR);
    $status = $stmt->execute();

    if($status==false){
        sql_error($stmt);
    }else{
        $view = "🌟JOINED";
    }
}

//作成したJSON文字列をリクエストしたファイルに返す
echo $view;
?>