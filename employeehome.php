<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "woodysdb";
$conn = new mysqli($servername, $username, $password, $dbname);
$emp_ssn = $_POST["ssn"];
$verificationquery = "SELECT * FROM `employee` WHERE `ssn` = $emp_ssn"; 
$veriresult = $conn->query($verificationquery);
$managerquery = "SELECT * FROM `employee`, `manager` WHERE `ssn` = $emp_ssn AND manager.emp_ssn = employee.ssn";
$managerresult = $conn->query($managerquery);
$technicianquery = "SELECT * FROM `employee`, `technician` WHERE `ssn` = $emp_ssn AND technician.emp_ssn = employee.ssn";
$technicianresult = $conn->query($technicianquery);


function getLocationName($conn, $locationkey) {
    $locationsquery = "SELECT * FROM `businesslocation`";
    $locationresult = $conn->query($locationsquery);
    while($row = $locationresult->fetch_assoc()) {
        if($locationkey == $row["id"]) {
            return $row["loc_address"];
        }
    }
}

if($veriresult->num_rows === 1) {
    $row = $veriresult->fetch_assoc();
    if($emp_ssn === $row["ssn"]) {
        if($technicianresult->num_rows === 1) {
            $row = $technicianresult->fetch_assoc();
            echo "Welcome ".$row["fname"]. " ".$row["lname"];
            echo "<br>You are a technician. You're hourly rate is: $".$row["hourly_rate"];
            echo "<br>You work at: ". getLocationName($conn, $row["loc_id"]);
            echo "<br><a href=\"index.php\">Return</a>";
        }
        if($managerresult->num_rows === 1) {
            $row = $managerresult->fetch_assoc();
            echo "Welcome ".$row["fname"]. " ".$row["lname"];
            echo "<br>You are a manager. You're salary is: ".$row["salary"];
            echo "<br>You work at: ". getLocationName($conn, $row["loc_id"]);
            echo "
            <form method=\"POST\" action=\"manager.php\">
                <h2>View Work Orders For Date:</h1>
                <input type=\"text\" name=\"location\" value=\"".getLocationName($conn, $row["loc_id"])."\" readonly><br>
                <label for=\"date\">Date</label>
                <input type=\"date\" name=\"date\"><br>
                <input type=\"submit\" value=\"View Date\">
            </form>
            <h2>View all work orders at your location</h2>
            <form method=\"POST\" action=\"managerviewall.php\">
                <input type=\"text\" name=\"location\" value=\"".getLocationName($conn, $row["loc_id"])."\" readonly><br>
                <input type=\"submit\" value=\"View All\">
            </form>
            ";
            $queryparts = "SELECT * FROM `part`, `inventory`, `businesslocation` WHERE businesslocation.id = inventory.loc_id AND inventory.part_id = part.id";
            $partsresult = $conn->query($queryparts);
            echo "<h3>Part List</h3><table>
        <tr>
        <th>Part ID</th>
        <th>Part Name</th>
        <th>Location</th>
        <th>Quantity</th>
        <th>Price</th>
        </tr>";
while($row = $partsresult->fetch_assoc()) {
echo "<tr>
        <td>".$row["part_id"]."</td>
        <td>".$row["part_name"]."</td>
        <td>".$row["loc_address"]."</td>
        <td>".$row["quantity"]."</td>
        <td>".$row["price"]."</td>
</tr>";
}
echo "</table><br>";
            echo "<br><a href=\"index.php\">Return</a>";
        }
    } else {
        echo "Not an employee.<br><a href=\"index.php\">Return</a>";
    }
} else {
    echo "Not an employee.<br><a href=\"index.php\">Return</a>";
}
?>