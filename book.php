<?php
session_start();
include('funcs.php');
sschk();

$asin = $_GET['asin'];

//1.  DB接続します
$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM bs_book_table
    WHERE asin = :asin";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':asin', $asin);
$status = $stmt->execute();

//３．データ表示

if($status==false) {
    sql_error($stmt);
}else{
    //Selectデータの数だけ自動でループしてくれる
    $res = $stmt->fetch();

    $img_book = $res['img'];
    $title = $res['title'];
    $author = $res['author'];
    $outline = $res['outline'];
    $c1 = $res['class1']==='undefined' ? '' :$res['class1'];
    $c2 = $res['class2']==='undefined' ? '' :$res['class2'];
    $c3 = $res['class3']==='undefined' ? '' :$res['class3'];
    
}

$sql = "SELECT tf.name, tf.asin, star, impression, review, tf.uddate, rel_flg, tu.img
FROM fav_book_table AS tf
LEFT JOIN bs_usr_table AS tu ON tf.name = tu.name
WHERE tf.asin = :asin AND rel_flg = 1
ORDER BY uddate DESC";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':asin', $asin);
$status = $stmt->execute();

if($status==false) {
    sql_error($stmt);
}else{
    while($res2 = $stmt->fetch(PDO::FETCH_ASSOC)){
        $img_face = $res2['img'] == null ? 'img/noface.jpg': h($res2['img']);
        $name = h($res2['name']);
        $star = h($res2['star']);
        $imp = h($res2['impression']);
        $rev = h($res2['review']);
        $date = h($res2['uddate']);
        $star_width = $star * 12;
        
        $view .= <<<EOF
        <div style="width:auto;margin:16px;background:rgba(240,250,255,0.7);border-radius:5px;box-shadow: 10px 10px 10px 0 rgba(0, 0, 0, .5);overflow:hidden;">
            <div style="width:100%;display:flex;justify-content:start;margin:8px;">
                <div style="width:30px;height:30px;flex-shrink: 0;margin-top:4px;">
                    <img style="width:100%;height:100%;border-radius:50%;" src="{$img_face}">
                </div>
                <div>
                    <p style="width:auto;color:black;font-size:14px;text-align:center;padding-top:5px;font-family: 'New Tegomin', serif;">{$name} _ {$date}
                </div>
            </div>
            <div style="margin-left:8px;">
                <p style="color:brown;font-size:14px;text-align:left;font-family: 'New Tegomin', serif;"> 　{$imp}</p>
                <p style="color:black;font-size:14px;text-align:left;font-family: 'New Tegomin', serif;white-space:pre-wrap;">書評</p>
                <p style="color:black;font-size:14px;text-align:left;font-family: 'New Tegomin', serif;white-space:pre-wrap;">　{$rev}</p>
            </div>  
            <div style="display:flex;justify-content:left;margin:0 8px 8px 8px;">
                <p style="color:black;font-size:12px;text-align:left;font-family: 'New Tegomin', serif;">評価：
                    <span style="position:relative;font-family: 'New Tegomin', serif;">
                        <span style="position:absolute;width:200px;font-family: 'New Tegomin', serif;">★★★★★（{$star}）</span>
                        <span style="width:{$star_width}px;position:absolute;color:orange;overflow:hidden;font-family: 'New Tegomin', serif;">★★★★★</span>
                    </span>
                </p>
            </div> 
        </div>


        EOF;

    }
}

$sql = "SELECT LEFT(title,20) AS title_20, img, asin
FROM bs_book_table
WHERE asin <> :asin
ORDER BY RAND()
LIMIT 10";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':asin', $asin);
$status = $stmt->execute();

if($status==false) {
    sql_error($stmt);
}else{
    while($res3 = $stmt->fetch(PDO::FETCH_ASSOC)){
        $img_b = h($res3['img']);
        $title_20 = h($res3['title_20']);
        $asin_b = h($res3['asin']);

        $view2 .= <<<EOF
        <a href="book.php?asin={$asin_b}">
        <div>
            <img src="{$img_b}">
        </div>
        <p class="bro" style="font-size:12px">{$title_20}</p>
        </a>
        EOF;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/destyle.css" rel="stylesheet">
    <link href="css/bootstrap-grid.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=New+Tegomin&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>  
</head>
<body>

<header> 
    <?php include('parts/header.html'); ?>
</header>    

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10 bdr">
            <br>
            <p class="bro" style="border-bottom:solid 1px brown">Bibliographic information</p>
            <div style="display:flex;justify-content:strech">
                <div style="width:140px;height:200px;margin:16px;flex-shrink:0">
                    <a href="https://www.amazon.co.jp/gp/product/<?=$asin?>">
                        <img src="<?=$img_book?>" alt="">
                    </a>
                </div>
                <div style="position:relative">
                    <div style="position:relative;top:45%;transform:translateY(-50%)">
                        <a href="https://www.amazon.co.jp/gp/product/<?=$asin?>">
                            <p class="bro" style="margin:16px;text-align:left;font-size:20px"><?=h($title)?></p>
                        </a>
                        <p class="bro" style="margin:16px;text-align:left;"><span style="color:black">作者：</span><?=h($author)?></p>
                        <p class="bla" style="margin:16px;text-align:left;white-space:pre-wrap;font-size:12px;"><?=h($outline)?></p>
                        <p class="bro" style="margin:16px;text-align:left;"><span style="color:black">分類：</span><?=h($c1)?>、<?=h($c2)?>、<?=h($c3)?></p>
                    </div>
                </div>
            </div>
            <?=$view?>
        </div>
        
        
        <div class="col-sm-2">
            <p class="bro" style="border-bottom:brown 1px solid">Recommend Books</p>
            <?=$view2?>
        </div>
    </div>
    
  </div>




<footer>
    <div class="row bro">
      <div class="col-sm-12 rela h32">
        <p class="abs righ" style="text-align:right;color:black;margin-right:16px;font-size:12px"><a href="del_account.php">退会はこちら</a></p>
        <p class="abs cent" style="text-align:right;color:white;font-size:12px">©️ kamekame Ltd.</p>
      </div>
    </div>
</footer>

</body>
</html>