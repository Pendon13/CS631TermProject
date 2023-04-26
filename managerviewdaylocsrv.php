<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "woodysdb";
$conn = new mysqli($servername, $username, $password, $dbname);
$location = $_POST["location"];
$startdate = $_POST["startdate"];
$enddate = $_POST["enddate"];
$servicetype = $_POST["service"];
$vehicletype = $_POST["vehicle_type"];
$query = "SELECT `invoice_id`, `appt_date`, invoicedetails.price, `loc_address`, `vin`, `vehicle_type`, `svc_type`, `status` FROM `appointment`, `invoicedetails`, `businesslocation`, `servicesoffered` WHERE invoicedetails.service_id = servicesoffered.id AND invoicedetails.appt_id = appointment.id AND appointment.loc_id = businesslocation.id AND `vehicle_type` = '$vehicletype' AND `svc_type` = '$servicetype' AND `status` = 'Paid' AND`loc_address` = \"$location\" AND `appt_date` >= '$startdate' AND `appt_date` <= '$enddate' ORDER BY `invoice_id`";
$appts = $conn->query($query);
$sum = 0;
echo "<table>
        <tr>
        <th>Invoice Number</th>
        <th>Date</th>
        <th>Location</th>
        <th>VIN</th>
        <th>Vehicle Type</th>
        <th>Service</th>
        <th>Status</th>
        <th>Price</th>
        </tr>";
while($row = $appts->fetch_assoc()) {
echo "<tr>
        <td>".$row["invoice_id"]."</td>
        <td>".$row["appt_date"]."</td>
        <td>".$row["loc_address"]."</td>
        <td>".$row["vin"]."</td>
        <td>".$row["vehicle_type"]."</td>
        <td>".$row["svc_type"]."</td>
        <td>".$row["status"]."</td>
        <td>$".$row["price"]."</td>
</tr>";
$sum = $sum + $row["price"];
}
echo "</table>";
echo "<br>";
echo "Total Revenue: $" . $sum;
echo "<br><br><a href=\"employee.php\">Go back</a>";


?>

    

</body>
</html>
