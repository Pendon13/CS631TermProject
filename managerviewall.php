<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager View</title>
</head>
<body>

<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "woodysdb";
$conn = new mysqli($servername, $username, $password, $dbname);
$location = $_POST["location"];
$appt_query = "SELECT * FROM `appointment`, `invoicedetails`, `businesslocation` WHERE invoicedetails.appt_id = appointment.id AND appointment.loc_id = businesslocation.id AND `loc_address` = \"$location\"";
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
echo "<h1>Change Status</h1>";
echo "
<form method=\"POST\" action=\"statuschanged.php\">
    <label for=\"status\">Status</label>
    <input type=\"radio\" name=\"status\" value=\"Waiting for parts\">Waiting for parts
    <input type=\"radio\" name=\"status\" value=\"In Progress\">In Progress
    <input type=\"radio\" name=\"status\" value=\"Completed\">Completed<br>
    <label for=\"id\">Invoice Number</label>
    <input type=\"number\" name=\"id\"><br>
    <label for=\"price\">New Price With Added Parts & Labor</label>
    <input type=\"number\" name=\"price\"><br>
    <input type=\"submit\" value=\"Submit Changes\">
</form>
";

echo "<a href=\"partinventory.php\">Edit Part Inventory</a><br>";

echo "<a href=\"employee.php\">Go back</a>";


?>

    

</body>
</html>