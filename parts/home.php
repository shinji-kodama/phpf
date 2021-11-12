<?php
include('../funcs.php');

$name = $_GET['name'];

// セッションチェック
// sschk();
//1.  DB接続します
$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT fav_book_table.name, bs_usr_table.img AS face_img, bs_book_table.img AS book_img, bs_book_table.title, bs_book_table.author, fav_book_table.impression, fav_book_table.star, fav_book_table.review, fav_book_table.indate, fav_book_table.uddate, bs_book_table.asin
FROM fav_book_table 
LEFT JOIN bs_book_table ON fav_book_table.asin = bs_book_table.asin 
LEFT JOIN bs_usr_table ON fav_book_table.name = bs_usr_table.name
INNER JOIN friend_table ON fav_book_table.name = friend_table.name_recieve
WHERE friend_table.name_send = '{$name}' AND friend_flg = 1
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
    $star_width = $r['star']*12;
    !$r['face_img'] ? $img = './img/noface.jpg': $img = h($r['face_img']);
    $asin = h($r['asin']);
    $worm = h($r['name']);

    $view .= <<<EOF
    <div style="width:100%;margin-bottom:16px;background:url('./img/yohishi.jpg') no-repeat 0 0 /cover;border-radius:5px;box-shadow: 10px 10px 10px 0 rgba(0, 0, 0, .5);overflow:hidden;">

        <div style="width:100%;display:flex;justify-content:start;margin:8px;">
            <div style="width:30px;height:30px;flex-shrink: 0;margin-top:4px;">
                <a href="worms.php?worm={$worm}">
                    <img style="width:100%;height:100%;border-radius:50%;" src="{$img}">
                </a>
            </div>
            <div>
                <a href="worms.php?worm={$worm}">
                <p style="width:auto;color:black;font-size:14px;text-align:center;padding-top:5px;font-family: 'New Tegomin', serif;">{$r['name']} _ {$r['indate']}</p>
                </a>
            </div>
        </div>

        <div style="margin-left:8px;">
            <p style="color:brown;font-size:14px;text-align:left;font-family: 'New Tegomin', serif;"> {$r['impression']}</p>
                <p style="color:black;font-size:14px;text-align:left;font-family: 'New Tegomin', serif;white-space:pre-wrap;flex-shrink:0;width:36px;">書評</p>
                <p style="color:black;font-size:14px;text-align:left;font-family: 'New Tegomin', serif;white-space:pre-wrap;width:auto;border:solid black 1px;border-radius:4px;padding:4px;background-color:rgba(255,255,255,0.5);margin-right:12px;">{$r['review']}</p>
        </div>

        <div style="display:flex;justify-content:left;margin:0 8px 8px 8px;">
            <div style="width:70px;height:100px;flex-shrink: 0;">
                <a href="book.php?asin={$asin}">
                    <img style="width:100%;height:100%;border-radius:8px;" src="{$r['book_img']}">
                </a>
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
    </div>
    EOF;

    $count++;
  }
}
// '<p>評価：<div class='star'><p class='star_base'>★★★★★（".h($res['star'])."）</p><p class='star_up' style='width:".$star_width."px'>★★★★★</p></div></p>';

$json = '[
    {
      "id":"'.$id.'",
      "mode":"'.$mode.'",
      "type":"'.$type.'"
    },
    {
     "id":"'.$id.'",
     "mode":"'.$mode.'",
     "type":"'.$type.'"
    }
]';

//作成したJSON文字列をリクエストしたファイルに返す
echo $view;
?>
