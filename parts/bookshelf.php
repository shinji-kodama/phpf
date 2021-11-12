<?php
session_start();

include('../funcs.php');

$name = $_GET['name'];
$s_name = $_SESSION['name'];
// セッションチェック
// sschk();
//1.  DB接続します
$pdo = db_conn();

//２．
$sql = "SELECT bs_book_table.img AS book_img, bs_book_table.asin, bs_book_table.title, bs_book_table.author, fav_book_table.star, fav_book_table.uddate
FROM fav_book_table 
LEFT JOIN bs_book_table ON fav_book_table.asin = bs_book_table.asin
WHERE fav_book_table.name = '{$name}' AND fin_read_flg = 1
ORDER BY fav_book_table.id DESC";

$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$count = 1;

if($status==false) {
  sql_error($stmt);
}else{
  //Selectデータの数だけ自動でループしてくれる
  $view = '<p style="color:black;font-size:12px;text-align:left;font-family: "New Tegomin", serif;">---- 既読 ----</p>';
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){
    $star_width = $r['star']*12;
    !$r['face_img'] ? $img = './img/noface.jpg': $img = h($r['face_img']);
    $asin = $r['asin'];
    if($s_name==$name){
        $link = 'book_reg.php?title='.h($r['title']);
    }else{
        $link = 'book.php?asin='.h($asin);
    }
    
    $view .= <<<EOF
    <a href="{$link}">
    <div style="width:100%;margin-bottom:16px;background:url('./img/yohishi.jpg') no-repeat 0 0 /cover;border-radius:5px;box-shadow: 10px 10px 10px 0 rgba(0, 0, 0, .5);overflow:hidden;">
        <div style="display:flex;justify-content:left;margin: 8px;">
            <div style="width:50px;height:70px;flex-shrink: 0;">
                <img style="width:100%;height:100%;border-radius:4px;" src="{$r['book_img']}">
            </div>
            <div style="width:100%;">
                <div style="width:100%;">
                    <p style="color:black;font-size:14px;text-align:left;font-family:'New Tegomin', serif;">{$r['title']}</p>
                </div>
                <p style="color:black;font-size:12px;text-align:left;font-family: 'New Tegomin', serif;">作者：{$r['author']}</p>
                <p style="color:black;font-size:12px;text-align:left;font-family: 'New Tegomin', serif;">あなたの評価：
                    <span style="position:relative;font-family: 'New Tegomin', serif;">
                        <span style="position:absolute;width:200px;font-family: 'New Tegomin', serif;">★★★★★（{$r['star']}）</span>
                    <span style="width:{$star_width}px;position:absolute;color:orange;overflow:hidden;font-family: 'New Tegomin', serif;">★★★★★</span>
                    </span>
                </p>
            </div>
        </div> 
    </div>
    </a>
    EOF;

    $count++;
  }
}

$sql = "SELECT bs_book_table.img AS book_img, bs_book_table.asin, bs_book_table.title, bs_book_table.author, fav_book_table.star, fav_book_table.uddate
FROM fav_book_table 
LEFT JOIN bs_book_table ON fav_book_table.asin = bs_book_table.asin
WHERE fav_book_table.name = '{$name}' AND fin_read_flg = 0
ORDER BY fav_book_table.id DESC";

$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$count = 1;

if($status==false) {
  sql_error($stmt);
}else{
  //Selectデータの数だけ自動でループしてくれる
  $view .= '<p style="color:black;font-size:12px;text-align:left;font-family: "New Tegomin", serif;">---- 未読 ----</p>';
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){
    $star_width = $r['star']*12;
    !$r['face_img'] ? $img = './img/noface.jpg': $img = h($r['face_img']);
    $asin = $r['asin'];

    $view .= <<<EOF
    <a href="book.php?asin={$asin}">
    <div style="width:100%;margin-bottom:16px;background:url('./img/yohishi2.jpg') no-repeat 0 0 /cover;border-radius:5px;box-shadow: 10px 10px 10px 0 rgba(0, 0, 0, .5);overflow:hidden;">
        <div style="display:flex;justify-content:left;margin: 8px;">
            <div style="width:50px;height:70px;flex-shrink: 0;">
                <img style="width:100%;height:100%;border-radius:4px;" src="{$r['book_img']}">
            </div>
            <div style="width:100%;">
                <div style="width:100%;">
                    <p style="color:black;font-size:14px;text-align:left;font-family:'New Tegomin', serif;">{$r['title']}</p>
                </div>
                <p style="color:black;font-size:12px;text-align:left;font-family: 'New Tegomin', serif;">作者：{$r['author']}</p>
                <p style="color:black;font-size:12px;text-align:left;font-family: 'New Tegomin', serif;">あなたの評価：
                    <span style="position:relative;font-family: 'New Tegomin', serif;">
                        <span style="position:absolute;width:200px;font-family: 'New Tegomin', serif;">★★★★★（{$r['star']}）</span>
                    <span style="width:{$star_width}px;position:absolute;color:orange;overflow:hidden;font-family: 'New Tegomin', serif;">★★★★★</span>
                    </span>
                </p>
            </div>
        </div> 
    </div>
    </a>
    EOF;

    $count++;
  }
}
echo $view;
?>
