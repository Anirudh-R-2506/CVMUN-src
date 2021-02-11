<?php
header('Location: /error/');
			if (0) {
			        $email = $_POST['email'];
			        $enroll = $_POST['enroll'];
			        $mob = $_POST['mobile'];
	                $link = new mysqli("localhost","u864523831_cvmun20","ChettinadVidyashram600028","u864523831_cvmun20");
	                $a = $link->query('SELECT email FROM cvreg');
	                $b = '';
                    while($row = $a->fetch_assoc()) {
                        if($row['enroll'] == $enroll){
                            $b = "y";
                            break;
                        }
                    }
                    if($b==''){
                    //$emailurl = "https://emailverification.whoisxmlapi.com/api/v1?apiKey=at_jtDYhM6P2m0EtP2E0eQEl8HTj8Ukb&emailAddress=".$_POST['email'];
                    //$valid = file_get_contents($emailurl);   json_decode($valid)->smtpCheck == true
                    if (1){
	                $name = $_POST['name'];
	                $cho = $_POST['cho'];
	                $cla = $_POST['cla'];
	                $sec = $_POST['sec'];
                    $image = $_POST['img_durl'];
	                $queries ="INSERT INTO cvreg (name,class,section,enroll,mob,email,committee,screenshot) VALUES ('$name', '$cla', '$sec', '$enroll', '$mob','$email', '$cho','$image')";
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
	                $mail->Body = file_get_contents('mail-template.html');
	                $mail->AddEmbeddedImage('logo.png','logo');
		            $mail->AddAddress("$email");
		            $mail->AltBody = "<html><body><center><p>Thank you for registering with us.<br><Br><br>CVMUN TECH TEAM<br><br><br><p>For any further enquiries <a href='https://cvmun.tech/contact'>contact us</a></p></center></body></html>";
		            try{
		            $mail->Send();
		            echo "yes";
                    }
                    catch (Except $e){
                        echo "yes";
                    }
                    }
                    }
		            else{
		                echo "present";
		            }
			}
			