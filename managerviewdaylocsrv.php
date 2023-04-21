echo "<h2>View a period of time, service, and location</h2>
            <form method=\"POST\" action=\"managerviewdaylocsrv.php\">";
            echo returnFormLocation($conn);
            echo "
            <label for=\"startdate\">Start Date</label>
            <input type=\"date\" name=\"startdate\">
            <label for=\"startdate\">End Date</label>
            <input type=\"date\" name=\"enddate\">";
            echo returnFormSkill($conn);
            echo "
            <label for=\"vehicle_type\"><strong>Vehicle Type</strong></label><br>
            <input type=\"radio\" name=\"vehicle_type\" value=\"Car\">Car
            <input type=\"radio\" name=\"vehicle_type\" value=\"Van\">Van
            <input type=\"radio\" name=\"vehicle_type\" value=\"Truck\">Truck<br>            
            <input type=\"submit\" value=\"View\">
            </form>";

<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "woodysdb";
$conn = new mysqli($servername, $username, $password, $dbname);
$location = $_POST["location"];
$startdate = $_POST["startdate"];
$enddate = $_POST["enddate"];
$serviceid = $_POST["service"];
$vehicletype = $_POST["vehicle_type"];

$appt_query = "SELECT * FROM `appointment`, `invoicedetails`, `businesslocation` WHERE invoicedetails.appt_id = appointment.id AND invoicedetails.loc_id = businesslocation.id AND `status` = 'Paid' AND `loc_address` = \"$location\" AND `appt_date` = '$date'";
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
?>