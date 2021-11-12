<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ebookmark</title>
  <link href="css/bootstrap-grid.css" rel="stylesheet">
  <style>
  /* div{padding: 10px;font-size:16px;} */
  body{background: url('img/book.jpg') no-repeat 0 0 /cover;background-color:black;box-sizing:border-box;}
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav style="margin-bottom:0;display:flex;justify-content:space-between;">
  <div>
    <p style="color:white;font-family:serif;margin:10px">
      <img style="height:30px;width:30px" src="extension/book_48.png" alt=""> Ebookmark
    </p>
  </div>
  <div>
    <a class="navbar-brand" style="color:white;font-family:serif;" href="logout.php">ログアウト</a>
    
  </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div class="container-fluid">
  <div class="row" style="background-color:rgba(255,230,200,0.6);">
    <div class="col-sm-2" style="height:935px; color:black;font-family:serif;border-right:1px solid rgba(165,42,42,0.2)">
      <form method="post" action="insert.php">
        <!-- <div class="jumbotron"> -->
        <!-- <fieldset> -->
        <h3 style="font-size:18px;font-family:serif;color:brown;">書籍登録</h3>
        <div class="form-group">
          <label style="font-size:14px;font-family:serif;">名前</label>
          <input style="border-radius:0px" class="form-control" type="text" name="name" required>
        </div>
        <div class="form-group">
          <label style="font-size:14px;font-family:serif;">タイトル</label>
          <input style="border-radius:0px" class="form-control" type="text" name="title" required>
        </div>
        <div class="form-group">
          <label style="font-size:14px;font-family:serif;">作者</label>
          <input style="border-radius:0px" class="form-control" type="text" name="author" required>
        </div>
        <div class="form-group">
          <label style="font-size:14px;font-family:serif;">評価（0~5）</label>
          <input style="border-radius:0px" class="form-control" type="text" name="star">
        </div>
        <div class="form-group">
          <label style="font-size:14px;font-family:serif;">URL</label>
          <input style="border-radius:0px" class="form-control" type="text" name="url" required>
        </div>
        <div class="form-group">
          <label style="font-size:14px;font-family:serif;">画像(link)</label>
          <input style="border-radius:0px" class="form-control" type="text" name="img" required>
        </div>
        <div class="form-group">
          <label style="font-size:14px;font-family:serif;">価格</label>
          <input style="border-radius:0px" class="form-control" type="text" name="price" required>
        </div>
        <div class="form-group">
          <label style="font-size:14px;font-family:serif;">定価</label>
          <input style="border-radius:0px" class="form-control" type="text" name="list_price" required>
        </div>
        <div class="form-group">
          <label style="font-size:14px;font-family:serif;">その他</label>
          <textarea style="border-radius:0px" class="form-control" rows="4" type="text" name="free"></textArea>
        </div>
        <input class="btn btn-default" style="border-radius:0px;margin-bottom:20px;color:black" id="submit" type="submit" value="送信">
        <!-- </fieldset> -->
        <!-- </div> -->
      </form>
    </div>
    <div class="col-sm-7" style="font-family:serif;background-color:rgba(255,255,255,0);border-radius: 2px;">
      <?php include('parts/recent.php'); ?>
    </div>
    <div class="col-sm-3" style="font-family:serif;border-radius: 0px;height:935px; overflow:auto;border-left:1px solid rgba(165,42,42,0.2)">
      <h3 style="color:brown;font-family:serif;">Utilize Chrome Extension or Bookmarklet</h3>
      <p style="font-family:serif;">for various ebook stores and review sites</p>
      <h3 style="color:brown;font-family:serif;font-size:20px;"><img style="width:24px;height:24px;" src="extension/book_16.png">Chrome Extension</h3>
      <p style="font-family:serif;">Download <a style="color:brown" href="./extension.zip" download>HERE</a> and loading the Extension</p>
      <h3 style="color:brown;font-family:serif;font-size:20px;"><img style="width:24px;height:24px;" src="img/shiori_24.png">Bookmarklet</h3>
      <p style="font-family:serif;">Generate code and register a Bookmark</p>
      <input class="form-control" id="bm_name" type="text" value="<?=h($name)?>">
      <button id="generate">code generate</button>
      <span id="code">
      </span>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12" style="border-radius:0px;">
      <p style="text-align:right;color:black;"><a href="del_account.php">退会はこちら</a></p>
      <p style="text-align:right;color:white;">©️ kamekame Ltd.</p>
    </div>
  </div>
</div>


<!-- Main[End] -->

<script src="js/bml_gen.js"></script>

</body>
</html>
