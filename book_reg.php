<?php
session_start();

include('funcs.php');

// セッションチェック
sschk();
$name_search = $_SESSION['name'];
if(isset($_GET['title'])){
  $initial_title = $_GET['title'];
}

//1.  DB接続します
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM bs_book_table");
$status = $stmt->execute();

//３．データを配列に格納
$arr = array();
$count = 0;
if($status==false) {
  sql_error($stmt);
}else{
  //Selectデータの数だけ自動でループしてくれる
  $datalist = "<datalist id='datalistid'>";
  while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){
    $arr .= $res['title'];
    $datalist .= "<option value='".h($res['title'])."'></option>";
  }
  $datalist .= "</datalist>";

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
    <style>
      label{
        font-family: 'Cinzel', serif;
        color:rgb(156, 105, 105);
        font-size:14px;
      }
      input{
        width:100%;
        height:24px;
        background-color: #fff;
        border:rgb(155,105,105) 1px solid;
        border-radius: 8px;
        margin-bottom:8px;
        color:black;
        font-family: 'Cinzel', serif;
        padding:8px;
        font-size:12px;
      }
      input[type=checkbox].chk{
        width:16px;
        height:16px;
        border:rgb(155,105,105) 1px solid;
        border-radius: 8px;
        color:black;
        padding:8px;
        font-size:12px;
      }
      
      input[type=checkbox].chk:checked,input[type=checkbox].chk:indeterminate,input[type=checkbox].chk:after {
        background:#000;
      }
      input[type=checkbox].chk {
        border:2px solid #000;
      }
      textarea{
        width:100%;height:400px;
        background-color: #fff;
        border:rgb(155,105,105) 1px solid;
        border-radius: 8px;
        margin-bottom:8px;
        color:black;
        font-family: 'Cinzel', serif;
        padding:8px;
        font-size:12px;
      }

      #butt{
        width:100px;
        height:32px;
        text-align:center;
        background:rgb(130,70,0);
        color:white;
        left:50%;
      }
      #butt:hover{
        background:rgb(150,100,70);
      }
      p.aft{
        font-size:12px;
        color:rgb(130,70,0);
        font-family: 'Cinzel', serif;
        text-align:left;
        margin-bottom:16px;
      }
      button#amazon{
        width:100px;
        height:32px;
        text-align:center;
        background:rgb(130,70,0);
        color:white;
        border-radius: 8px;
      }
        
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <header>
        <?php include('parts/header.html'); ?>
    </header>

    <div>
        <form method="POST" action="" name="form1">
        
          <div class="container-fluid">
            <div class="row" style="border:0;">
        
              <legend style="width:100%;margin-top:16px;margin-bottom:10px;border-bottom:solid 1px rgb(155,105,105);">書籍を本棚へ登録 / 情報更新</legend>
        
              <div class="col-sm-6">
                <div class="form-group">
                  <label>タイトル</label><br>
                  <input id="title" class="form-control" type="text" name="title" autocomplete="on" list="datalistid">
                  <?php echo $datalist; ?>
                  <input type="hidden" id="asin02" name="asin" value="">
                </div>
                <div class="form-group">
                  <label>評価（0.0 ~ 5.0）</label>
                  <input id="star" class="form-control" type="text" name="star">
                </div>
                <div class="form-group">
                  <label>感想、つぶやき</label>
                  <input id="imp" class="form-control" type="text" name="imp">
                </div>
                <div class="form-group" style="display:flex;justify:content:start;">
                  <input id="fin" class="form-control chk" type="checkbox" name="fin" checked>
                  <label>　読了</label>
                </div>
                <div class="form-group" style="display:flex;justify:content:start;">
                  <input id="fav" class="form-control chk" type="checkbox" name="fav" checked>
                  <label>　お気に入りに登録</label>
                </div>
                <div class="form-group" style="display:flex;justify:content:start;">
                  <input id="release" class="form-control chk" type="checkbox" name="rel">
                  <label>　書評を公開する</label>
                </div>
              </div>
              <div class="col-sm-6">
                <div style="display:flex;justrify-content:start;">
                  <div style="width:180px;height:240px;flex-shrink:0;">
                    <img id="img" style="width:100%;height:100%;" src="./img/shiori_c.png" alt="">
                  </div>
                  <div style="position:relative;">
                    <div style="position:relative;top:50%;left:8px;transform:translateY(-50%);">
                      <p class="aft" id="title02">本棚に登録した書籍については、</p>
                      <p class="aft" id="author">他の本の虫達が書いた感想や書評を</p>
                      <p class="aft" id="asin">簡単に閲覧することができます</p>
                      <p class="aft" id="c1"></p>
                      <p class="aft" id="c2">書籍について議論を深め、</p>
                      <p class="aft" id="c3">趣味の合う虫と友達になろう！</p>
                    </div>
                  </div>
                </div>
                <!-- <div class="form-group">
                  <label>ASIN</label>
                  <input class="form-control" type="text" name="asin">
                </div>
                <div class="form-group">
                  <label>ISBN 10</label>
                  <input class="form-control" type="text" name="gp_id">
                </div> -->
                
                
              </div>
            </div>
            <div class="row">
              <div class="form-group">
                <label>書評・レビュー</label>
                <textarea id="rev" class="form-control" name="rev" rows="4" cols="40"></textarea>
              </div>
              <div class="form-group" style="display:flex;justify-content:space-between;">
                <input id="butt" class="form-control" type="submit" value="送信">
                <button id="amazon" type="button"><p style="font-size:12px">amazonで検索</p></button>
              </div>
            </div>
          </div>
        </form>



    </div>



    <footer>
        <div class="row bro">
            <div class="col-sm-12 rela h32">
                <p class="abs righ" style="text-align:right;color:black;margin-right:16px;font-size:12px"><a href="del_account.php">退会はこちら</a></p>
                <p class="abs cent" style="text-align:right;color:white;font-size:12px">©️ kamekame Ltd.</p>
            </div>
        </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
    const name = '<?php echo $name_search; ?>';
    const intitle = document.getElementById('title');
    
    intitle.addEventListener('change',function(){
      const title = intitle.value;

      const data = {
        title:title,
        name:name
      };

      //Ajax（非同期通信）
      axios.get('book_info.php', {
        params:data
      })
      .then(function (response) {
        const v = response.data;
        document.querySelector("#img").setAttribute('src',v.img);
        document.getElementById("title02").innerHTML = v.title;
        document.getElementById("author").innerHTML = "作者：" + v.author;
        document.getElementById("asin").innerHTML = "ASIN：" + v.asin;
        document.getElementById("c1").innerHTML = "分類1：" + v.c1;
        document.getElementById("c2").innerHTML = "分類2：" + v.c2;
        document.getElementById("c3").innerHTML = "分類3：" + v.c3;
        document.getElementById("asin02").value = v.asin;
        document.getElementById('star').value = v.star;
        document.getElementById('imp').value = v.imp;
        
        if(v.fav=="1"){
          document.getElementById('fav').checked = true
        }else(
          document.getElementById('fav').checked = false
        )
        if(v.rel=="1"){
          document.getElementById('release').checked = true
        }else{
          document.getElementById('release').checked = false
        }
        if(v.fin=="1"){
          document.getElementById('fin').checked = true
        }else(
          document.getElementById('fin').checked = false
        )
        document.getElementById('imp').value = v.imp;
        document.getElementById('rev').value = v.rev;
        document.getElementById('asin02').value = v.asin;
        

        if(v.flg=="1"){
          document.form1.action = 'fav_update.php';
        }else if(v.flg=="0"){
          document.form1.action = 'fav_insert.php';
        }else{
          document.form1.action = '';
          alert('リストに表示されない書籍はデータベース未登録です。\n拡張機能を使ってAmaonのページから情報を取得してください。')
        }

      }).catch(function (error) {
        console.log(error);//通信Error
      }).then(function () {
        console.log("Last");//通信OK/Error後に処理を必ずさせたい場合
      });
    });

    const search_amazon = document.getElementById('amazon');
    search_amazon.addEventListener('click', function(){
      console.log(intitle);
      const new_win = window.open('https://www.amazon.co.jp/gp/browse.html?node=2275256051&ref_=nav_em__kbo_0_2_8_8', 'new_window');
        new_win.alert('aaa');
        const search_box = new_win.document.getElementById('twotabsearchtextbox');
        search_box.value = intitle;
        console.log(intitle);
    })
    
    window.onload = function(){
      setTimeout(() => {
        const initial_title = '<?=h($initial_title)?>'
        if(initial_title){
          document.getElementById('title').value = initial_title;
          let newEvent = new Event('change');
          document.getElementById('title').dispatchEvent(newEvent);
        }
      }, 500);
    }


    </script>
</body>
</html>