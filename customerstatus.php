<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "woodysdb";
$conn = new mysqli($servername, $username, $password, $dbname);

$cust_id = $_POST["cust_id"];

$query = "SELECT * FROM `appointment`, `invoicedetails`, `businesslocation` WHERE invoicedetails.appt_id = appointment.id AND invoicedetails.loc_id = businesslocation.id AND `cust_id` = \"$cust_id\"";
$appts = $conn->query($query);
echo "<table>
        <th>
        <td>Invoice Number</td>
        <td>Date</td>
        <td>Location</td>
        <td>VIN</td>
        <td>Status</td>
        <td>Current Price</td>
        </th>";
while($row = $appts->fetch_assoc()) {
echo "<tr>
        <td>".$row["invoice_id"]."</td>
        <td>".$row["date"]."</td>
        <td>".$row["loc_address"]."</td>
        <td>".$row["vin"]."</td>
        <td>".$row["status"]."</td>
        <td>".$row["price"]."</td>
</tr>";
}
echo "<h1>Pay for order</h1>";

?>