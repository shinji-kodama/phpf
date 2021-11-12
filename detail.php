<?php
session_start();
include("funcs.php");
sschk();

$pdo = db_conn();

// GET受信
$id = $_GET['id'];  

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM bs_book_table WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);        //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
  sql_error($stmt);
}else{
  $res = $stmt->fetch();  //fetch : 頭の１行を取得する
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap-grid.css" rel="stylesheet">
  <style>div{padding: 0px;font-size:16px;}</style>
  <style>
  input{width:100%;height:20px}
  textarea{width:100%;height:100px}
  
  </style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->



  <form method="POST" action="update.php">
    
    <div class="container-fluid">
    <div class="row">

    <legend style="width:100%;background-color:green;">書籍登録</legend>
      
      <div class="col-sm-6">
        <div class="form-group">
          <label>タイトル</label><br>
          <input class="form-control" type="text" name="title" value="<?=h($res['title'])?>">
        </div>
        <div class="form-group">
          <label>作者</label>
          <input class="form-control type="text" name="author" value="<?=h($res['author'])?>">
        </div>
        <div class="form-group">
          <label>評価（0.0 ~ 5.0）</label>
          <input class="form-control" type="text" name="star" value="<?=h($res['star'])?>">
        </div>
        <div class="form-group">
          <label>URL</label>
          <input class="form-control" type="text" name="url" value="<?=h($res['url'])?>">
        </div>
        <div class="form-group">
          <label>表紙画像 (リンクURL)</label>
          <input class="form-control" type="text" name="img" value="<?=h($res['img'])?>">
        </div>
       
        
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label>ASIN</label>
          <input class="form-control" type="text" name="asin" value="<?=h($res['asin'])?>">
        </div>
        <div class="form-group">
          <label>ISBN 10</label>
          <input class="form-control" type="text" name="gp_id" value="<?=h($res['gp_id'])?>">
        </div>
        <div class="form-group">
          <label>感想</label>
          <input class="form-control" type="text" name="other" value="<?=h($res['other'])?>">
        </div>
        <div class="form-group"><input type="hidden" name="bm_id" value="<?=$res["bm_id"]?>">
          <label>書評・レビュー</label>
          <textArea class="form-control" name="free" rows="4" cols="40"><?=h($res['free'])?></textArea>
        </div>
        <div class="form-group">
          <input class="form-control" style="background-color:lightgray;" type="submit" value="送信">
        </div>
      </div>
    </div>
    </div>
  </form>


<!-- Main[End] -->


</body>
</html>



