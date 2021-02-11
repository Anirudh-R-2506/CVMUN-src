<?php
 /*require_once 'swift/swiftmailer-master/lib/swift_required.php';

$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, "ssl"))
  ->setUsername('fsoceity.ar@gmail.com')
  ->setPassword('ydxqavwmunmyykue');

$mailer = new Swift_Mailer($transport);

$message = (new Swift_Message('test Subject'))
  ->setFrom(array('fsoceity.ar@gmail.com' => 'ABC'))
  ->setTo(array('anirudhnfs01@gmail.com'))
  ->setBody('This is a test mail.');

$result = $mailer->send($message);
echo $result;*/
require("src/PHPMailer.php");
	                require("src/SMTP.php");
	                require("src/Exception.php");
try {
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'ssl';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->Username = 'fsoceity.ar@gmail.com';
    $mail->Password = 'ejaculationegambaram';
    $mail->setFrom('fsoceity.ar@gmail.com', 'Sme Name');
    $mail->addAddress('anirudhnfs01@gmail.com', 'test na');
    $mail->IsHTML(true);
    $mail->Subject = "Send email using Gmail SMTP and PHPMailer";
    $mail->Body = 'HTML message body. <b>Gmail</b> SMTP email body.';
    $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';
    $mail->send();
    echo "Email message sent.";
} catch (Exception $e) {
    echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
}
?>