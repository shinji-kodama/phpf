<?php
session_start();

// include('../funcs.php');

$c_name = $_GET['comm'];
$t_title = $_GET['thread'];
$name_res = $_SESSION['name'];

$pdo = db_conn();

//GETで取得したthreadのレスを取得

$sql = "SELECT com_name, thread_title, res, name_write, tr.indate, tb.img 
    FROM res_table AS tr
    INNER JOIN bs_usr_table AS tb ON tr.name_write = tb.name
    WHERE com_name=:c_name AND thread_title=:t_title";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':c_name', $c_name, PDO::PARAM_STR);
$stmt->bindValue(':t_title', $t_title, PDO::PARAM_STR);
$status = $stmt->execute();

if($status==false){
    sql_error($stmt);
}else{
    $view_res = '<p style="text-align:left;color:brown;">'.$t_title.'</p>';
    while($rth = $stmt->fetch(PDO::FETCH_ASSOC)){
        $resp = h($rth['res']);
        $name_w = h($rth['name_write']);
        $resp_date = h($rth['indate']);
        $res_img = h($rth['img']);

        $view_res .= <<<EOF
            <div style="width:100%;margin-bottom:16px;background:url('./img/yohishi.jpg') no-repeat 0 0 /cover;border-radius:5px;box-shadow: 10px 10px 10px 0 rgba(0, 0, 0, .5);overflow:hidden;">
                <p style="color:black;font-size:14px;text-align:left;font-family:'New Tegomin', serif;">{$resp}</p>
                <div style="display:flex;justify-content:end;margin-right:8px">
                    <div style="width:100%"></div>
                    <div style="width:32px;height:32px;flex-shrink: 0;">
                        <img style="width:100%;height:100%;border-radius:8px;" src="{$res_img}">
                    </div>
                    <p style="color:black;font-size:12px;text-align:right;font-family: 'New Tegomin', serif;">{$name_w}, {$resp_date}</p>
                </div>
            </div> 

        EOF;
    }
}

?>
<style>
    textarea.msg{
    width:90%;
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
<form action="parts/c_thread_insert.php" method="post">
<div style="display:flex;margin:8px">
    <textarea id="msg_box" class="msg" type="text" name="msg"></textarea>
    <input type="hidden" name="name" value="<?=h($name_res)?>">
    <input type="hidden" name="comm" value="<?=h($c_name)?>">
    <input type="hidden" name="title" value="<?=h($t_title)?>">
    <button id="send">送信</button>
</div>
</form>
    <p class="bro"></p>
    <div id="" class=""></div>
    <?=$view_res?>

</div>
<script>

</script>