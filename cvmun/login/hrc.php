<?php
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
#echo checkmail('anirudhnfs01@gmail.com');