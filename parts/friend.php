<?php

include('../funcs.php');
$name = $_GET['name'];

//1.  DB接続します
$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT bs_usr_table.img, name_recieve
FROM friend_table
LEFT JOIN bs_usr_table ON friend_table.name_recieve = bs_usr_table.name 
WHERE friend_flg = 1 AND name_send = '{$name}'
ORDER BY RAND()
LIMIT 20";

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
    !$r['img'] ? $img = './img/noface.jpg': $img = h($r['img']);
    $name_r = h($r['name_recieve']);

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
    <a href="worms.php?worm={$name_r}">
    <div style="width:100%;display:flex;justify-content:strech;margin:8px;">
        <div style="width:50px;height:50px;flex-shrink: 0;">
            <img style="width:100%;height:100%;border-radius:50%;" src="{$img}">
        </div>
        <div>
            <p style="width;auto;color:brown;font-size:14px;text-align:center;padding-top:15px;">{$name_r}</p>
        </div>
    </div> 
    </a>
    EOF;

    $count++;
  }
}

echo $view;
?>
