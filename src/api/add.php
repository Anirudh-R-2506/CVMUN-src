<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.zoom.us/v2/meetings/82277118460/registrants",#meeting ID
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"email\":\"myemail@mycompany.com\",\"first_name\":\"Mike\",\"last_name\":\"Brown\",\"address\":\"123 Main ST\",\"city\":\"San Jose\",\"country\":\"US\",\"zip\":\"95550\",\"state\":\"CA\",\"phone\":\"111-444-4444\",\"industry\":\"Tech\",\"org\":\"IT\",\"job_title\":\"DA\",\"purchasing_time_frame\":\"More Than 6 Months\",\"role_in_purchase_process\":\"Influencer\",\"no_of_employees\":\"1-20\",\"comments\":\"Excited to host you.\",\"custom_questions\":[{\"title\":\"Favorite thing about Zoom\",\"value\":\"Meet Happy\"}]}",
  CURLOPT_HTTPHEADER => array(
    "authorization: Bearer eyJhbGciOiJIUzUxMiIsInYiOiIyLjAiLCJraWQiOiJiMmUwYzhlMC0wMTcwLTQwOTktODdkNi0xMzE2YjNiYWVmYTcifQ.eyJ2ZXIiOjcsImF1aWQiOiI3YzFiODYyNDBlYzM0ZWRmZDQ3ZWE1ZmIwODgxNzNkMyIsImNvZGUiOiJDSW9sOW9LcjNGX2lGQ2U3WG5tUTg2ajJ4T2ZldlJNQWciLCJpc3MiOiJ6bTpjaWQ6aDBiN1hqb2lRcmFMa0M5NTk1dk8zdyIsImdubyI6MCwidHlwZSI6MCwidGlkIjowLCJhdWQiOiJodHRwczovL29hdXRoLnpvb20udXMiLCJ1aWQiOiJpRkNlN1hubVE4NmoyeE9mZXZSTUFnIiwibmJmIjoxNjA1OTc5MDY2LCJleHAiOjE2MDU5ODI2NjYsImlhdCI6MTYwNTk3OTA2NiwiYWlkIjoicG50T19oemxRN09kdU9BaV9vejZMUSIsImp0aSI6IjFiOTM2YTJjLWUyZjMtNDNmMC1iMmQ0LWE0Y2U1YmFmMDAyZiJ9.jxaK0p7izmizgZx9h2QK3unp8ejL8mxMsSxaxyrnkdeWUqZvZe8GB3-bu9sPT3329T2i7CPqEBcKSp0x7LpMMw",
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
}