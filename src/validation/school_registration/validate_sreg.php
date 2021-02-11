<?php
$yes = 1;
echo "Registrations closed. Please send an email to cvmun20@gmail.com for further queries";
if (0){/*
    $url = "https://www.google.com/recaptcha/api/siteverify";
                    			$data = [
                    				'secret' => "6LfANOcZAAAAALCnZ4i_9Myn6lbLcx1dGv3LNt0p",
                    				'response' => $_POST['captcha'],
                    				'remoteip' => $_SERVER['REMOTE_ADDR']
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
    if ($res['success'] == 1 && $res['score'] >= 0.4){
        $yes = 1;
    }
    else{
        echo "FORM EXPIRED. PLEASE REFRESH THE PAGE AND TRY AGAIN. ";
        $yes = 0;
    }*/
    if (1){
        $emailurl = "https://emailverification.whoisxmlapi.com/api/v1?apiKey=at_jtDYhM6P2m0EtP2E0eQEl8HTj8Ukb&emailAddress=".$_POST['heademail'];
    $valid = file_get_contents($emailurl);
    if (json_decode($valid)->smtpCheck != true){echo "PLEASE ENTER VALID EMAIL(S). ";$yes=0;}
    }
}
if (0){
			if (1) {
			        $heademail = $_POST['heademail'];
			        $headmob = $_POST['headmob'];
			        $temail = $_POST['temail'];
			        $schoolname =  $_POST['schoolname'];
	                $link = new mysqli("localhost","u864523831_cvmun20","ChettinadVidyashram600028","u864523831_cvmun20");
	                $a = $link->query("SELECT COUNT(*) FROM sreg where temail LIKE '$temail' AND heademail LIKE '$heademail' AND schoolname LIKE '$schoolname'");
	                $row = $a->fetch_assoc();
                    if(!$row["COUNT(*)"]){
	                $headname = $_POST['headname'];
	                $numberofdel = $_POST['numberofdel'];
	                $prev = $_POST['prev'];
	                $c1opt = $_POST['c1opt'];
	                $c1pref = $_POST['c1pref'];
	                $c2opt = $_POST['c2opt'];
	                $c2pref = $_POST['c2pref'];
	                $c3opt = $_POST['c3opt'];
	                $c3pref = $_POST['c3pref'];
	                $c4opt = $_POST['c4opt'];
	                $c4pref = $_POST['c4pref'];
	                $tname = $_POST['tname'];
	                $tmob = $_POST['tmob'];
	                $queries ="INSERT INTO sreg (schoolname,headmob,heademail,headname,temail,tname,tmob,numberofdel,prev,c1opt,c1pref,c2opt,c2pref,c3opt,c3pref,c4opt,c4pref) VALUES ( '$schoolname', '$headmob', '$heademail','$headname','$temail','$tname','$tmob','$numberofdel','$prev', '$c1opt','$c1pref', '$c2opt', '$c2pref', '$c3opt', '$c3pref', '$c4opt', '$c4pref')";
		            $link->query($queries);
	                require("mailer/src/PHPMailer.php");
	                require("mailer/src/SMTP.php");
	                require("mailer/src/Exception.php");
	                $mail = new PHPMailer\PHPMailer\PHPMailer();
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
	                $mail->Body = file_get_contents('mail-template.html');
	                $mail->AddEmbeddedImage('logo.png','logo');
		            $mail->AddAddress("$heademail");
		            $mail->AltBody = "<html><body><center><p>Thank you for registering with us.<br><Br><br>CVMUN TECH TEAM<br><br><br><p>For any further enquiries <a href='https://cvmun.tech/contact'>contact us</a></p></center></body></html>";
		            try{
		            $mail->Send();
		            echo "yes";
                    }
                    catch (Except $e){
                        echo "yes";
                    }
                    }
		            else{
		                echo "present";
		            }
			}
}