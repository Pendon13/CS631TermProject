<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "woodysdb";
$conn = new mysqli($servername, $username, $password, $dbname);
$location = $_POST["location"];
$date = $_POST["date"];

$appt_query = "SELECT * FROM `appointment`, `invoicedetails`, `businesslocation` WHERE invoicedetails.appt_id = appointment.id AND invoicedetails.loc_id = businesslocation.id AND `loc_address` = \"$location\" AND `appt_date` = '$date'";
$appts = $conn->query($appt_query);
echo "<table>
        <tr>
        <th>Invoice Number</th>
        <th>Date</th>
        <th>Location</th>
        <th>VIN</th>
        <th>Status</th>
        <th>Current Price</th>
        </tr>";
while($row = $appts->fetch_assoc()) {
echo "<tr>
        <td>".$row["invoice_id"]."</td>
        <td>".$row["appt_date"]."</td>
        <td>".$row["loc_address"]."</td>
        <td>".$row["vin"]."</td>
        <td>".$row["status"]."</td>
        <td>".$row["price"]."</td>
</tr>";
}
echo "</table><br>";
echo "<a href=\"employee.php\">Go back</a>";


?>

    

</body>
</html>