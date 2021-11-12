<?php
session_start();
include('../funcs.php');

$name = $_GET['worm'];
$s_name = $_SESSION['name'];

if($name==$s_name){
    $relflg = 'AND (fav_book_table.rel_flg = 1 OR fav_book_table.rel_flg = 0)';
}else{
    $relflg = 'AND fav_book_table.rel_flg = 1';
}

// セッションチェック
// sschk();
//1.  DB接続します
$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT fav_book_table.name, bs_usr_table.img AS face_img, bs_book_table.img AS book_img, bs_book_table.title, bs_book_table.author, fav_book_table.impression, fav_book_table.star, fav_book_table.review, fav_book_table.indate, fav_book_table.uddate
FROM fav_book_table 
LEFT JOIN bs_book_table ON fav_book_table.asin = bs_book_table.asin 
LEFT JOIN bs_usr_table ON fav_book_table.name = bs_usr_table.name
WHERE fav_book_table.name = '{$name}' {$relflg}
ORDER BY fav_book_table.id DESC";

$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$count = 1;

if($status==false) {
  sql_error($stmt);
}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){
    if(isset($r['review'])){
        $star_width = $r['star']*12;
        !$r['face_img'] ? $img = './img/noface.jpg': $img = h($r['face_img']);

        $view .= <<<EOF
        <a href="book_reg.php?title={$r['title']}">
        <div style="width:100%;margin-bottom:16px;background:url('./img/yohishi.jpg') no-repeat 0 0 /cover;border-radius:5px;box-shadow: 10px 10px 10px 0 rgba(0, 0, 0, .5);overflow:hidden;">

            <div style="display:flex;justify-content:left;margin:4px 8px 8px 8px;">
                <div style="width:50px;height:70px;flex-shrink: 0;">
                    <img style="width:100%;height:100%;border-radius:8px;" src="{$r['book_img']}">
                </div>
                <div style="width:100%;">
                    <div style="width:100%;">
                        <p style="color:black;font-size:14px;text-align:left;font-family:'New Tegomin', serif;">{$r['title']}</p>
                    </div>
                    <p style="color:black;font-size:12px;text-align:left;font-family: 'New Tegomin', serif;">作者：{$r['author']}</p>
                    <p style="color:black;font-size:12px;text-align:left;font-family: 'New Tegomin', serif;">評価：
                        <span style="position:relative;font-family: 'New Tegomin', serif;">
                            <span style="position:absolute;width:200px;font-family: 'New Tegomin', serif;">★★★★★（{$r['star']}）</span>
                            <span style="width:{$star_width}px;position:absolute;color:orange;overflow:hidden;font-family: 'New Tegomin', serif;">★★★★★</span>
                        </span>
                    </p>
                </div>
            </div> 
            <div style="margin-left:8px;">
                <p style="color:brown;font-size:14px;text-align:left;font-family: 'New Tegomin', serif;"> {$r['impression']}</p>
                <div style="display:flex;justify:content:start;">
                    <p style="color:black;font-size:14px;text-align:left;font-family: 'New Tegomin', serif;flex-shrink:0;">書評：</p>
                    <p style="color:black;font-size:14px;text-align:left;font-family: 'New Tegomin', serif;white-space:pre-wrap;">{$r['review']}</p>
                </div>
            </div>
        </div>
        </a>
        EOF;
    }
    

    $count++;
  }
}
// '<p>評価：<div class='star'><p class='star_base'>★★★★★（".h($res['star'])."）</p><p class='star_up' style='width:".$star_width."px'>★★★★★</p></div></p>';

// $json = '[
//     {
//       "id":"'.$id.'",
//       "mode":"'.$mode.'",
//       "type":"'.$type.'"
//     },
//     {
//      "id":"'.$id.'",
//      "mode":"'.$mode.'",
//      "type":"'.$type.'"
//     }
// ]';

//作成したJSON文字列をリクエストしたファイルに返す
echo $view;
?>
