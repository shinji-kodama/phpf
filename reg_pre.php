<?php
session_start();
// if(isset(!$_POST['token']) || $_POST["token"] !== $_SESSION['token']){
//   redirect('signup.php?err=csrf');
// }
use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';


include('funcs.php');



$name = $_POST['name'];
$email = $_POST['email'];
$lpw = password_hash($_POST['lpw'], PASSWORD_DEFAULT); //PHP 7.0.0からsaltは非推奨のため、DEFAULTでOK

$pdo = db_conn();

$stmt = $pdo->prepare("INSERT INTO bs_usr_table(name, email, lpw, kanri_flg, life_flg, indate) VALUES(:name, :email, :lpw, 0, 1, sysdate())");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$status = $stmt->execute(); //stmtを実行してエラーがあったら返す

if($status==false){
    $error = $stmt->errorInfo();
    // var_dump($error[2]);
    // exit("SQLError:".$error[2]);
    if(strpos($error[2],'name')!==false){
        redirect('signup.php?duplicate=name');
    }else if(strpos($error[2],'email')!==false){
        redirect('signup.php?duplicate=email');
    }
    
}else{

    $mail = new PHPMailer(true);

    try {
     //ホスト（さくらのレンタルサーバの初期ドメイン）
        $host = 'jskm.sakura.ne.jp';
    //メールアカウントの情報（さくらのレンタルサーバで作成したメールアカウント）
        $user = 'kodama@jskm.sakura.ne.jp';
        $password = 'Bws11565_';
    //差出人
        $from = 'info@jskm.sakura.ne.jp';
        $from_name = 'kodama@nestbw.com';
    //宛先
        $to = $email;
        $to_name = $name;
    //件名
        $subject = 'NEST for BOOKWORMS 仮会員登録完了メール';
    //本文
        $body = <<<EOM
        {$name}様
        
        この度は、会員登録いただきありがとうございます。
        以下のURLから登録情報の有効化をお願いいたします。

        http://jskm.sakura.ne.jp/phpf/signup_main.php?name={$name}&email={$email}
        
        よろしくお願いいたします。


        NEST for BOOKWORMS 事務局
        EOM;

        // https://jskm.sakura.ne.jp/phpf/signup_main.php?name={$name}&email={$email}
    //諸々設定
    //$mail->SMTPDebug = 2; //デバッグ用
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = $host;
        $mail->Username = $user;
        $mail->Password = $password;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->CharSet = "utf-8";
        $mail->Encoding = "base64";
        $mail->setFrom($from, $from_name);
        $mail->addAddress($to, $to_name);
        $mail->Subject = $subject;
        $mail->Body = $body;
        //メール送信
        $mail->send();
    } catch (Exception $e) {
        echo '失敗: ', $mail->ErrorInfo;
    }

    redirect('reg_pre_fin.php');
}
?>