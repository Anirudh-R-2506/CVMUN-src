<?php
$co = get_del();
$wp = array("REPORTER","CARTOONIST");
if (strpos($co,"(IPC)") !== false || in_array($co,$wp)){header('Location : /cvmun');}
function image(){
    $img = array(
    "UNGA-DISEC"=>'<img src="/src/img/committee/disec.png" height="500" width="500">',
    "UNGA-ECOFIN"=>'<img src="/src/img/committee/ecofin.png" height="500" width="500">',
    "UNHRC"=>'<img src="/src/img/committee/unhrc.png" height="500" width="500">',
        );
    return $img[decrypt($_COOKIE['com'])];
}
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
function given($email,$com){
    $link = new mysqli("localhost","u864523831_cvmun20","ChettinadVidyashram600028","u864523831_cvmun20");
    if(1){
    	$a = $link->query("SELECT COUNT(*) FROM `".$com."` where email LIKE '$email' AND rollcall NOT LIKE ''");
    	$row = $a->fetch_assoc();
        if ($row['COUNT(*)']){return 1;}
    }
    return 0;
	
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


function started($com){
    $link = new mysqli("localhost","u864523831_cvmun20","ChettinadVidyashram600028","u864523831_cvmun20");
	$a = $link->query("SELECT COUNT(*) FROM rollcall where committee LIKE '$com' AND started LIKE 'yes'");
	$row = $a->fetch_assoc();
    if($row["COUNT(*)"]){return 1;}
    else{return 0;}
}
if (isset($_POST['submit1'])){
    $email = decrypt($_COOKIE['login']);
    $link = new mysqli("localhost","u864523831_cvmun20","ChettinadVidyashram600028","u864523831_cvmun20");
	$a = $link->query("UPDATE `".decrypt($_COOKIE['com'])."` SET `rollcall`='PRESENT' WHERE `email` LIKE '$email'");
}
if (isset($_POST['submit2']) && substr(get_del(),-3) != "(O)"){
    $email = decrypt($_COOKIE['login']);
    $link = new mysqli("localhost","u864523831_cvmun20","ChettinadVidyashram600028","u864523831_cvmun20");
	$a = $link->query("UPDATE `".decrypt($_COOKIE['com'])."` SET `rollcall`='PRESENT & VOTING' WHERE `email` LIKE '$email'");
}
function get_del(){
    $email = decrypt($_COOKIE['login']);
    $comm = decrypt($_COOKIE['com']);
    $link = new mysqli("localhost","u864523831_cvmun20","ChettinadVidyashram600028","u864523831_cvmun20");
    $r = $link->query("SELECT name FROM `".$comm."` WHERE email LIKE '".$email."'");
    $res = $r->fetch_assoc();
    return $res["name"];
}
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
    <!--<link rel="shortcut icon" type="image/x-icon" href="/src/imgs/favicon.png">-->
    <link rel="stylesheet" href="/src/css/bootstrap.min.css">
    <link rel="stylesheet" href="/src/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/src/css/footer-area.css">
    <link rel="stylesheet" href="/src/css/magnific-popup.css">
    <link rel="stylesheet" href="/src/css/font-awesome.min.css">
    <link rel="stylesheet" href="/src/css/themify-icons.css">
    <link rel="stylesheet" href="/src/css/gijgo.css">
    <link rel="stylesheet" href="/src/css/footer-area.css">
    <link rel="stylesheet" href="/src/css/nice-select.css">
    <link rel="stylesheet" href="/src/css/animate.css">
    <link rel="stylesheet" href="/src/css/flaticon.css">
    <link rel="stylesheet" href="/src/css/slicknav.css">
    <link rel="stylesheet" href="/src/css/gallery.css">
    <link rel="stylesheet" href="/src/css/style.css">
    <link rel="stylesheet" href="/src/stylesheet.css" type="text/css" charset="utf-8">
    <link rel="stylesheet" href="/src/magnific-popup.css">
    <link rel="stylesheet" href="/src/-style.css">
    <script src="/src/jquery-1.11.3.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<style type="text/css">
body{
  background: black;
  color: white;
  font-family: "prestageregular"!important;
}
a{
  font-weight: 600;
  font-size: 25px!important;
}
h4{
  font-weight: 500;
  font-size: 30px!important;
}
@media (max-width: 550px){
    .sub-head {
        font-size:40px!important;
    }
    .main-head{
        font-size:55px!important;
    }
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
</style>
<body><div class="root">
  <script>
  setTimeout(function(){
    $('.preloader').fadeOut('slow');
}, 1000);

  </script>
  <div class="preloader"></div>
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
<?php
$dat2 = <<<BTF
<div class="slider_text text-center mb-80" align="center">
        <h3 class="single-heading sub-head wow fadeInRight" data-wow-duration="1s" data-wow-delay=".4s">ROLL CALL GIVEN</h3>
    </div>
BTF;
$dat3 = <<<BTF
<div class="slider_text text-center mb-80" align="center">
        <h3 class="single-heading sub-head wow fadeInRight" data-wow-duration="1s" data-wow-delay=".4s">ROLL CALL HAS NOT STARTED YET</h3>
    </div>
BTF;
$dat11 = <<<BTR
<div class="slider_text text-center mb-80" align="center">
        <h3 class="single-heading sub-head wow fadeInRight" data-wow-duration="1s" data-wow-delay=".4s">ROLL CALL</h3>
    </div>
<div class="login-box" style="margin: 0 auto;max-width:1080px;" align="center">
    <form method="post" style="font-size: 25px!important;font-family: 'Monopoly'!important;" id="RollForm" action='' onsubmit="onsub();">
										<b><p class="emsg" id="emsg"></p></b><br>
	                    <div class="submit-button-pc"><button type="submit" value="PRESENT" name="submit1" id="submit1" class="boxed-btn3 wow fadeInDown submit-button" data-wow-duration="1s" data-wow-delay=".3s" style="width: 30%!important; font-size: 30px!important;margin-bottom:5%!important;margin-right:5%!important;">PRESENT</button>
BTR;
$dat12 = <<<EOT
<div class="submit-button-mob"><button type="submit" value="PRESENT" name="submit1" id="submit1" class="boxed-btn3 wow fadeInDown submit-button" data-wow-duration="1s" data-wow-delay=".3s" style="width: 60%!important; font-size: 30px!important;margin-bottom:5%!important;">PRESENT</button><br>
EOT;
$mid1 = <<<BTR
<button type="submit" value="PRESENT & VOTING" name="submit2" id="submit2" class="boxed-btn3 wow fadeInDown submit-button" data-wow-duration="1s" data-wow-delay=".3s" style="width:30%!important; font-size: 30px!important;margin-bottom:5%!important;">PRESENT & VOTING</button></div>
BTR;
$mid2 = <<<BTR
<button type="submit" value="PRESENT & VOTING" name="submit2" id="submit2" class="boxed-btn3 wow fadeInDown submit-button" data-wow-duration="1s" data-wow-delay=".3s" style="width:60%!important; font-size: 30px!important;margin-bottom:5%!important;">PRESENT & VOTING</button><br></div>
BTR;
if (started(decrypt($_COOKIE['com']))){
    if (given(decrypt($_COOKIE['login']),decrypt($_COOKIE['com']))){echo $dat2;}
    else{
        if (substr(get_del(),-3)=="(O)"){echo $dat11.$dat12."</form></div>";}
        else{echo $dat11.$mid1.$dat12.$mid2."</form></div>";}
    }
    
}
else{echo $dat3;}
?>
<div align="center"><a href="/cvmun" target="_top" style="color:white" class="boxed-btn3 wow fadeInDown" data-wow-duration="1s" data-wow-delay=".3s">MAIN MENU</a><br><br></div>
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
            <h6 style="font-family:HelvNew!important;font-size:70%!important;color:grey!important;">Designed by Anirudh Ramesh</h6>
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
            <h6 style="font-family:HelvNew!important;font-size:70%!important;color:grey!important;">Designed by Anirudh Ramesh</h6>
          </div>
          </div>
          </div>
</footer>
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