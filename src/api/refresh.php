<?php

require_once "tokens.php";

#aDBiN1hqb2lRcmFMa0M5NTk1dk8zdzpISW0zYmlUNkRWSzl4S2lmamRUcjY0aFRCY3hycWdzUQ==
$tokens = new DB();
$ref = $tokens -> get_ref_token();

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://zoom.us/oauth/token",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "grant_type: authorization_code",
    "code: $ref",
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
  $tokens -> put_ref_token($reponse['refresh_token']);
  $tokens -> put_access_token($response['access_token']);
}