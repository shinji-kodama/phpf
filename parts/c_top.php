<?php
session_start();
// include('../funcs.php');
$c_name = $_GET['comm'];
$name_thr = $_SESSION['name'];
//1.  DB接続
$pdo = db_conn();

//２.スレッド情報を取得
$sql="SELECT tt.com_name, tt.thread_title, tt.thread_main, tt.contributor, MAX(tr.indate) AS M_date
    FROM thread_table AS tt
    LEFT JOIN res_table AS tr ON tt.com_name = tr.com_name AND tt.thread_title = tr.thread_title
    WHERE tt.com_name=:c_name
    GROUP BY tt.com_name, tt.thread_title, tt.thread_main, tt.contributor
    ORDER BY M_date DESC";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':c_name', $c_name);
$status = $stmt->execute();

//３. 表示用の変数を整理

if($status==false) {
  sql_error($stmt);
}else{
    while($rt = $stmt->fetch(PDO::FETCH_ASSOC)){
        $t_title  = h($rt['thread_title']);
        $t_main   = h($rt['thread_main']);
        $t_name   = h($rt['contributor']);
        $last_res_time = h($rt['M_date']);

        $link = 'communities.php?comm='.h($c_name).'&thread='.h($t_title);

        $view_ctop .= <<<EOF
        <a href="{$link}">
            <div style="width:100%;margin-bottom:16px;background:url('./img/yohishi.jpg') no-repeat 0 0 /cover;border-radius:5px;box-shadow: 10px 10px 10px 0 rgba(0, 0, 0, .5);overflow:hidden;">
                <p style="color:brown;font-size:16px;text-align:left;font-family:'New Tegomin', serif;">{$t_title}</p>
                <div style="">
                    <p style="color:black;font-size:12px;text-align:left;font-family: 'New Tegomin', serif;">{$t_main}</p>
                    <p style="color:black;font-size:12px;text-align:right;font-family: 'New Tegomin', serif;">Latest：{$last_res_time}</p>
                </div>
            </div> 
        </a>
        EOF;
    }
}

?>

<style>
    input{
    width:95%;
    height:24px;
    background-color:white;
    border-radius:8px;
    color:brown;
    text-align: left;
    font-family: 'New Tegomin', serif;
    height:1.5rem;
    padding-left:8px;
    padding-top:4px;
    font-size:14px;
    margin: 2px;
}
    textarea.msg{
    width:95%;
    height:24px;
    margin:0 auto;
    background-color:white;
    border-radius:8px;
    color:brown;
    text-align: left;
    font-family: 'New Tegomin', serif;
    height:1.5rem;
    padding-left:8px;
    padding-top:4px;
    font-size:14px;
    margin: 2px;
}
button#send{
    background-color:rgba(156, 105, 105,1);
    width:40px;
    border-radius:8px;
    font-size:14px;
    text-align: center;
    font-family: 'New Tegomin', serif;
}
</style>
<p class="bro" style="border-bottom:brown 1px solid">Thread</p>
<div>
<form action="parts/c_thre_insert.php" method="post">
<div style="display:flex;margin:8px">
    <div style="width:100%">
        <input type="text" name="title" placeholder="スレッドタイトル">
        <textarea id="msg_box" class="msg" type="text" name="main" placeholder="スレッドの説明"></textarea>
    </div>
    <input type="hidden" name="name" value="<?=h($name_thr)?>">
    <input type="hidden" name="comm" value="<?=h($c_name)?>">
    <button id="send">送信</button>
</div>
</form>

<div>
    <p class="bro"></p>
    <div id="" class=""></div>
    <?=$view_ctop?>

</div>
