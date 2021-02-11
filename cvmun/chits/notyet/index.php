<?php
session_start();
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
function image(){
    $img = array(
    "UNGA-DISEC"=>'<img src="/src/img/committee/disec.png">',
    "UNGA-ECOFIN"=>'<img src="/src/img/committee/ecofin.png">',
    "UNHRC"=>'<img src="/src/img/committee/unhrc.png">',
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
if(!isset($_COOKIE['login']) && checkmail(decrypt($_COOKIE['login'])) && !isset($_COOKIE['com'])){
   header('Location : /cvmun/login/');
}
if (empty($_GET['s']) || empty($_SESSION['notyet']) || !$_SESSION['notyet']){
    header('Location : /cvmun');
}
else{
    $_SESSION['notyet']=0;
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
</style>
<body>
    <div class="root">
  <script>
  setTimeout(function(){
    $('.preloader').fadeOut('slow');
}, 1000);

  </script>
  <div class="preloader"></div>
    <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel" style="max-width: 500px; max-width: 500px;margin: 0 auto;margin-bottom: 50px!important;">
              <div class="carousel-inner">
                <div class="item active">
                  <?php echo image();?>
                </div>
              </div>
          </div>
        <div class="container">
                    <div class="row align-items-center justify-content-center">
                       <div class="col-xl-12">
                          <div class="text-center">
                                <h3 class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".3s" style="font-family:'prestageregular';
                                font-weight: 400;
                                font-size: 40px;
                                letter-spacing: 10px;color:#fff!important;">Chit system has not been initiated yet<br><br></h3>
                          </div>
                       </div>
                    </div>
              </div>
     <br>
     <div align="center"><a href="/cvmun" target="_top" style="color:white" class="boxed-btn3 wow fadeInDown" data-wow-duration="1s" data-wow-delay=".3s">MAIN MENU</a><br><br><br></div>
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
