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
function ended(){
    $link = new mysqli("localhost","u864523831_cvmun20","ChettinadVidyashram600028","u864523831_cvmun20");
    $sql = "SELECT end FROM `ebv".decrypt($_COOKIE['com'])."`";
	$result = $link->query($sql);
	if ($result->num_rows>0){
		while($row = $result->fetch_assoc()) {
			if ($row['end'] == "yes"){return 1;}
			else{return 0;}
	  }
	}
}
function str_rot47($str)
{
  return strtr($str, 
    '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~', 
    'PQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNO'
  );
}
function image(){
    $img = array(
    "UNGA-DISEC"=>'<img src="/src/img/committee/disec.png">',
    "UNGA-ECOFIN"=>'<img src="/src/img/committee/ecofin.png">',
    "UNHRC"=>'<img src="/src/img/committee/unhrc.png">',
        );
    return $img[decrypt($_COOKIE['com'])];
}
function decrypt($dat){
    $data = str_rot13(str_rot47($dat));
    return $data;}
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
function get_del(){
    $email = decrypt($_COOKIE['login']);
    $comm = decrypt($_COOKIE['com']);
    $link = new mysqli("localhost","u864523831_cvmun20","ChettinadVidyashram600028","u864523831_cvmun20");
    $r = $link->query("SELECT name FROM `".$comm."` WHERE email LIKE '".$email."'");
    $res = $r->fetch_assoc();
    return $res["name"];
}
 if(!empty($_COOKIE["login"])){
    if (!checkmail(decrypt($_COOKIE['login']))){
    setcookie('login','',1, "/cvmun");
    setcookie('com','',1, "/cvmun");
   header('Location : /cvmun/login');
   }
}
else{header('Location : /cvmun/login');setcookie('login','',1, "/cvmun");setcookie('com','',1, "/cvmun");}
if(!empty($_COOKIE["com"])){
    if (!in_array(decrypt($_COOKIE['com']),array("UNHRC","UNGA-DISEC","UNGA-ECOFIN"))){
   header('Location : /cvmun/login');setcookie('login','',1, "/cvmun");setcookie('com','',1, "/cvmun");}
}
else{header('Location : /cvmun/login');setcookie('login','',1, "/cvmun");setcookie('com','',1, "/cvmun");}
$name2 = get_del();
$link = new mysqli("localhost","u864523831_cvmun20","ChettinadVidyashram600028","u864523831_cvmun20");
$sql = "SELECT COUNT(*) FROM `v".decrypt($_COOKIE['com'])."` WHERE name LIKE '$name2'";
$result = $link->query($sql);
$r = $result->fetch_assoc();
if ($r['COUNT(*)']){$_SESSION['already']=1;header('Location:result/');}
function pandv(){
    $link = new mysqli("localhost","u864523831_cvmun20","ChettinadVidyashram600028","u864523831_cvmun20");
	$sql = "SELECT COUNT(*) FROM `".decrypt($_COOKIE['com'])."` WHERE email LIKE '".decrypt($_COOKIE['login'])."' AND rollcall LIKE 'PRESENT'";
	$result = $link->query($sql);
	$row = $result->fetch_assoc();
	$tres = $link->query("SELECT COUNT(*) FROM `ebv".decrypt($_COOKIE['com'])."` WHERE type NOT LIKE 'PROCEDURAL%'");
	$res = $tres->fetch_assoc();
    if($row["COUNT(*)"] && $res["COUNT(*)"]){return 1;}
    else{return 0;}
}
$c=1;
$sub3 = <<<EOT
<button value="ABSTAIN" type="submit" name="submit3" id="submit3" class="boxed-btn3 wow fadeInDown submit-button" data-wow-duration="1s" data-wow-delay=".3s" style="width: 20%!important; font-size: 30px!important;margin-bottom:5%!important;">ABSTAIN</button>
EOT;
$sub4 = <<<EOT
<button value="ABSTAIN" type="submit" name="submit3" id="submit3" class="boxed-btn3 wow fadeInDown submit-button" data-wow-duration="1s" data-wow-delay=".3s" style="width: 60%!important; font-size: 30px!important;margin-bottom:5%!important;">ABSTAIN</button>
EOT;
$final=<<<'EOT'
<h3 class="single-heading headings wow fadeInRight" data-wow-duration="1s" data-wow-delay=".4s">RESULT</h3>
EOT;
$e=<<<'EOT'
<h3 class="single-heading headings wow fadeInRight" data-wow-duration="1s" data-wow-delay=".4s">VOTES</h3>
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
	$vote_result='';
	$abstain=0;
	$start = 0;
	$minutes = 0;
	if ($result->num_rows>0 && $result != ''){
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
	$motion='';
	$name='';
	$type='';
	$start='';
	$counts=0;
	$minutes=0;
	$totalt='';
	$sql = "SELECT COUNT(*) FROM `ebv".decrypt($_COOKIE['com'])."`";
	$result = $link->query($sql);
	$res = $result->fetch_assoc();
	if (!$res['COUNT(*)']){$_SESSION['notyet']=1;header('Location:notyet/?s='.urlencode(md5(otp())));}
	$sql = "SELECT * FROM `ebv".decrypt($_COOKIE['com'])."`";
	$result = $link->query($sql);
	if ($result->num_rows>0){
		while($row = $result->fetch_assoc()) {
			$motion = $row['motion'];
			$name = $row['name'];
			$type = $row['type'];
			$end = $row['end'];
			$minutes = (int)$row['minutes'];
			$totalt=(int)$row['totalt'];
	  }
	}
	if ($type != "PROCEDURAL VOTE" && substr($name2,-3) == "(O)"){
	    $_SESSION['obs']=1;header('Location:result/');
	}
	$sql = "SELECT * FROM `".decrypt($_COOKIE['com'])."`";
	$result = $link->query($sql);
	if ($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			$counts=$counts+1;
	  }
	}
	if ($end == "yes"){
	    $_SESSION['end']=1;header('Location:result/');
	}
	$indiv=round($totalt/$counts,1);
	$suffix=' MINUTES';
	$in=$indiv.$suffix;
}
if ($_POST && !ended()){
    $db = decrypt($_COOKIE['com']);
    if (isset($_POST['submit1'])){$link = new mysqli("localhost","u864523831_cvmun20","ChettinadVidyashram600028","u864523831_cvmun20");$sql="INSERT INTO `v".$db."`(name,vote) VALUES('$name2','FOR')";$link->query($sql);$_SESSION['voted']=1;header('Location:result/');}
    if (isset($_POST['submit2'])){$link = new mysqli("localhost","u864523831_cvmun20","ChettinadVidyashram600028","u864523831_cvmun20");$sql="INSERT INTO `v".$db."`(name,vote) VALUES('$name2','AGAINST')";$link->query($sql);$_SESSION['voted']=1;header('Location:result/');}
    if (isset($_POST['submit3']) && pandv()){$link = new mysqli("localhost","u864523831_cvmun20","ChettinadVidyashram600028","u864523831_cvmun20");$sql="INSERT INTO `v".$db."`(name,vote) VALUES('$name2','ABSTAIN')";$link->query($sql);$_SESSION['voted']=1;header('Location:result/');}}
else if (ended()){$_SESSION['end']=1;header('Location:result/');}
#else{$_SESSION['voted']=1;header('Location:result/');}
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
  <link rel="stylesheet" href="/src/css/footer-area.css">
  <link rel="stylesheet" href="/src/css/owl.carousel.min.css">
  <link rel="stylesheet" href="/src/flip/flip.min.css">
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
  color: white!important;
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
.chart{
    width: 100%;
    height:60%;
}
.headings{
    font-size:50px!important;
}
@media (max-width:700px){
    .submit-button-mob{
        display:block!important;
    }
    .submit-button-pc{
        display: none!important;
    }
    .chart{
        width:100%!important;
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
.emsg{
color: #ff5e13!important;
font-size: 25px;
}
button:disabled{
    background:#dddddd!important;
}
button:disabled:hover{
    background:#dddddd!important;
    border:#dddddd!important;
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
		  <?php if ($name){echo '<h3 class="single-heading headings wow fadeInRight" data-wow-duration="1s" data-wow-delay=".4s">'.$name.'</h3>';}?>
		 <?php echo '<br><br><br><h4 class="single-heading headings wow fadeInRight" data-wow-duration="1s" data-wow-delay=".4s">'.$type.'</h4>';?>
		 <?php if ($totalt){echo '<br><br><br>
		 <h3 class="single-heading headings wow fadeInRight" data-wow-duration="1s" data-wow-delay=".4s">TOTAL SPEAKERS` TIME</h3>';}?>
		 <?php if ($totalt){echo '<br><br><br><h4 class="single-heading wow fadeInRight" data-wow-duration="1s" data-wow-delay=".4s">'.$totalt.' MINUTES</h4>';}?>
		 <?php if ($minutes){ echo '<br><br><br>
		 <h3 class="single-heading wow headings fadeInRight" data-wow-duration="1s" data-wow-delay=".4s">INDIVIDUAL SPEAKER`S TIME</h3>';}?>
		 <?php if ($minutes){echo '<br><br><br><h4 class="single-heading wow fadeInRight" data-wow-duration="1s" data-wow-delay=".4s">'.$minutes.' MINUTES</h4>';}?>
    <?php if($motion){echo '<center><p class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".4s" style="margin-top: 10%;">'.$motion.'</p></center>';}?>
    <br><BR><Br>
			<div class="performar_area black_bg">
	        <div class="row" align="center">
	            <div class="login-box" style="margin: 0 auto;max-width:1080px;">
	                <form method="post" style="font-size: 25px!important;font-family: 'Monopoly'!important;" id="VoteForm" action='' onsubmit="onsub();">
										<b><p class="emsg" id="emsg"></p></b><br>
	                    <div class="submit-button-pc"><button type="submit" value="FOR" name="submit1" id="submit1" class="boxed-btn3 wow fadeInDown submit-button" data-wow-duration="1s" data-wow-delay=".3s" style="width: 20%!important; font-size: 30px!important;margin-bottom:5%!important;">FOR</button>
											<button type="submit" value="AGAINST" name="submit2" id="submit2" class="boxed-btn3 wow fadeInDown submit-button" data-wow-duration="1s" data-wow-delay=".3s" style="width:20%!important; font-size: 30px!important;margin-bottom:5%!important;">AGAINST</button>
											<?php if (pandv()){echo $sub3;}?></div>
						<div class="submit-button-mob"><button type="submit" value="FOR" name="submit1" id="submit1" class="boxed-btn3 wow fadeInDown submit-button" data-wow-duration="1s" data-wow-delay=".3s" style="width: 60%!important; font-size: 30px!important;margin-bottom:5%!important;">FOR</button><br>
											<button type="submit" value="AGAINST" name="submit2" id="submit2" class="boxed-btn3 wow fadeInDown submit-button" data-wow-duration="1s" data-wow-delay=".3s" style="width:60%!important; font-size: 30px!important;margin-bottom:5%!important;">AGAINST</button><br>
											<?php if (pandv()){echo $sub4;}?></div>
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
			<center>
			 <?php
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
        			 if ($type=='SUBSTANTIVE VOTE'){
        			     $total=$total-$abstain;
        			    if ($for >= round(2*$total/3)){
        			        $vote_result='PASSED';
        			    }
        			    else if ($against>=$for){
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
        			 echo '<h3 class="single-heading headings wow fadeInRight" data-wow-duration="1s" data-wow-delay=".4s">RESULT</h3><h3 class="single-heading wow fadeInRight" data-wow-duration="1s" data-wow-delay=".4s" style="color:'.$color.'!important;">'.$vote_result.'</h3><br><Br><br><Br>';}
			 ?>
			 <div align="center"><a href="/cvmun" target="_top" style="color:white" class="boxed-btn3 wow fadeInDown" data-wow-duration="1s" data-wow-delay=".3s">MAIN MENU</a><br><br><br></div>
			<div id="table">
			<?php
			$s="SELECT * FROM `v".decrypt($_COOKIE['com'])."`";
			$r=$link->query($s);
			$counts=1;
			$for=0;
        	$against=0;
        	$abstain=0;
			if ($r->num_rows>0 && $r != ''){
		        while($row = $r->fetch_assoc()){
		            $d="<tr><th scope='row'>".$counts."</th><td>".$row['name']."</td><td>".$row['vote']."</td></tr>";
		            $e=$e.$d;
		            $counts=$counts+1;
		        }
		    $e=$e."</tbody></table></div>";
		    $def='<div class="chart" id="piechart" style="width: 100%; height: 500px;background:#000!important;"></div>';
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
