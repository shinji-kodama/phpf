<?php
include('../funcs.php');

$name = $_POST['name'];
$c_name = $_POST['comm'];
$book = $_POST['book'];
$comment = $_POST['comment'];

$pdo = db_conn();

$sql="INSERT INTO com_recom_book(com_name,book_title,name_reg,comment,indate)
    VALUES(:c_name,:book,:name,:comment,sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name',$name, PDO::PARAM_STR);
$stmt->bindValue(':c_name',$c_name, PDO::PARAM_STR);
$stmt->bindValue(':book',$book, PDO::PARAM_STR);
$stmt->bindValue(':comment',$comment, PDO::PARAM_STR);
$status = $stmt->execute();

if($status==false){
    sql_error($stmt);
}else{
    redirect('../communities.php?comm='.h($c_name).'&page=book');
}

?>