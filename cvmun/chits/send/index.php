<?php
$co = get_del();
$wp = array("REPORTER","CARTOONIST");
if (strpos($co,"(IPC)") !== false || in_array($co,$wp)){header('Location : /cvmun');}
session_start();
function otp(){
    $number = '';
    for ($i = 0; $i < 5; $i++){
        $number .= rand(0,9);
    }

    return (int)$number;
}
$link = new mysqli("localhost","u864523831_cvmun20","ChettinadVidyashram600028","u864523831_cvmun20");
$sql = "SELECT COUNT(*) FROM chits WHERE committee LIKE '".decrypt($_COOKIE['com'])."'";
$result = $link->query($sql);
$res = $result->fetch_assoc();
if (!$res['COUNT(*)']){$_SESSION['notyet']=1;header('Location:/cvmun/chits/notyet/?s='.urlencode(md5(otp())));}
function checkmail($email){
    $com = array("UNGA-DISEC","UNGA-ECOFIN","UNHRC");
    $link = new mysqli("localhost","u864523831_cvmun20","ChettinadVidyashram600028","u864523831_cvmun20");
    foreach($com as $c){
    	$a = $link->query("SELECT COUNT(*) FROM `".$c."` where email LIKE '$email'");
    	$row = $a->fetch_assoc();
        if ($row['COUNT(*)']){return 1;}
    }
    return 0;
}
function image(){
    $img = array(
    "UNGA-DISEC"=>'<img src="/src/img/committee/disec.png">',
    "UNGA-ECOFIN"=>'<img src="/src/img/committee/ecofin.png">',
    "UNHRC"=>'<img src="/src/img/committee/unhrc.png">',
        );
    return $img[decrypt($_COOKIE['com'])];
}
function sendtoeb($email,$body){
    $arr = array(
                            "UNHRC"=>"unhrc.chits@gmail.com",
                            "UNGA-DISEC"=>"disec.chits@gmail.com",
                            "UNGA-ECOFIN"=>"ecofin.chits@gmail.com");
                        $from = $arr[decrypt($_COOKIE['com'])];
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
    	                $mail->Username = "$from";
    	                $mail->Password = "ChettinadVidyashram600028";
    	                $mail->SetFrom("$from");
    	                $mail->Subject = "NEW CHIT TO THE EB!!";
    	                $mail->Body = $body;
    		            $mail->AddAddress("$from");
    		            $mail->AddAddress("$email");
    		            if ($mail->Send()){return 1;}
}
function sendmail($email1,$email2,$body){
                        $arr = array(
                            "UNHRC"=>"unhrc.chits@gmail.com",
                            "UNGA-DISEC"=>"disec.chits@gmail.com",
                            "UNGA-ECOFIN"=>"ecofin.chits@gmail.com");
                        $from = $arr[decrypt($_COOKIE['com'])];
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
    	                $mail->Username = "$from";
    	                $mail->Password = "ChettinadVidyashram600028";
    	                $mail->SetFrom("$from");
    	                $mail->Subject = "NEW CHIT!!";
    	                $mail->Body = $body;
    		            $mail->AddAddress("$email1");
    		            $mail->AddAddress("$email2");
    		            $mail->AddAddress("$from");
    		            $mail->Send();
    		            
}
function str_rot47($str)
{
  return strtr($str, 
    '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~', 
    'PQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNO'
  );
}
function decrypt($dat){
    $data = str_rot13(str_rot47($dat));
    return $data;
}
function encrypt($dat){
    $data = str_rot47(str_rot13($dat));
    return $data;
}
function sendchit($email,$sub,$country,$msg){
    $link = new mysqli("localhost","u864523831_cvmun20","ChettinadVidyashram600028","u864523831_cvmun20");
    $a = $link->query("INSERT INTO `c".decrypt($_COOKIE['com'])."`(email,subject,message) VALUES('$email','".strtoupper($country).$sub."','$msg')");
    
}
function get_del(){
    $link = new mysqli("localhost","u864523831_cvmun20","ChettinadVidyashram600028","u864523831_cvmun20");
    $email=decrypt($_COOKIE['login']);
    $a = $link->query("SELECT name from `".decrypt($_COOKIE['com'])."` where email like '$email'");
    $r = $a->fetch_all();
    if ($r){
    return strtoupper($r[0][0]);}
    else{
        return "NULL";
    }
}
function get_email($country){
    $c = strtoupper($country);
    $link = new mysqli("localhost","u864523831_cvmun20","ChettinadVidyashram600028","u864523831_cvmun20");
    $a=$link->query("SELECT email from `".decrypt($_COOKIE['com'])."` where name like '$c'");
    $r = $a->fetch_all();
    if ($r){
    return $r[0][0];}
    else{
        return "NULL";
    }
}
if(!empty($_COOKIE["login"])){
    if (!checkmail(decrypt($_COOKIE['login']))){
    setcookie('login','',1, "/cvmun");
    setcookie('com','',1, "/cvmun");
   header('Location : /cvmun/login');}
}
else{header('Location : /cvmun/login');setcookie('login','',1, "/cvmun");setcookie('com','',1, "/cvmun");}
if(!empty($_COOKIE["com"])){
    if (!in_array(decrypt($_COOKIE['com']),array("UNHRC","UNGA-DISEC","UNGA-ECOFIN"))){
   header('Location : /cvmun/login');setcookie('login','',1, "/cvmun");setcookie('com','',1, "/cvmun");}
}
else{header('Location : /cvmun/login');setcookie('login','',1, "/cvmun");setcookie('com','',1, "/cvmun");}
$arr = array(
    "UNHRC"=>"unhrc.chits@gmail.com",
    "UNGA-DISEC"=>"disec.chits@gmail.com",
    "UNGA-ECOFIN"=>"ecofin.chits@gmail.com");
$from = $arr[decrypt($_COOKIE['com'])];
$coun = get_del();
$countries_txt="['EXECUTIVE BOARD',";
$countries_list = array("executive board");
$link = new mysqli("localhost","u864523831_cvmun20","ChettinadVidyashram600028","u864523831_cvmun20");
$a = $link->query("SELECT * from `".decrypt($_COOKIE['com'])."`");
while($r=$a->fetch_assoc()){
    if (strtoupper($r['name'])!=$coun){
        array_push($countries_list,strtolower($r['name']));
        $countries_txt.="'".strtoupper($r['name'])."',";
    }
}
$countries_txt.="]";
if (isset($_POST['submit'])){
    if (1){
    $country = strtoupper($_POST['to']);
    if ($country!="NULL" && in_array(strtolower($_POST['to']),$countries_list)){
        if ($_POST['to'] != 'EXECUTIVE BOARD' && decrypt($_COOKIE['com'])!="UNHRC"){
            $body="FROM : $coun<br>TO : ".strtoupper($_POST['to'])."<br>SUBJECT : ".$_POST['subject']."<br>MESSAGE : ".$_POST['message']."<br><br><h2><b>PLEASE REPLY TO CHITS USING REPLY ALL IN THIS MAIL THREAD</b></h2>";
            str_replace('\n',"<br>",$body);
            sendmail(get_email($_POST['to']),decrypt($_COOKIE['login']),$body);
            echo "<script>alert('Your chit has been sent');</script>";
            }
    else if(strtoupper($_POST['to']) != 'EXECUTIVE BOARD' && decrypt($_COOKIE['com'])=="UNHRC"){echo "<script>alert('Only chits to the EB are accepted');</script>";}
    else if (strtoupper($_POST['to']) == 'EXECUTIVE BOARD' || decrypt($_COOKIE['com'])=="UNHRC"){
        $body="FROM : $coun<br>TO : THE EB<br>SUBJECT : ".$_POST['subject']."<br>MESSAGE : ".$_POST['message'];
        $eb = sendtoeb(decrypt($_COOKIE['login']),$body);if ($eb){echo "<script>alert('Your chit has been sent to the EB');</script>";}}
}}
}
$ipc = 0;
?>

<!doctype html>
<html class="no-js" lang="zxx">
<noscript>
	<style>
		.root{
			display: none!important;
		}
		footer{
			display: none!important;
		}
		.location_information{
			display: none!important;
		}
	</style>
<div style="background-color: black;width: 100%;height: 100%;"><br><Br><Br><br><br><br><Br><Br><br><Br><Br><br><Br><Br><br><br><br><Br><Br><br><Br><Br>
	<center><h2 style="font-weight: 600;font-size: 40px;color: white;">It seems that you have disabled Javascript. Please enable javascript to continue</h2>
	<br><h1 style="font-weight: 600;font-size: 50px;color: #934224;">CVMUN TECH TEAM</h1>
	</center>
	</div>
</noscript>
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>CV MUN 2020</title>
  <meta name="description" content="">
  <link rel="shortcut icon" type="image/x-icon" href="/src/img/favicon.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="/src/css/bootstrap.min.css">
  <link rel="stylesheet" href="/src/css/owl.carousel.min.css">
  <link rel="stylesheet" href="/src/flip/flip.min.css">
  <link rel="stylesheet" href="/src/css/magnific-popup.css">
  <script src="js/sec-js.js"></script>
  <link rel="stylesheet" href="/src/css/font-awesome.min.css">
  <link href="/src/css/sec-style.css" rel="stylesheet">
  <link rel="stylesheet" href="/src/css/themify-icons.css">
  <link rel="stylesheet" href="/src/css/gijgo.css">
  <link rel="stylesheet" href="/src/css/gallery.css">
  <link rel="stylesheet" href="/src/css/nice-select.css">
  <link rel="stylesheet" href="/src/css/animate.css">
  <link rel="stylesheet" href="/src/css/flaticon.css">
  <link rel="stylesheet" href="/src/css/footer-area.css">
  <link rel="stylesheet" href="/src/css/slicknav.css">
  <link rel="stylesheet" href="/src/stylesheet.css">
  <link rel="stylesheet" href="/src/css/style.css">
	<link rel="stylesheet" href="/src/style.css">
</head>
<style type="text/css">
body{
  background: black;
  color: white;
  font-family: "prestageregular"!important;
}
h5{
  color: white;
  font-size: 25px;
}
p{
  color: white;
  font-size: 30px;
}
b{
  color: black!important;
  font-size: 35px;
}
a{
  font-weight: 600;
  font-size: 25px!important;
}
h4{
  font-weight: 500;
  font-size: 30px!important;
}
.table_here{
	 top: 100%!important;
}
.preloader {
   overflow: hidden;
   position:fixed;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   z-index: 9999;
   background-image: url('/src/preloader2.gif');
   background-repeat: no-repeat;
   background-color: #000;
   background-position: center;
}
html {
  --scrollbarBG: rgba(0,0,0,0);
  --thumbBG: #934224;
}
body::-webkit-scrollbar {
  width: 15px;
}
body {
  scrollbar-width: thin;
  scrollbar-color: var(--thumbBG) var(--scrollbarBG);
}
body::-webkit-scrollbar-track {
  background: var(--scrollbarBG);
}
body::-webkit-scrollbar-thumb {
  background-color: var(--thumbBG) ;
  border-radius: 30px;
}
.emsg2{
color: #F32013!important;
font-size: 20px;
}
.select-hidden {
  display: none;
  visibility: hidden;
  font-size:20px!important;
  padding-right: 10px;
}

.select {
  cursor: pointer;
  display: inline-block;
  position: relative;
  font-size: 16px;
  color: #fff;
  font-size:20px!important;
  width: 220px;
  height: 40px;
}

.select-styled {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background-color: #000;
  padding: 8px 15px;
  -moz-transition: all 0.2s ease-in;
  -o-transition: all 0.2s ease-in;
  -webkit-transition: all 0.2s ease-in;
  transition: all 0.2s ease-in;
}
.select-styled:after {
  content: "";
  width: 0;
  height: 0;
  border: 7px solid transparent;
  border-color: #fff transparent transparent transparent;
  position: absolute;
  top: 16px;
  right: 10px;
}
.select-styled:hover {
  background-color: #000;
}
.select-styled:active, .select-styled.active {
  background-color: #000;
}
.select-styled:active:after, .select-styled.active:after {
  top: 9px;
  border-color: transparent transparent #fff transparent;
}

.select-options {
  display: none;
  position: absolute;
  top: 100%;
  right: 0;
  left: 0;
  z-index: 999;
  font-size:20px!important;
  margin: 0;
  padding: 0;
  list-style: none;
  background-color: #000;
}
.select-options li {
  margin: 0;
  padding: 12px 0;
  text-indent: 15px;
  font-size:20px!important;
  border-top: 1px solid #000;
  -moz-transition: all 0.15s ease-in;
  -o-transition: all 0.15s ease-in;
  -webkit-transition: all 0.15s ease-in;
  transition: all 0.15s ease-in;
}
.select-options li:hover {
  color: #000;
  background: #fff;
  font-size:20px!important;
}
.select-options li[rel="hide"] {
  display: none;
  font-size:20px!important;
}
.autocomplete {
  position: relative;
  display: inline-block;
}

.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  top: 100%;
  left: 20%;
  width:60%;
}

.autocomplete-items div {
  padding: 1%;
  cursor: pointer;
  background-color: #000; 
  border-bottom: 1px solid #d4d4d4;
}

.autocomplete-items div:hover {
  background-color: #fff;
  color:#000;
}

.autocomplete-active {
  background-color: #fff !important; 
  color: #000; 
}

</style>
<body>
    <div class="root">
  <script>
  setTimeout(function(){
    $('.preloader').fadeOut('slow');
}, 1000);

  </script>
  <div id="preloader"></div>
  <header style='margin-bottom:150px;'>
        <div class="header-area">
            <div id="sticky-header" class="main-header-area">
                <div class="container">
                    <div class="header_bottom_border">
                        <div class="row align-items-center">
                            <div class="col-xl-2 col-lg-3">
                                <div class="logo header-comp">
                                    <a href="/">
                                        <img src="/src/img/logo.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-6">
                                <div class="main-menu  d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="/">HOME</a></li>
                                            <li><a href="/schedule/">SCHEDULE</a></li>
                                            <li><a href="/team/">OUR TEAM</a></li>
                                            <li><a href="/resources/">RESOURCES</a></li>
                                            <li><a href="/contact/">CONTACT US</a></li>
                                            <li><a href="#">REGISTER<i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="/registration/school">SCHOOL</a></li>
                                                    <li><a href="/registration/student">INDIVIDUAL</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">COMMITTEES<i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="/committees/c1">UNGA-DISEC</a></li>
                                                    <li><a href="/committees/c2">UNGA-ECOFIN</a></li>
                                                    <li><a href="/committees/c3">UNHRC</a></li>
                                                    <li><a href="/committees/c4">IPC</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="/cvmun/" style="color:#934224">ACCOUNT</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none" style="background-color: transparent!important"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
  <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel" style="max-width: 500px; max-width: 500px;margin: 0 auto;margin-bottom: 50px!important;">
              <div class="carousel-inner">
                <div class="item active">
                  <?php echo image();?>
                </div>
              </div>
          </div>
     <center><a href="/cvmun" class="boxed-btn3 wow fadeInDown" data-wow-duration="1s" data-wow-delay=".3s" style="width: 30%; font-size: 20px!important;margin-bottom:8%!important;">MAIN MENU</a></center>
			<div class="performar_area black_bg">
	        <div class="row" align="center">
	            <div class="login-box" style="margin: 0 auto;max-width:1080px;">
	                <form method="post" style="font-size: 25px!important;font-family: 'HelvNew'!important" id="chitForm" action='' autocomplete="off" onsubmit="onsub();">
	                                    <div class="autocomplete" style="width:100%;">
                                            <input id="myInput" type="text" name="to" placeholder="Enter country to send chit">
                                        </div>
										<br><br><Br>
										<input type="text" class=" wow fadeInDown" data-wow-duration="1s" data-wow-delay=".3s" name="subject" placeholder="Enter Subject" id='email' >
										<br><Br><Br><p class="contact wow fadeInDown" data-wow-duration="1s" data-wow-delay=".3s" style="font-size:25px; color: rgba(255,255,255,1);width: 60%!important;align:left;">ENTER THE MESSAGE</p><br>
	                                        <textarea
                                               rows = "5"
                                               name="message"
                                               style="resize: none;width: 60%;color: white;background: black;font-size: 25px;"  class="wow fadeInDown" data-wow-duration="1s" data-wow-delay=".3s"></textarea>
										<br><Br><Br>
											<button type="submit" value="SEND" name="submit" id="submit" class="boxed-btn3 wow fadeInDown" data-wow-duration="1s" data-wow-delay=".3s" style="width: 50%; font-size: 30px!important;margin-bottom:5%!important;">SEND</button>
	                </form>
	             </div>
	        </div>
	    </div>
	  <div id="divMsg" style="overflow: hidden;
                       position:fixed;
                       top: 0;
                       left: 0;
                       width: 100%;
                       height: 100%;
                       display: none;
                       z-index: 9999;
                       background-repeat: no-repeat;
                       background-color: rgba(0,0,0,0.6);
                       background-position: center;"></div>
    <script>
    function onsub(){
        var srcElement = document.getElementById("divMsg");
	if (srcElement != null) {
		if (srcElement.style.display == "block") {
			srcElement.style.display = 'none';
		}
		else {
			srcElement.style.display = 'block';
		}}
    }
</script>
	<script>
	    $('select').each(function(){
    var $this = $(this), numberOfOptions = $(this).children('option').length;
  
    $this.addClass('select-hidden'); 
    $this.wrap('<div class="select"></div>');
    $this.after('<div class="select-styled"></div>');

    var $styledSelect = $this.next('div.select-styled');
    $styledSelect.text($this.children('option').eq(0).text());
  
    var $list = $('<ul />', {
        'class': 'select-options'
    }).insertAfter($styledSelect);
  
    for (var i = 0; i < numberOfOptions; i++) {
        $('<li />', {
            text: $this.children('option').eq(i).text(),
            rel: $this.children('option').eq(i).val()
        }).appendTo($list);
    }
  
    var $listItems = $list.children('li');
  
    $styledSelect.click(function(e) {
        e.stopPropagation();
        $('div.select-styled.active').not(this).each(function(){
            $(this).removeClass('active').next('ul.select-options').hide();
        });
        $(this).toggleClass('active').next('ul.select-options').toggle();
    });
  
    $listItems.click(function(e) {
        e.stopPropagation();
        $styledSelect.text($(this).text()).removeClass('active');
        $this.val($(this).attr('rel'));
        $list.hide();
        //console.log($this.val());
    });
  
    $(document).click(function() {
        $styledSelect.removeClass('active');
        $list.hide();
    });

});
	</script>
	<script>
function autocomplete(inp, arr) {
  var currentFocus;
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      this.parentNode.appendChild(a);
      for (i = 0; i < arr.length; i++) {
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          b = document.createElement("DIV");
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          b.addEventListener("click", function(e) {
              inp.value = this.getElementsByTagName("input")[0].value;
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        currentFocus++;
        addActive(x);
      } else if (e.keyCode == 38) { 
        currentFocus--;
        addActive(x);
      } else if (e.keyCode == 13) {
        e.preventDefault();
        if (currentFocus > -1) {
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    if (!x) return false;
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

var countries = <?php echo $countries_txt;?>;

autocomplete(document.getElementById("myInput"), countries);
</script>
<style>
        @media (max-width: 700px) {
    .desktop-footer, .location_information{
        display:none!important;
    }
    .mobile-footer{
        display:block!important;
    }
}
/*@media (max-width: 768px) {
    .overlay2{
        background: #000!important;
    }
}*/
.single_info p:hover{
    color: #934224!important;
    text-decoration:none;
    transition: 0.3s;
    -webkit-transition: 0.3s;
    -moz-transition: 0.3s;
    -o-transition: 0.3s;
}
    </style>
    <style> 
.horiz h1 {
    overflow: hidden;
    text-align: center;
}
.horiz h1:before,
.horiz h1:after {
    background-color: #C78F28;
    content: "";
    display: inline-block;
    height: 1px;
    position: relative;
    vertical-align: middle;
    width: 50%;
}
@media (max-width:700px){
    .submit-button-mob{
        display:block!important;
    }
    .submit-button-pc{
        display: none!important;
    }
}
@media (min-width:700.01px){
    .submit-button-mob{
        display:none!important;
    }
    .submit-button-pc{
        display:block!important;
    }
}
.horiz h1:before {
    right: 0.5em;
    margin-left: -50%;
}
.horiz h1:after {
    left: 0.5em;
    margin-right: -50%;
}
.horiz img {
  height:100px;
  width:100px;
}
	</style>
<footer class="site-footer wow fadeInUp desktop-footer" data-wow-duration="1s" data-wow-delay=".4s">
      <div class="horiz">
    <h1><img src='/src/img/logo.png'></h1></div>
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <h2 style="color:#934224!important">About CVMUN</h2>
            <p class="text-justify" style="font-size:18px!important;font-family:HelvNew!important;line-height: 1.3!important;">Chettinad Vidyashram Model United Nations is an academic simulation of the United Nations where students play the role of delegates from different countries and attempt to solve real world issues with the policies and perspectives of their assigned country.</p><br><br>
            <h6 style="font-family:HelvNew!important;font-size:40%!important;color:grey!important;">Designed by Anirudh Ramesh</h6>
          </div>
          <div class="col-xs-6 col-md-3">
              <div style="padding-left:15%!important;">
              <div style="padding-left:31%!important;border-left:3px inset #C78F28!important;height:200px!important;">
                <h2 style="color:#934224!important">Connect</h2>
                <ul class="footer-links">
                  <li><a href="mailto:cvmun20@gmail.com" target="blank">mail</a></li>
                  <li><a href="https://instagram.com/cvmun2020" target="blank">Instagram</a></li>
                </ul>
            </div>
        </div>
          </div>
          <div class="col-xs-6 col-md-3">
              <div style="padding-left:-40%!important;">
              <div style="padding-left:28%!important;border-left:3px inset #C78F28!important;height:200px!important;">
            <h2 style="color:#934224!important">Quick Links</h2>
            <ul class="footer-links">
              <li><a href="/registration/school">School Registration</a></li>
              <li><a href="/registration/student">Student Registration</a></li>
              <li><a href="/cvmun/">Account</a></li>
              <li><a href="/resources/">Resources</a></li>
              <li><a href="/schedule/">Schedule</a></li>
            </ul>
          </div>
          </div>
          </div>
        </div>
      </div>
</footer>
<footer class="site-footer wow fadeInUp mobile-footer" style="display:none;" data-wow-duration="1s" data-wow-delay=".4s">
    <div class="horiz">
    <h1><img src='/src/img/logo.png'></h1></div>
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <h2 style="color:#934224!important">About CVMUN</h2>
            <p class="text-justify" style="font-size:18px!important;font-family:HelvNew!important;line-height: 1.3!important;">Chettinad Vidyashram Model United Nations is an academic simulation of the United Nations where students play the role of delegates from different countries and attempt to solve real world issues with the policies and perspectives of their assigned country.</p>
          </div>
          <div class="col-xs-6 col-md-3">
                <h2 style="color:#934224!important">Connect</h2>
                <ul class="footer-links">
                  <li><a href="mailto:cvmun20@gmail.com" target="blank">cvmun20@gmail.com</a></li>
                  <li><a href="https://instagram.com/cvmun2020" target="blank">Instagram</a></li>
                </ul>
            </div>
          <div class="col-xs-6 col-md-3">
            <h2 style="color:#934224!important">Quick Links</h2>
            <ul class="footer-links">
              <li><a href="/registration/school">School Registration</a></li>
              <li><a href="/registration/student">Student Registration</a></li>
              <li><a href="/cvmun/">Account</a></li>
              <li><a href="/resources/">Resources</a></li>
              <li><a href="/schedule/">Schedule</a></li>
            </ul>
            <h6 style="font-family:HelvNew!important;font-size:40%!important;color:grey!important;">Designed by Anirudh Ramesh</h6>
          </div>
          </div>
          </div>
</footer>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="/src/js/gallery.js"></script>
    <script src="/src/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="/src/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="/src/js/popper.min.js"></script>
    <script src="/src/js/bootstrap.min.js"></script>
    <script src="/src/js/owl.carousel.min.js"></script>
    <script src="/src/js/isotope.pkgd.min.js"></script>
    <script src="/src/js/ajax-form.js"></script>
    <script src="/src/js/waypoints.min.js"></script>
    <script src="/src/js/jquery.counterup.min.js"></script>
    <script src="/src/js/imagesloaded.pkgd.min.js"></script>
    <script src="/src/js/scrollIt.js"></script>
    <script src="/src/js/jquery.scrollUp.min.js"></script>
    <script src="/src/js/wow.min.js"></script>
    <script src="/src/js/gijgo.min.js"></script>
    <script src="/src/js/nice-select.min.js"></script>
    <script src="/src/js/jquery.slicknav.min.js"></script>
    <script src="/src/js/jquery.magnific-popup.min.js"></script>
    <script src="/src/js/tilt.jquery.js"></script>
    <script src="/src/js/plugins.js"></script>
    <script src="/src/js/contact.js"></script>
    <script src="/src/js/jquery.ajaxchimp.min.js"></script>
    <script src="/src/js/jquery.form.js"></script>
    <script src="/src/js/jquery.validate.min.js"></script>
    <script src="/src/js/mail-script.js"></script>
    <script src="/src/js/main.js"></script>
    </div>

</body>
</html>
