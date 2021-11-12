<?php
session_start();

include('../funcs.php');

$name = $_SESSION['name'];
if(isset($_GET['name'])){
  $name_search = $_GET['name'];
}else{
  $name_search = $name;
}

// セッションチェック
sschk();
//1.  DB接続します
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM bs_book_table LEFT JOIN bs_usr_table ON bs_book_table.name = bs_usr_table.name");
$status = $stmt->execute();

//３．データ表示

define('MAX','4'); //MAXという定数を宣言,値は4 ページネーション用

$view=array();
$count_res=0;

if($status==false) {
  sql_error($stmt);
}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){
    if($res['name']==$name_search || $name_search=="all"){
      if(strpos($res['url'],'https://www.amazon.co.jp/')===0 || strpos($res['url'],'https://play.google.com/store/')===0 ){
        $url = $res['url'];
      }else{
        $url = './urlcheck.php?url='.h($res['url']);
      }
      $star_width = $res['star']*16;
      $img = "<div class='imgbox'><img src='".h($res['img'])."'></div>";
      $txt = "<div class='pbox'><h3 style='margin-top:0px;color:brown;'><a href='".h($url)."'>".h(urldecode($res['title']))."</a></h3><p>".h(urldecode($res['author']))."</p><p>電子版：￥".h($res['price'])." （紙の本：￥".h($res['list_price'])."） ".h($res['other'])."</p><p>評価：<div class='star'><p class='star_base'>★★★★★（".h($res['star'])."）</p><p class='star_up' style='width:".$star_width."px'>★★★★★</p></div></p><p>ASIN：".h($res['asin'])."</p><p>Google Play id：".h($res['gp_id'])."</p><p class='info_post'>".h($res['indate']).", <a href='index.php?name=".h(urldecode($res['name']))."'>".h(urldecode($res['name']))."</a>".h($res['age'])."</p><p class='free'>".h($res['free'])."</p></div>"; // $res['email']とかも可  .= は += と同じ意味
      array_unshift( $view, "<div class='flex'>".$img.$txt."</div>");
      $count_res += 1;
    }
  }
  $max_page = ceil($count_res / MAX);
  if(!isset($_GET['page_id'])){
    $now = 1; //設定されてない場合は1ページ目
  }else{
    $now = $_GET['page_id'];
  }
  $start_no = ($now - 1) * MAX;
  $disp_data = array_slice($view, $start_no, MAX, true);
}
if(isset($_GET['name'])){
    if($_GET['name']=='all'){
        $link = '<a style="color:black;" href="index.php">自分のブックマークに戻る，</a>';
    }else{
        $link = '<span><a style="color:black;" href="index.php">自分のブックマークに戻る，</a><a style="color:black;" href="index.php?name=all">皆のブックマークを見る，</a></span>';
    }
    $name_page = "name=".h($_GET['name']);
}else{
    $link = '<a style="color:black;" href="index.php?name=all">皆のブックマークを見る，</a>';
}

?>
<link href="css/destyle.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Cinzel&display=swap" rel="stylesheet">
<style>
  /* div{padding: 10px;font-size:16px;} */
  body{background: url('../img/book.jpg') no-repeat 0 0 /cover;background-color:black;box-sizing:border-box;}
  label{font-size:16px;}
  legend{margin-left:10px}
  .imgbox{width:140px;height:200px;margin-right:10px;}
  img{width:140px;height:100%}
  p{font-size:16px;}
  .flex{display:flex;justify-content:stretch;margin-bottom:10px;}
  .pbox{width:100%;height:200px;overflow:hidden;position:relative;}
  .pbox h3{font-size:20px;margin-bottom:4px;}
  .pbox a{color:brown;font-family:serif;}
  .pbox p{margin-bottom:2px;font-size:16px;}
  .pbox .info_post{position:absolute;bottom:0;right:5px;color:black;font-style:italic;}
  .pbox .free{position:absolute;top:30%;left:50%;width:50%;height:55%;overflow:auto;color:black;}
  .star{position:relative;}
  .star_base{position:absolute;top:-2.6rem;left:50px;}
  .star_up{position:absolute;top:-2.6rem;left:50px;color:orange;overflow:hidden;}
  
  </style>
<div style="display:flex;justify-content:space-between;">
    <p style="font-family:serif; margin-top:10px;">こんにちは、<?=h($name)?>さん</p>
    <p style="font-family:serif; margin-top:10px;"><?=$link?><a href="select.php">編集</a></p>
</div>

<div>
<?php
    foreach($disp_data as $val){
        echo $val;
    }

    echo '<p>';

    if($now!=1){
        $previous=$now-1;
        echo '<a style="margin-right:10px;font-family:serif;color:brown;" href="index.php?'.h($name_page).'">First<< </a>';
        echo '<a style="margin-right:10px;font-family:serifcolor:brown;;" href="index.php?page_id='.$previous.'&'.h($name_page).'">Previous< </a>';
    }

    for($i=1; $i<=$max_page;$i++){ // 最大ページ数分リンクを作成
        if ($i == $now) { // 現在表示中のページ数の場合はリンクを貼らない
            echo '<span style="margin-right:10px;font-family:serif;">'.$now.'</span>'; 
        } else {
            echo '<a style="margin-right:10px;font-family:serif;color:brown;" href="index.php?page_id='.$i.'&'.h($name_page).'">'.$i.'</a>';
        }
    }
    if($now<$max_page){
        $next=$now+1;
        echo '<a style="margin-right:10px;font-family:serif;color:brown;" href="index.php?page_id='.$next.'&'.h($name_page).'">>Next</a>';
        echo '<a style="font-family:serif;color:brown;" href="index.php?page_id='.$max_page.'&'.h($name_page).'&"> >>Last　</a>';
    }
    echo '</p>';

?>
</div>
