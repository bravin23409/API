<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class SendMail {
    public function Send_Mail($conf, $mailCnt) {

        // Validate email before sending
        if (!filter_var($mailCnt['mail_to'], FILTER_VALIDATE_EMAIL)) {
            echo "Invalid recipient email address.";
            return;
        }

        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'gatithi.kuria@strathmore.edu';  
            $mail->Password   = 'jqsn hfej aszo vguz';           
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            // Recipients
            $mail->setFrom($mailCnt['mail_from'], $mailCnt['name_from']);
            $mail->addAddress($mailCnt['mail_to'], $mailCnt['name_to']);

            // Content (use what comes from signup.php)
            $mail->isHTML(true);
            $mail->Subject = $mailCnt['subject'];
            $mail->Body    = "Hello <b>{$mailCnt['name_to']}</b>,<br>{$mailCnt['body']}";

            $mail->send();
            echo "Message has been sent to {$mailCnt['mail_to']}";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}