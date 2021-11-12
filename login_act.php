<?php
//最初にSESSIONを開始！！ココ大事！！
session_start();
include('funcs.php');

$token = $_POST['token'];

if(!isset($token) || $token != $_SESSION['token']){
  redirect('login.php?prop=csrf');
}

//POST値
$email = $_POST['email'];
$lpw = $_POST['lpw'];

//1.  DB接続します
$pdo = db_conn();

//2. 
$sql = 'SELECT * FROM bs_usr_table WHERE email=:email';
$stmt = $pdo->prepare($sql); //* PasswordがHash化の場合→条件はlidのみ
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
// $stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR); //* PasswordがHash化する場合はコメントする
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status==false){
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}

// ハッシュ化したパスワードが正しいかどうか判別(自分で書いた残骸)
// if(password_verify($lpw, $result['lpw'])){
//   echo('ログイン成功');
// }else{
//   echo('Emailアドレスかパスワードが違います');
//   redirect('login.php');
// }

//4. 抽出データ数を取得
$val = $stmt->fetch();         //1レコードだけ取得する方法
// $count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()

// 5. 該当レコードがあればSESSIONに値を代入
if(password_verify($lpw, $val["lpw"])){ //* PasswordがHash化の場合はこっちのIFを使う
// if( $val["id"] != "" ){
  //Login成功時
  if($val['life_flg']==0){
    $_SESSION["chk_ssid"]  = session_id();
    $_SESSION["kanri_flg"] = $val['kanri_flg'];
    $_SESSION["name"]      = $val['name'];
    redirect('index.php');
  }else if($val['life_flg']==2){
    redirect('login.php?prop=deleted');
  }else{
    redirect('login.php?prop=NG');
  }
}else{
  //Login失敗時(Logout経由)
  // echo('Emailアドレスが登録されていないか、パスワードが間違っています');
  redirect('login.php?prop=NG');
}

?>