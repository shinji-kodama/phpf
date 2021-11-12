<?php
session_start();

// include('../funcs.php');

// セッションチェック
// sschk();
$name_search = $_SESSION['name'];

//1.  DB接続します
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM bs_book_table");
$status = $stmt->execute();

//３．データを配列に格納
$arr = array();
$count = 0;
if($status==false) {
  sql_error($stmt);
}else{
  //Selectデータの数だけ自動でループしてくれる
  $datalist = "<datalist id='datalistid'>";
  while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){
    $arr .= $res['title'];
    $datalist .= "<option value='".h($res['title'])."'></option>";
  }
  $datalist .= "</datalist>";

}

$sql="SELECT tc.com_name, tc.book_title, tc.name_reg, tc.comment, tc.indate, tb.img, tb.author
FROM com_recom_book AS tc
LEFT JOIN bs_book_table AS tb ON tc.book_title = tb.title
WHERE tc.com_name=:c_name";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':c_name', $c_name);
$status = $stmt->execute();

if($status==false){
    sql_error($stmt);
}else{
    while($rrb = $stmt->fetch(PDO::FETCH_ASSOC)){
        $rb_img = h($rrb['img']);
        $rb_title = h($rrb['book_title']);
        $rb_name = h($rrb['name_reg']);
        $rb_comment = h($rrb['comment']);
        $rb_author = h($rrb['author']);

        $view_rb .= <<<EOF
        <a href="{$link}">
            <div style="width:100%;margin-bottom:16px;background:url('./img/yohishi.jpg') no-repeat 0 0 /cover;border-radius:5px;box-shadow: 10px 10px 10px 0 rgba(0, 0, 0, .5);overflow:hidden;">
                <div style="display:flex;justify-content:left;margin: 8px;">
                    <div style="width:50px;height:70px;flex-shrink: 0;">
                        <img style="width:100%;height:100%;border-radius:4px;" src="{$rb_img}">
                    </div>
                    <div style="width:100%;">
                        <div style="width:100%;">
                            <p style="color:black;font-size:14px;text-align:left;font-family:'New Tegomin', serif;">{$rb_title}</p>
                        </div>
                        <p style="color:black;font-size:12px;text-align:left;font-family: 'New Tegomin', serif;">作者：{$rb_author}</p>
                        <p style="color:black;font-size:12px;text-align:left;font-family: 'New Tegomin', serif;">コメント：{$rb_comment}</p>
                    </div>
                </div> 
            </div>
        </a>
        EOF;
    }
}


?>

<style>
    input{
    width:98%;
    height:24px;
    margin:2px auto;
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
<p class="bro" style="border-bottom:brown 1px solid">RECOMMEND BOOKS</p>
<div>
<form action="parts/c_book_insert.php" method="post">
<div style="display:flex;margin:8px">
    <div style="width:90%">
        <input id="book" class="msg" type="text" name="book" placeholder="book title" autocomplete="on" list="datalistid">
        <?php echo $datalist; ?>
        <input id="" class="msg" type="text" name="comment" placeholder="recommend comment">
        <input type="hidden" name="name" value="<?=h($name)?>">
    </div>
    <input type="hidden" name="comm" value="<?=h($c_name)?>">
    <button id="send">送信</button>
</div>
</form>
    <p class="bro"></p>
    <div id="" class=""></div>
    <?=$view_rb?>

</div>
<script>

</script>