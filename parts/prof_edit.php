<?php
// include('../funcs.php');

// セッションチェック
// sschk();

//1.  DB接続します
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM bs_usr_table WHERE name=:name");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$status = $stmt->execute();

//３．データ表示

if($status==false) {
  sql_error($stmt);
}else{
  //Selectデータの数だけ自動でループしてくれる
  $rp = $stmt->fetch();
  $add = $rp['address'];
  $age = $rp['age'];
  $f_book = $rp['no1book'];
  $f_auth = $rp['fav_author'];
  $intro = $rp['intro'];

}




?>



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

<form method="POST" action="parts/prof_update.php" enctype="multipart/form-data">
    <div class="container-fluid">
        <div class="row" style="border:0;">
            <legend style="width:100%;margin-top:16px;margin-bottom:10px;border-bottom:solid 1px rgb(155,105,105);">プロフィール更新</legend>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>住処</label><br>
                    <input id="address" class="form-control" type="text" name="address" value="<?=h($add)?>">

                    <input type="hidden" id="name" name="name" value="<?=h($name)?>">
                </div>
                <div class="form-group">
                    <label>年齢</label>
                    <input id="age" class="form-control" type="text" name="age" value="<?=h($age)?>">
                </div>
                <div class="form-group">
                    <label>今一番好きな本</label>
                    <input id="f_book" class="form-control" type="text" name="f_book" value="<?=h($f_book)?>">
                </div>
                <div class="form-group">
                    <label>今一番好きな作者</label>
                    <input id="f_author" class="form-control" type="text" name="f_auth" value="<?=h($f_auth)?>">
                </div>
                <div class="form-group">
                    <label>自分のアイコン</label>
                    <input type="file" name="upfile1">
                </div>
                <div class="form-group">
                    <label>背景画像</label>
                    <input type="file" name="upfile2">
                </div>

            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>自己紹介</label>
                    <textarea id="intro" class="form-control" type="text" name="intro" style="height:200px;"><?=h($intro)?></textarea>
                </div>
            </div>
            <input id="butt" class="form-control" type="submit" value="送信">
        </div>
    </div>    
</form>