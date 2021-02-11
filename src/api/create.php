<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.zoom.us/v2/users/me/meetings",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"topic\":\"string\",\"type\":\"integer\",\"start_time\":\"string [date-time]\",\"duration\":\"integer\",\"schedule_for\":\"string\",\"timezone\":\"string\",\"password\":\"string\",\"agenda\":\"string\",\"recurrence\":{\"type\":\"integer\",\"repeat_interval\":\"integer\",\"weekly_days\":\"string\",\"monthly_day\":\"integer\",\"monthly_week\":\"integer\",\"monthly_week_day\":\"integer\",\"end_times\":\"integer\",\"end_date_time\":\"string [date-time]\"},\"settings\":{\"host_video\":\"boolean\",\"participant_video\":\"boolean\",\"cn_meeting\":\"boolean\",\"in_meeting\":\"boolean\",\"join_before_host\":\"boolean\",\"mute_upon_entry\":\"boolean\",\"watermark\":\"boolean\",\"use_pmi\":\"boolean\",\"approval_type\":\"integer\",\"registration_type\":\"integer\",\"audio\":\"string\",\"auto_recording\":\"string\",\"enforce_login\":\"boolean\",\"enforce_login_domains\":\"string\",\"alternative_hosts\":\"string\",\"global_dial_in_countries\":[\"string\"],\"registrants_email_notification\":\"boolean\"}}",
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