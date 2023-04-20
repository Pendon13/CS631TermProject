<?php
$servername = "localhost";
$username = "admin";
$password = "admin";

$dbname = "woodysdb";
$vin = $_POST["vin"];
$cust_id = $_POST["cust_id"];
$model = $_POST["model"];
$make_year = $_POST["make_year"];
$color = $_POST["color"];
$vehicle_type = $_POST["vehicle_type"];
$manufacturer = $_POST["manufacturer"];


//register and return id
$conn = new mysqli($servername, $username, $password, $dbname);
$query = "INSERT INTO `vehicle` (`vin`, `cust_id`, `model`, `make_year`, `color`, `vehicle_type`, `manufacturer`)
VALUES  ('$vin', '$cust_id', '$model', '$make_year', '$color', '$vehicle_type', '$manufacturer')";

if ($conn->query($query) === TRUE) {
    $lastid = $conn->insert_id;
    echo "Successfully registered vehicle<br>";
  }
  else {
    echo "Fail: " . $conn->error;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="index.php">Return to home</a>
</body>
</html>
