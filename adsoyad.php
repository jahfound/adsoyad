<?php

header('Content-Type: application/json');

$host = "localhost";
$user = "root";
$password = "";
$dbname = "101m";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");

$adi = $_GET['ADI'];
$soyadi = $_GET['SOYADI'];

if (!isset($adi) || !isset($soyadi)) {
  $error = array('Hata' => 'ADI or SOYADI value is not set');
  echo json_encode($error, JSON_UNESCAPED_UNICODE);
  exit;
}

$sql = "SELECT * FROM 101m WHERE ADI = '$adi' AND SOYADI = '$soyadi'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    $output[] = $row;
  }
  echo json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE, 4);
}

mysqli_close($conn);
