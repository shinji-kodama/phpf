<?php
session_start();

include('funcs.php');

// セッションチェック
sschk();
$name = $_SESSION['name'];
if(isset($_GET['comm'])){
  $comm = $_GET['comm'];
}

if(isset($_GET['page'])){
    $page = $_GET['page'];
  }

//1.  DB接続します
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM com_usr_table WHERE com_name=:comm");
$stmt->bindValue(':comm', $comm);
$status = $stmt->execute();

//３．データ表示

if($status==false) {
  sql_error($stmt);
}else{
  //Selectデータの数だけ自動でループしてくれる
    $res = $stmt->fetch();
    $img = !$res['img'] ? './img/noface.jpg' : $res['img'];
    $img_bg = !$res['img_bg'] ? './img/book.jpg' : $res['img_bg'];
}



?>

<!DOCTYPE html>
<html lang="ja">
  <head>
  <meta charset="UTF-8">
  <title>other worms</title>
  <link href="css/destyle.css" rel="stylesheet">
  <link href="css/bootstrap-grid.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Cinzel&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=New+Tegomin&display=swap" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
  <style>

  </style>
  <script>
    let name = '<?php echo $name;?>'
    let worm = '<?php echo $worm;?>'
    let img = '<?php echo $img;?>'
  </script>
  </head>
  <body>
  <header> 
    <?php include('parts/header.html'); ?>
  </header>

  <div class="container-fluid">
    <div class="row lbro">
      <div class="col-sm-4" style="box-shadow: 5px 0px 10px 0 rgba(0, 0, 0, .5)">
        <?php include('parts/recm_comm.php'); ?>
       
      </div>
      <div class="col-sm-8">
        <?php 
          if(isset($comm)){
            include('parts/comm.php');
          }else{
            include('parts/blanc.html'); 
          }
        ?>
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