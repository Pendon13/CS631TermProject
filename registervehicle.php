<?php
$servername = "localhost";
$username = "admin";
$password = "admin";

$dbname = "woodysdb";
$vin = $_POST["fname"];
$cust_id = $_POST["minit"];
$lname = $_POST["lname"];
$phone = $_POST["phone"];
$haddress = $_POST["haddress"];
$creditcard = $_POST["creditcard"];
$email = $_POST["email"];


//register and return id
$conn = new mysqli($servername, $username, $password, $dbname);
$query = "INSERT INTO `customer` (`fname`, `minit`, `lname`, `haddress`, `phone`, `creditcard`, `email`)
VALUES  ('$fname', '$minit', '$lname', '$haddress', '$phone', '$creditcard', '$email');";


INSERT INTO `vehicle` (`vin`, `cust_id`, `model`, `make_year`, `color`, `vehicle_type`, `manufacturer`)
    VALUES  ('111111', '1', 'Camry', '2010', 'Blue', 'Car', 'Toyota');

?>