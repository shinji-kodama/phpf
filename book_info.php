<?php
include('./funcs.php');

$title = $_GET['title'];
$name = $_GET['name'];

// セッションチェック
// sschk();
//1.  DB接続します
$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM bs_book_table WHERE title = '{$title}'";

$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
if($status==false) {
  sql_error($stmt);
}else{
    $r = $stmt->fetch();
    $img = $r['img'];
    $asin = $r['asin'];
    $author = $r['author'];
    $c1 = $r['class1'];
    $c2 = $r['class2'];
    $c3 = $r['class3'];
}

$sql = "SELECT * FROM fav_book_table WHERE asin = '{$asin}' AND name = '{$name}'";

$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
if($status==false) {
  sql_error($stmt);
}else{
    $res = $stmt->fetch();
    if(isset($res['asin'])){
        $flg = 1;
    }else if(isset($r['asin'])){
        $flg = 0;
    }else{
        $flg = 2;
    }
    $star = $res['star'];
    $imp = $res['impression'];
    $rev = $res['review'];
    $fav = $res['fav_book_flg'];
    $rel = $res['rel_flg'];
    $fin = $res['fin_read_flg'];
}


// '<p>評価：<div class='star'><p class='star_base'>★★★★★（".h($res['star'])."）</p><p class='star_up' style='width:".$star_width."px'>★★★★★</p></div></p>';

$json = '{
      "img":"'.$img.'",
      "title":"'.$title.'",
      "author":"'.$author.'",
      "asin":"'.$asin.'",
      "star":"'.$star.'",
      "imp":"'.$imp.'",
      "fav":"'.$fav.'",
      "rel":"'.$rel.'",
      "fin":"'.$fin.'",
      "rev":"'.$rev.'",
      "c1":"'.$c1.'",
      "c2":"'.$c2.'",
      "c3":"'.$c3.'",
      "flg":"'.$flg.'"
    }';

//作成したJSON文字列をリクエストしたファイルに返す
echo $json;
?>