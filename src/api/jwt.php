<?php

function add ($email,$fn,$id){    
    $curl = curl_init();
    $meetid = $id;
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.zoom.us/v2/meetings/$meetid/registrants",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "{\"email\":\"$email\",\"first_name\":\"$fn\",\"last_name\":\" \"}",
      CURLOPT_HTTPHEADER => array(
        "authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJhdWQiOm51bGwsImlzcyI6Im45THlkSEEzUmoycHRTSm8xeU1uVFEiLCJleHAiOjE2MDk0ODI2MDAsImlhdCI6MTYwNTk4Njg5N30.oNjD5gbVladalTPeBqjI95oyUuZ-J0r5xDstlcfEzBg",
        "content-type: application/json"
      ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      try{
          $ar1 = explode(',',$response);
          $l = explode('"',$ar1[4]);
          $link = $l[3];
          echo $link;
      }
      catch (Exception $e){
          echo "Please use an email registered with zoom";
      }
    }
}
if(isset($_POST['submit'])){add($_POST['email'],$_POST['fn'],"83944768972");}
?>
<html>
<form method='post' action=''>
<input type="text" name="fn" placeholder="first name">
<input type="mail" name="email" placeholder="enter zoom mail id">
<input type="submit" name="submit">
</form>
