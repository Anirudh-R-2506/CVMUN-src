<?php
if ($_POST['name'] != '' && $_POST['message'] != '' && $_POST['subject'] != '' && $_POST['email'] != ''){
    $url = "https://www.google.com/recaptcha/api/siteverify";
			$data = [
				'secret' => "6LfANOcZAAAAALCnZ4i_9Myn6lbLcx1dGv3LNt0p",
			    'response' => $_POST['captcha'],
				'remoteip' => $_SERVER['REMOTE_ADDR'],
			];
			$options = array(
			    'http' => array(
			      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			      'method'  => 'POST',
			      'content' => http_build_query($data)
			    )
			  );
			$context  = stream_context_create($options);
	  		$response = file_get_contents($url, false, $context);
			$res = json_decode($response, true);
			#$emailurl = "https://api.trumail.io/v2/lookups/json?email=".$_POST['email'];
			#$valid = file_get_contents($emailurl);  && json_decode($valid)->hostExists
			if ( $res['success'] == true) {
                    $link = new mysqli("localhost","u864523831_cvmun20","ChettinadVidyashram600028","u864523831_cvmun20");
                    $name = mysqli_real_escape_string($link, $_POST['name']);
                    $subject = mysqli_real_escape_string($link, $_POST['subject']);
                    $email = mysqli_real_escape_string($link, $_POST['email']);
                    $message = mysqli_real_escape_string($link,$_POST['message']);
                    $queries ="INSERT INTO contact (name,email,subject,message) VALUES ('$name','$email','$subject','$message')";
                    $link->query($queries);
                    require("mailer/src/PHPMailer.php");
    	            require("mailer/src/SMTP.php");
    	            require("mailer/src/Exception.php");
    	            $mail = new PHPMailer\PHPMailer\PHPMailer();//add true in paranthesis for debug mode
	                $mail->IsSMTP();
	                $mail->SMTPAuth = true;
	                $mail->SMTPSecure = 'ssl';
	                $mail->Host = "smtp.gmail.com";
	                $mail->Port = 465; // or 587
	                $mail->IsHTML(true);
	                $mail->Username = "cvmun20@gmail.com";
	                $mail->Password = "qrqaoiwijvhzzams";
	                $mail->SetFrom("cvmun20@gmail.com");
	                $mail->Subject = "Registration";
	                $mail->Body = "NEW CONTACT!!<br>NAME : ".$name."<br>EMAIL : ".$email."<br>SUB : ".$subject."<br>MESSAGE : ".$message;
	                $mail->AddEmbeddedImage('logo.png','logo');
		            $mail->AddAddress("cvmun20@gmail.com");
		            $mail->Send();
                    echo "yes";
			}
            else{
                echo "no";
            }
}
else{
header('Location: /error/');
}