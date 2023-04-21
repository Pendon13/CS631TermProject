<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "woodysdb";
$conn = new mysqli($servername, $username, $password, $dbname);
$startdate = $_POST["startdate"];
$enddate = $_POST["enddate"];

$query = "SELECT `loc_address`, SUM(`price`) FROM `appointment`, `invoicedetails`, `businesslocation` WHERE invoicedetails.appt_id = appointment.id AND appointment.loc_id = businesslocation.id AND `status` = 'Paid' AND `appt_date` >= '$startdate' AND `appt_date` <= '$enddate' GROUP BY `loc_address`  ORDER BY SUM(`price`) DESC";
$locations = $conn->query($query);
echo "Showing revenue between ".$startdate. " and ".$enddate;
echo "<table>
        <tr>
        <th>Location</th>
        <th>Revenue</th>
        </tr>";
while($row = $locations->fetch_assoc()) {
echo "<tr>
        <td>".$row["loc_address"]."</td>
        <td>".$row["SUM(`price`)"]."</td>
</tr>";
}
echo "</table><br>";
echo "<a href=\"employee.php\">Go back</a>";


?>

    

</body>
</html>