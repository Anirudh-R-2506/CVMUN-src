<?php
echo "hi";
$link = new mysqli("localhost","u864523831_cvmun20","ChettinadVidyashram600028","u864523831_cvmun20");
$a = $link->query("SELECT COUNT(*) FROM ireg where email LIKE '%'");
$row = $a->fetch_assoc();
print_r($row["COUNT(*)"]);
