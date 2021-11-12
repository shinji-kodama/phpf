<?php
include('../funcs.php');

$name = $_GET['name'];
$worm = $_GET['worm'];
if(isset($_GET['msg'])){
    $msg = $_GET['msg'];
}

// セッションチェック
// sschk();
//1.  DB接続します
$pdo = db_conn();

//２．msgに文字列が入っていたら、メッセージテーブルに文字列をinsert挿入。初期のread_flgは1
if(isset($_GET['msg'])){
    $sql = "INSERT INTO msg_table(send_name,to_name,msg,read_flg,indate)VALUES(:name,:worm,:msg,1,sysdate())";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':worm', $worm, PDO::PARAM_STR);
    $stmt->bindValue(':msg', $msg, PDO::PARAM_STR);
    $status = $stmt->execute();

//３．エラーチェック

    if($status==false) {
        sql_error($stmt);
    }
}


//4．msg`の有無に関わらず、メッセージテーブルからデータを、ユーザーテーブルから画像をselect
$sql = "SELECT send_name, to_name, msg, read_flg, msg_table.indate, img 
    FROM msg_table 
    LEFT JOIN bs_usr_table ON send_name = name
    WHERE (send_name=:name AND to_name=:worm) OR (send_name=:worm AND to_name=:name)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':worm', $worm, PDO::PARAM_STR);
$status = $stmt->execute();

//5. 表示するメッセージを構成
if($status==false) {
    sql_error($stmt);
}else{
    while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){
        $message=h($r['msg']);
        if($r['send_name']==$name){
            $a_msg  = <<<EOF
            <div style="width:100%;display:flex;justify-content:space-between;">
                <div style="width:auto"></div> 
                <p style="text-align:left;white-space:pre-wrap;color:black;font-size:12px;background-color:rgb(200, 150, 150);padding:4px;border-radius:8px;">{$message}</p>
            </div>
            EOF;


        }else if($r['send_name']==$worm){
            $a_msg  = <<<EOF
            <div style="display:flex;justify-content:start;position:relative;">
                <div style="width:32px;height:32px;flex-shrink: 0;">
                    <img style="width:100%;height:100%;border-radius:8px;" src="{$r['img']}">
                </div>
                <p class="bro" style="text-align:left;white-space:pre-wrap;font-size:14px;background-color:white;padding:8px;border-radius:8px;">{$message}</p>
            </div>
            EOF;
        }
        $msg_area .= $a_msg;
    }
}

// このファイルでメッセージに問い合わせると、read_flgを0にする
$sql = "UPDATE msg_table SET read_flg=0
    WHERE send_name=:worm AND to_name=:name AND read_flg=1";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':worm', $worm, PDO::PARAM_STR);
$status = $stmt->execute();

//作成したJSON文字列をリクエストしたファイルに返す
echo $msg_area;
?>
