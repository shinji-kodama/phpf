<?php
session_start();

include('funcs.php');

$name = $_POST['name'];
$email = $_POST['email'];
$lpw = $_POST['lpw']; //PHP 7.0.0からsaltは非推奨のため、DEFAULTでOK

$pdo = db_conn();

//2. 
$sql = 'SELECT * FROM bs_usr_table WHERE email=:email AND life_flg=1';
$stmt = $pdo->prepare($sql); //* PasswordがHash化の場合→条件はlidのみ
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$status = $stmt->execute();



//3. SQL実行時にエラーがある場合STOP
if($status==false){
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}

//4. データ抽出
$val = $stmt->fetch();         //1レコードだけ取得する方法

if(password_verify($lpw, $val["lpw"])){ //* PasswordがHash化の場合はこっちのIFを使う
// if( $val["id"] != "" ){
  //Login成功時

    $sql = "UPDATE bs_usr_table SET life_flg=0 WHERE email=:email";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

    $status = $stmt->execute(); //stmtを実行してエラーがあったら返す

}else{
  //Login失敗時(Logout経由)
  echo('パスワードが間違っています');
  // sleep(2);
  redirect('login.php?prop=NG');
}


if($status==false){
    $error = $stmt->errorInfo();
    // var_dump($error[2]);
    exit("SQLError:".$error[2]);
    // if(strpos($error[2],'name')!==false){
    //     redirect('signup.php?duplicate=name');
    // }else if(strpos($error[2],'email')!==false){
    //     redirect('signup.php?duplicate=email');
    // }
    
}else{
    redirect('reg_main_fin.php');
}
?>