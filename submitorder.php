<?php
$servername = "localhost";
$username = "admin";
$password = "admin";

$dbname = "woodysdb";
$vin = $_POST["vin"];
$date = $_POST["date"];
$location = $_POST["location"];
$vehicle_type = $_POST["vehicle_type"];
$skill_names = $_POST["skill"];
$cust_id = $_POST["cust_id"];

$conn = new mysqli($servername, $username, $password, $dbname);
$display_order_query = "SELECT `svc_type`, `vehicle_type`, `skill_id`, `price` FROM `servicesoffered` WHERE `svc_type` = \"$skill_names\" AND `vehicle_type` = \"$vehicle_type\"";
$get_loc_id = "SELECT `id` FROM `businesslocation` WHERE `loc_address` = \"$location\"";
$loc_id = $conn->query($get_loc_id);
$loc_id = $loc_id->fetch_assoc()["id"];
$services = $conn->query($display_order_query);
$base_price = 0;
$row = $services->fetch_assoc();
echo "Vehicle Type Is: ".$row["vehicle_type"];
echo "<br>You ordered the following service: ";
echo "Service: ".$row["svc_type"]." | Price: ". $row["price"];
$base_price = $base_price + $row["price"];
echo "<br>Your base price is: $".$base_price. " Labor is not included.";
echo "<br>Appointment date: " . $date;


$appt_insert = "INSERT INTO `appointment` (`appt_date`, `loc_id`, `cust_id`, `vin`)
VALUES  ($date, $loc_id, $cust_id, $vin)";
$conn->query($appt_insert);
$appt_id = $conn->insert_id;

$inv_insert = "INSERT INTO `invoice` (`amount`)
VALUES  ($base_price)";
$conn->query($inv_insert);
$inv_id = $conn->insert_id;

$invdetails_insert = "INSERT INTO `invoicedetails` (`appt_id`, `loc_id`, `invoice_id`, `price`)
VALUES  ($appt_id, $loc_id, $inv_id, $base_price)";
$conn->query($invdetails_insert);

?>