<?php
// include('../funcs.php');

$pdo = db_conn();

//２．コミュニティのメンバーを取得
$sql="SELECT com_name, com_usr_name, com_indate, tb.img, tb.no1book, tb.fav_author, tb.address, tb.intro 
FROM com_usr_table AS tc
LEFT JOIN bs_usr_table AS tb ON tc.com_usr_name = tb.name
WHERE com_name=:c_name";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':c_name', $c_name);
$status = $stmt->execute();

//３．データをfriend_flgに格納

if($status==false) {
  sql_error($stmt);
}else{
    while($rm = $stmt->fetch(PDO::FETCH_ASSOC)){
        $m_img = h($rm['img']);
        $m_name = h($rm['com_usr_name']);
        $m_fbook = h($rm['no1book']);
        $m_fauthor = h($rm['fav_author']);
        $m_intro = h($rm['intro']);

        $view_m .= <<<EOF
        <a href="worms.php?worm={$m_name}">
            <div style="width:100%;margin-bottom:16px;background:url('./img/yohishi.jpg') no-repeat 0 0 /cover;border-radius:5px;box-shadow: 10px 10px 10px 0 rgba(0, 0, 0, .5);overflow:hidden;">
            <div style="width:100%;display:flex;justify-content:strech;margin:8px;">
                <div style="width:50px;height:50px;flex-shrink: 0;">
                    <img style="width:100%;height:100%;border-radius:50%;" src="{$m_img}">
                </div>
                <div>
                    <p style="width;auto;color:brown;font-size:14px;text-align:left;">ユーザー名：{$m_name}</p>
                    <p style="width;auto;color:brown;font-size:14px;text-align:left;">好きな書籍：{$m_fbook}　好きな作者：{$m_fauthor}</p>
                    <p style="width;auto;color:brown;font-size:14px;text-align:left;"></p>
                    <p style="width;auto;color:black;font-size:14px;text-align:left;">{$m_intro}</p>
                </div>
            </div>
            </div>
        </a>
        EOF;
    };
}


?>

<p class="bro" style="border-bottom:brown 1px solid">Community Member</p>
<div>
    <?=$view_m?>
</div>