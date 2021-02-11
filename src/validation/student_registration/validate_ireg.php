<?php
$final = '';
$yes = 1;
echo "Registrations closed. Please send an email to cvmun20@gmail.com for further queries";
if (0){   
    			if (1) {
    			        $email = $_POST['email'];
    			        $mob = $_POST['mobile'];
    	                $link = new mysqli("localhost","u864523831_cvmun20","ChettinadVidyashram600028","u864523831_cvmun20");
    	                $a = $link->query("SELECT COUNT(*) FROM ireg where email LIKE '$email' AND mob LIKE '$mob'");
                        $row = $a->fetch_assoc();
                        if(!$row["COUNT(*)"]){
    	                $name = $_POST['name'];
    	                $schoolname =  $_POST['schoolname'];
    	                $dob = $_POST['dob'];
    	                $prev = $_POST['prev'];
    	                $copt = $_POST['copt'];
    	                $cpref = $_POST['cpref'];
    	                $achieve = $_POST['achieve'];
    	                $queries ="INSERT INTO ireg (name,schoolname,mob,email,dob,prev,copt,cpref,achieve) VALUES ('$name', '$schoolname', '$mob', '$email', '$dob','$prev', '$copt','$cpref', '$achieve')";
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
    		            else{
    		                echo "present";
    		            }
    			}
}