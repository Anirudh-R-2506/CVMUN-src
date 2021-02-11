<?php
/*$url = "https://www.google.com/recaptcha/api/siteverify";
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
			$res = json_decode($response, true);*/
function sendmail($email1,$email2,$body){
                        require("mailer/src/PHPMailer.php");
    	                require("mailer/src/SMTP.php");
    	                require("mailer/src/Exception.php");
    	                $mail = new PHPMailer\PHPMailer\PHPMailer(true);//add true in paranthesis for debug mode
    	                $mail->IsSMTP();
    	                $mail->SMTPAuth = true;
    	                $mail->SMTPSecure = 'ssl';
    	                $mail->Host = "smtp.gmail.com";
    	                $mail->Port = 465; // or 587
    	                $mail->IsHTML(true);
    	                $mail->Username = "cvmun20@gmail.com";
    	                $mail->Password = "qrqaoiwijvhzzams";
    	                $mail->SetFrom("cvmun20@gmail.com");
    	                $mail->Subject = "NEW CHIT!!";
    	                $mail->Body = $body;
    		            $mail->AddAddress("$email1");
    		            if ($email2!=''){
    		                $mail->AddAddress("$email2");}
    		            $mail->Send();
    		            
}
function sendchit($email,$sub,$country){
    $link = new mysqli("localhost","u864523831_cvmun20","ChettinadVidyashram600028","u864523831_cvmun20");
    $a = $link->query("INSERT INTO `cUNGA-DISEC`(email,subject) VALUES('$email','".strtoupper($country).$sub."')");
    
}
function get_del($email){
    $link = new mysqli("localhost","u864523831_cvmun20","ChettinadVidyashram600028","u864523831_cvmun20");
    $a = $link->query("SELECT name from `UNGA-DISEC` where email like '$email'");
    $r = $a->fetch_all();
    if ($r){
    return $r[0][0];}
    else{
        return "NULL";
    }
}
if (isset($_POST['submit'])){
    $body="FROM : Pakistan<br>SUBJECT : ".$_POST['subject']."<br>MESSAGE : ".$_POST['message'];
    str_replace('\n',"<br>",$body);
    #echo $body;
    if ($_POST['to'] != 'eb'){
        sendchit("anirudhnfs01@gmail.com",$_POST['message'],get_del($_POST['to']));
        sendmail($_POST['to'],"cvmun20@gmail.com",$body);
        }
    else{sendmail("cvmun20@gmail.com",'',$body);}
}
?>
<html>
    <body>
        <form action='' method="post">
            <select id="type" name="to">
                <option value="eb" selected>EXECUTIVE BOARD</option>
                <option value="nishantmail13@gmail.com">BELGIUM</option>
                <option value="anirudhnfs01@gmail.com">MALDIVES</option>
            </select>
            <input type="text" name="subject" placeholder="Enter Subject">
            <textarea name="message" placeholder="Enter Message"></textarea>
            <input type="submit" name="submit">
        </form>
    </body>
</html>