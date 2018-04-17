<?php
/**
 * Created by PhpStorm.
 * User: jackob
 * Date: 2018/3/28
 * Time: 下午1:20
 */
require_once('PHPMailer/PHPMailerAutoload.php');
class Mail {
    public static function sendMail($subject, $body, $address) {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.126.com';
        $mail->Port = '465';
        $mail->isHTML();
        $mail->Username = 'jackob_xm@126.com';
        $mail->Password = 'jackob314151';
        $mail->SetFrom('jackob_xm@126.com');
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($address);

        $mail->Send();
    }
}
?>