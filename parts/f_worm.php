<?php
include('../funcs.php');

$worm = $_GET['worm'];
$name = $_GET['name'];
$f_flg = $_GET['f_flg'];

// セッションチェック
// sschk();
//1.  DB接続します
$pdo = db_conn();

if($f_flg==1){ //すでに友達の場合、お互いのフラグをDELETEする。未申請状態に戻る

    $sql="DELETE FROM friend_table 
        WHERE (name_send=:name AND name_recieve =:worm) 
           OR (name_send=:worm AND name_recieve =:name)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':worm', $worm, PDO::PARAM_STR);
    $status = $stmt->execute();

    if($status==false){
        sql_error($stmt);
    }else{
        $view = "☆友達になる";
    }

}else if($f_flg==0){  // 申請済みの場合、申請を取り消す（レコードをDELETEする）
    $sql="DELETE FROM friend_table
        WHERE (name_send=:name AND name_recieve =:worm)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name',$name, PDO::PARAM_STR);
    $stmt->bindValue(':worm',$worm, PDO::PARAM_STR);
    $status = $stmt->execute();

    if($status==false){
        sql_error($stmt);
    }else{
        $view = "☆友達になる";
    }

}else if($f_flg==2){ // 未申請の場合、申請する（レコードをflg=0でinsertする）
    $sql="INSERT INTO friend_table(name_send,name_recieve,friend_flg)VALUES(:name,:worm,0)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name',$name, PDO::PARAM_STR);
    $stmt->bindValue(':worm',$worm, PDO::PARAM_STR);
    $status = $stmt->execute();

    if($status==false){
        sql_error($stmt);
    }else{
        $view = "🌟申請済";
    }

}else if($f_flg==3){ // 相手から申請されている場合、友達になる（自分のflgを1でinsert、相手のflgを1にupdate）
    $sql="UPDATE friend_table SET friend_flg=1 
        WHERE name_send=:worm AND name_recieve=:name";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':worm', $worm, PDO::PARAM_STR);
    $status = $stmt->execute();

    if($status==false){
        sql_error($stmt);
    }else{
        $sql="INSERT INTO friend_table(name_send,name_recieve,friend_flg)VALUES(:name,:worm,1)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name',$name, PDO::PARAM_STR);
        $stmt->bindValue(':worm',$worm, PDO::PARAM_STR);
        $status = $stmt->execute();

        if($status==false){
            sql_error($stmt);
        }else{
            $view = "🌟友達です";
        }
    }
}

//作成したJSON文字列をリクエストしたファイルに返す
echo $view;
?>