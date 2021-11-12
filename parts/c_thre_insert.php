<?php
include('../funcs.php');

$name = $_POST['name'];
$c_name = $_POST['comm'];
$title = $_POST['title'];
$main = $_POST['main'];

$pdo = db_conn();

$sql="INSERT INTO thread_table(com_name,thread_title,thread_main,contributor,indate)
    VALUES(:c_name,:title,:main,:name,sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name',$name, PDO::PARAM_STR);
$stmt->bindValue(':c_name',$c_name, PDO::PARAM_STR);
$stmt->bindValue(':title',$title, PDO::PARAM_STR);
$stmt->bindValue(':main',$main, PDO::PARAM_STR);
$status = $stmt->execute();

if($status==false){
    sql_error($stmt);
}else{
    redirect('../communities.php?comm='.h($c_name));
}

?>