<?php
session_start();
function str_rot47($str)
{
  return strtr($str, 
    '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~', 
    'PQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNO'
  );
}
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
function decrypt($dat){
    $data = str_rot13(str_rot47($dat));
    return $data;
}
function encrypt($dat){
    $data = str_rot47(str_rot13($dat));
    return $data;
}
function get_comm($email){
    $com = array("UNGA-DISEC","UNGA-ECOFIN","UNHRC");
    $link = new mysqli("localhost","u864523831_cvmun20","ChettinadVidyashram600028","u864523831_cvmun20");
    foreach($com as $c){
    	$a = $link->query("SELECT COUNT(*) FROM `".$c."` where email LIKE '$email'");
    	$row = $a->fetch_assoc();
        if ($row['COUNT(*)']){return $c;}
    }
    return "no";
	
}
#setcookie('login',encrypt("aswathrock2003@gmail.com"), time() + (86400 * 3), "/cvmun");
#setcookie('com',encrypt("UNGA-DISEC"), time() + (86400 * 3), "/cvmun");
#$_SESSION['already']=1;header('Location:result/');
echo encrypt(md5("moortheswaran"));
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