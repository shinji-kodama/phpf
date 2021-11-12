<?php
session_start();

include('funcs.php');

// セッションチェック
sschk();
$name_search = $_SESSION['name'];
if(isset($_GET['page'])){
  $page = $_GET['page'];
}

//1.  DB接続します
// $pdo = db_conn();

// //２．データ登録SQL作成
// $stmt = $pdo->prepare("SELECT * FROM bs_book_table");
// $status = $stmt->execute();

// //３．データ表示

// if($status==false) {
//   sql_error($stmt);
// }else{
//   //Selectデータの数だけ自動でループしてくれる
//   while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){
//     $view .= 1;
//   }
// }


?>

<!DOCTYPE html>
<html lang="ja">
  <head>
  <meta charset="UTF-8">
  <title>BOOKWORM'S NEST</title>
  <link href="css/destyle.css" rel="stylesheet">
  <link href="css/bootstrap-grid.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Cinzel&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=New+Tegomin&display=swap" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
  <style>

  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    let name = '<?php echo $name_search;?>'
  </script>
  </head>
  <body>
  <header> 
    <?php include('parts/header.html'); ?>
  </header>

  <div class="container-fluid">
    <div class="row lbro">
      <div class="col-sm-3">
        <?php include('parts/rank.html'); ?>
       
      </div>
      <div class="col-sm-6">
        <a href="book_reg.php">
          <div style="cursor:text;width:100%;height:32px;margin:8px auto;background-color:white;border-radius:10px">
            <p style="color:rgb(200, 150, 150);padding-top:8px;">本棚に本を入れ、読んだ本の感想を書こう</p>
          </div>
        </a>
        <?php 
          if($page=='books'){
            include('parts/bookshelf.html');
          }else{
            include('parts/home.html'); 
          }
        ?>
      </div>
      <div class="col-sm-3">
        <?php include('parts/friend.html'); ?>
        <?php include('parts/community.php'); ?>
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