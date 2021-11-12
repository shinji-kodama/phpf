<?php
session_start();

include('funcs.php');

$token = $_POST['token'];
if(!isset($token) || $token != $_SESSION['token']){
  redirect('resignup.php?prop=csrf');
}

$name = $_POST['name'];
$email = $_POST['email'];
$lpw = $_POST['lpw']; 

$pdo = db_conn();

$sql = "SELECT * FROM bm_usr_table WHERE email=:email AND life_flg=2";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$status = $stmt->execute(); //stmtを実行してエラーがあったら返す

if($status==false){
    $error = $stmt->errorInfo();
    exit('SQLError:'.$error[2]);
}

$val = $stmt->fetch(); 

if(!$val){
    redirect('resignup.php?prop=email');  
}

if(password_verify($lpw, $val["lpw"])){ 
    
    $sql = "UPDATE bm_usr_table SET name=:name, life_flg=0 WHERE email=:email AND life_flg=2";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $status = $stmt->execute(); //stmtを実行してエラーがあったら返す

    if($status==false){
        $error = $stmt->errorInfo();
        if(strpos($error[2],'name')!==false){
            redirect('resignup.php?prep=name');
        }   
    }
    redirect('rereg_fin.php');

}else{
  redirect('resignup.php?prop=pass');
}

?>