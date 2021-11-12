<?php

session_start();

include('../funcs.php');

// セッションチェック
sschk();
//1.  DB接続します
$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT fav_book_table.asin, LEFT(title,48) AS l_title, author, img, COUNT(fav_book_table.asin) AS c_asin, ROUND(AVG(fav_book_table.star),1) AS avg_star
FROM fav_book_table 
LEFT JOIN bs_book_table ON fav_book_table.asin = bs_book_table.asin 
GROUP BY fav_book_table.asin, title, author, img
ORDER BY c_asin DESC
LIMIT 5";

$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$count = 1;

if($status==false) {
  sql_error($stmt);
}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){
    $star_width = $r['avg_star']*10;
    $asin = $r['asin'];

    // $view .= '<div style="display:flex;justify-content:strech;margin:8px">';
    // $view .=   '<div style="width:65px;height:100px;flex-shrink: 0;"><img style="width:100%;height:100%" src="'.$r['img'].'"></div>';
    // $view .=   '<div><p style="color:brown;font-size:8px;text-align:left;">Ranking：'.$count.'</p>';
    // $view .=     '<p style="color:brown;font-size:8px;text-align:left;">'.h($r['l_title']).'</p>';
    // $view .=     '<p style="color:brown;font-size:8px;text-align:left;">作者：'.h($r['author']).'</p>';
    // $view .=     '<p style="color:brown;font-size:8px;text-align:left;">お気に入り登録数：'.$r['c_asin'].'</p>';

    // $view .=     '<p style="color:brown;font-size:8px;text-align:left;">評価：';
    // $view .=       '<span class="star">';
    // $view .=       '<span class="star_base">★★★★★（'.$r['avg_star'].'）</span>';
    // $view .=       '<span class="star_up" style="width:'.$star_width.'px;">★★★★★</span>';
    // $view .=       '</span>';
    // $view .=     '</p>';
    // $view .=   '</div>';
    // $view .= '</div>';

    $view .= <<<EOF
    <p style="width:100%;text-align:center;background-color:rgb(131, 70, 0);margin:0;font-size:12px;">第 {$count} 位</p>
    
    <div style="display:flex;justify-content:strech;margin:0 8px 8px 8px;">
      <a href="book.php?asin={$asin}">
        <div style="width:70px;height:100px;flex-shrink: 0;">
            <img style="width:100%;height:100%" src="{$r['img']}">
        </div>
      </a>   
        <div>
            <p style="color:brown;font-size:8px;text-align:left;">{$r['l_title']}</p>
            <p style="color:brown;font-size:8px;text-align:left;">作者：{$r['author']}</p>
            <p style="color:brown;font-size:8px;text-align:left;">お気に入り登録数：{$r['c_asin']}</p>
            <p style="color:brown;font-size:8px;text-align:left;">評価：
                <span style="position:relative;">
                    <span style="position:absolute;width:100px;">★★★★★（{$r['avg_star']}）</span>
                    <span style="width:{$star_width}px;position:absolute;color:orange;overflow:hidden;">★★★★★</span>
                </span>
            </p>
        </div>
    </div>
     
    EOF;

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
