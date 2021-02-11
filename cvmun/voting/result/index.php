<?php
session_start();

$txt='';
function get_roll(){
    $link = new mysqli("localhost","u864523831_cvmun20","ChettinadVidyashram600028","u864523831_cvmun20");
    $email=decrypt($_COOKIE['login']);
    $a = $link->query("SELECT rollcall FROM `".decrypt($_COOKIE['com'])."` where email like '$email'");
    $r = $a->fetch_all();
    if ($r[0][0]){
        return 1;
    }
    else{
        return 0;
    }
}
if (!get_roll()){header('Location : /cvmun/roll_call');}
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
$not=1;
while (1){
    try{
    if (1){
        if ($_SESSION['end']){
            $txt = "VOTING HAS ENDED";
            break;
        }}}
    catch(Exception $e){}
    try{
    if (1){
        if ($_SESSION['voted']){
            $txt = "YOUR VOTE HAS BEEN REGISTERED";
            break;
        }}}
    catch(Exception $e){}
    try{
    if (1){
        if ($_SESSION['already']){
            $txt = "YOU HAVE ALREADY VOTED";
            break;
        }}}
    catch(Exception $e){}
    try{
    if (1){
        if ($_SESSION['obs']){
            $txt = "OBSERVER NATIONS ARE NOT ALLOWED TO VOTE FOR THE CURRENT MOTION";
            break;
        }}}
    catch(Exception $e){}
    header('Location : /cvmun');
}
$c=1;
$final=<<<'EOT'
<h3 class="single-heading wow fadeInRight" data-wow-duration="1s" data-wow-delay=".4s">RESULT</h3>
EOT;
$e=<<<'EOT'
<h3 class="single-heading wow fadeInRight" data-wow-duration="1s" data-wow-delay=".4s">VOTES</h3>
<table class="table table-dark" style="width:50%!important;max-width:720px;margin-top:50px!important;font-size:30px!important;background:#000!important;">
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">COUNTRY</th>
	      <th scope="col">VOTE</th>
	    </tr>
	  </thead>
	  <tbody>
EOT;
if($c==1){
	$link = new mysqli("localhost","u864523831_cvmun20","ChettinadVidyashram600028","u864523831_cvmun20");
	$sql = "SELECT * FROM `v".decrypt($_COOKIE['com'])."`";
	$result = $link->query($sql);
	$for=0;
	$against=0;
	$abstain=0;
	$start = 0;
	$vote_result='';
	$minutes = 0;
	if ($result != ''){
		while($row = $result->fetch_assoc()) {
			if ($row['vote']=='FOR'){
				$for = $for + 1;
			}
			if ($row['vote']=='AGAINST'){
				$against = $against + 1;
			}
			if ($row['vote']=='ABSTAIN'){
				$abstain = $abstain+1;
			}
	  }}
	
	$sql = "SELECT * FROM `ebv".decrypt($_COOKIE['com'])."`";
	$result = $link->query($sql);
	if ($result){
		while($row = $result->fetch_assoc()) {
			$motion = $row['motion'];
			$name = $row['name'];
			$type = $row['type'];
			$minutes = $row['minutes'];
	  }
	}
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
$ipc = 0;
$co = get_del();
$wp = array("REPORTER","CARTOONIST");
if (strpos($co,"(IPC)") !== false or in_array($co,$wp)){header('Location : /cvmun');}
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
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Vote', 'Number of votes'],
          ['For',<?php echo $for;?>],
          ['Against',<?php echo $against;?>],
          ['Abstain',<?php echo $abstain;?>]
        ]);

        var options = {
					pieHole: 0.5,
					backgroundColor: 'black',
				legend:'none',
				slices: {
            0: { color: 'green' },
            1: { color: 'red' },
						2: { color: 'blue' }
          }
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
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
  <link rel="stylesheet" href="/src/css/footer-area.css">
  <link rel="stylesheet" href="/src/css/magnific-popup.css">
  <script src="/src/js/sec-js.js"></script>
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
.chart{
    width: 100%;
    height:60%;
}
@media (max-width:700px){
    .submit-button{
        width:60%!important;
    }
    .chart{
        width:100%!important;
    }
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
  <header style='margin-bottom:200px;'>
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
        <div class="container">
                    <div class="row align-items-center justify-content-center">
                       <div class="col-xl-12">
                          <div class="text-center">
                                <h3 class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".3s" style="font-family:'prestageregular';
                                font-weight: 400;
                                font-size: 40px;
                                letter-spacing: 10px;color:#fff!important;"><?php echo $txt;?><br><br></h3>
                          </div>
                       </div>
                    </div>
              </div>
              
	<center><?php
			    $total=$for+$against+$abstain;
			    if ($total>0){
        			 if ($type=='PROCEDURAL VOTE'){
        		        if ($for>round(0.5*$total) ){
        		            $vote_result='PASSED';
        		        }
        		        else if ($against>=$for){
        		            $vote_result='FAILED';
        		        }
        		        else{
        		            $vote_result='FAILED';
        		        }
        			 }
        			 if ($type=='SUBSTANTIVE VOTE' && $vote_result!='FAILED'){
        			    if ($for >= round(2*$total/3)){
        			        $vote_result='PASSED';
        			    }
        			    else if ($against >= $for){
        			        $vote_result='FAILED';
        			    }
        			    else{
        		            $vote_result='FAILED';
        		        }
        			 }
        			 if ($vote_result=='PASSED'){
        			     $color='green';
        			 }
        			 if($vote_result=='FAILED'){
        			     $color='red';
        			 }
        			 echo '<h3 class="single-heading wow fadeInRight" data-wow-duration="1s" data-wow-delay=".4s">RESULT</h3><h3 class="single-heading wow fadeInRight" data-wow-duration="1s" data-wow-delay=".4s" style="color:'.$color.'!important;">'.$vote_result.'</h3><br><Br><br><Br>';}
			 ?>
			 <div align="center"><a href="/cvmun" target="_top" style="color:white" class="boxed-btn3 wow fadeInDown" data-wow-duration="1s" data-wow-delay=".3s">MAIN MENU</a><br><br><br></div>
			<div id="table"><?php
			$s="SELECT * FROM `v".decrypt($_COOKIE['com'])."`";
			$r=$link->query($s);
			$counts=1;
			$for=0;
        	$against=0;
        	$abstain=0;
			if ($r != ''){
		        while($row = $r->fetch_assoc()){
		            $d="<tr><th scope='row'>".$counts."</th><td>".$row['name']."</td><td>".$row['vote']."</td></tr>";
		            $e=$e.$d;
		            $counts=$counts+1;
		        }
		    $e=$e."</tbody></table></div>";
		    $def='<div id="piechart" class="chart" style="width: 100%; height: 500px;background:#000!important;"></div>';
			echo $e.$def;
			}
			?>
</div></center>	
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
