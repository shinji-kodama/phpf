<?php

include('../funcs.php');
$name = $_GET['name'];

//1.  DB接続します
$pdo = db_conn();

$sql = "SELECT t2.img, name_send
FROM friend_table
LEFT JOIN bs_usr_table AS t1 ON t1.name = name_recieve
LEFT JOIN bs_usr_table AS t2 ON t2.name = name_send
WHERE t1.name = '{$name}' AND friend_flg = 0";

$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

if($status==false) {
    sql_error($stmt);
}else{
    //Selectデータの数だけ自動でループしてくれる
    $view = '<p style="width;auto;color:brown;font-size:16px;text-align:center;border-bottom:solid 1px brown;background-color:rgba(255,255,255,0.5);">Friend Requested</p>';
    while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){
        !$r['img'] ? $img = './img/noface.jpg': $img = h($r['img']);
        $name_s = h($r['name_send']);
      
      $view .= <<<EOF
      <a href="worms.php?worm={$name_s}">
        <div style="width:100%;display:flex;justify-content:strech;margin:8px;">
            <div style="width:50px;height:50px;flex-shrink: 0;">
                <img style="width:100%;height:100%;border-radius:50%;" src="{$img}">
            </div>
            <div>
                <p style="width;auto;color:brown;font-size:14px;text-align:center;padding-top:15px;">{$name_s}</p>
            </div>
        </div>
      <a>
      EOF;
    }
}


//２ 重複しているお気に入り数をカウントしてレコメンド
$sql = "SELECT bs_usr_table.img, t2.name, COUNT(t2.name) AS c_fav
FROM fav_book_table AS t1
RIGHT JOIN fav_book_table AS t2 ON t1.asin = t2.asin
JOIN bs_usr_table ON t2.name = bs_usr_table.name
LEFT JOIN friend_table ON t2.name = friend_table.name_recieve
WHERE t1.name = '{$name}' AND t2.name <> '{$name}' AND (friend_table.friend_flg <> 1 OR ISNULL(friend_table.friend_flg))
GROUP BY t2.name, bs_usr_table.img
ORDER BY c_fav DESC";

$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$count = 1;

if($status==false) {
  sql_error($stmt);
}else{
  //Selectデータの数だけ自動でループしてくれる
  $view .= '<p style="width;auto;color:brown;font-size:16px;text-align:center;border-bottom:solid 1px brown;border-top:solid 1px brown;background-color:rgba(255,255,255,0.5);">Recommend Worms</p>';
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){
    !$r['img'] ? $img = './img/noface.jpg': $img = h($r['img']);
    $namae = h($r['name']);
    $c_fav = h($r['c_fav']);

    
    $view .= <<<EOF
    <a href="worms.php?worm={$namae}">
    <div style="width:100%;display:flex;justify-content:strech;margin:8px;">
        <div style="width:50px;height:50px;flex-shrink: 0;">
            <img style="width:100%;height:100%;border-radius:50%;" src="{$img}">
        </div>
        <div>
            <p style="width;auto;color:brown;font-size:14px;text-align:center;padding-top:15px;">{$namae}</p>
        </div>
        <p>{$c_fav}</p>
    </div>
    </a>
    EOF;

    $count++;
  }
}

// 友達を表示 (friend_flg=1)
$sql = "SELECT img, name_recieve, ROUND(COUNT(read_flg)*AVG(read_flg)) AS c_flg
FROM friend_table
LEFT JOIN bs_usr_table ON friend_table.name_recieve = bs_usr_table.name
LEFT JOIN msg_table ON friend_table.name_recieve = msg_table.send_name
WHERE friend_flg = 1 AND name_send = '{$name}'
GROUP BY img, name_recieve
ORDER BY name_recieve ASC";

$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

if($status==false) {
    sql_error($stmt);
}else{
    //Selectデータの数だけ自動でループしてくれる
    $view .= '<p style="width;auto;color:brown;font-size:16px;text-align:center;border-bottom:solid 1px brown;border-top:solid 1px brown;background-color:rgba(255,255,255,0.5);">Friend</p>';
    while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){
        !$r['img'] ? $img = './img/noface.jpg': $img = h($r['img']);
        $name_s = h($r['name_recieve']);
        if($r['c_flg']>=1){
            $unread = $r['c_flg'];
        }
        $view .= <<<EOF
            <a href="worms.php?worm={$name_s}">
                <div style="width:100%;display:flex;justify-content:strech;margin:8px;">
                    <div style="width:50px;height:50px;flex-shrink: 0;">
                        <img style="width:100%;height:100%;border-radius:50%;" src="{$img}">
                    </div>
                    <div style="position:relative;"> 
                        <p style="width:20px;background-color:red;border-radius:40%;position:absolute">{$unread}</p>
                        <p style="width;auto;color:brown;font-size:14px;text-align:center;padding-top:15px;">{$name_s}</p>
                    </div>
                </div>
            </a>
        EOF;
    }
}

echo $view;
?>