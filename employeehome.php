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

function returnFormLocation($conn) {
    $query = "SELECT * FROM `businesslocation`";
    $skills = $conn->query($query);
    echo "<br><strong>Location</strong><br>";
    if ($skills->num_rows > 0) {
        // output data of each row
        while($row = $skills->fetch_assoc()) {
            echo "<label for=\"".$row["loc_address"]."\">".$row["loc_address"]."</label>";
            echo "<input type=\"radio\" name=\"location\" value=\"".$row["loc_address"]."\"><br> ";
        }
    } else {
        echo "0 results";
    }
}
function returnFormSkill($conn) {
    $query = "SELECT * FROM `skill`";
    $skills = $conn->query($query);
    echo "<br><strong>Service Name</strong><br>";
    if ($skills->num_rows > 0) {
        // output data of each row
        while($row = $skills->fetch_assoc()) {  
            echo "<label for=\"".$row["skill_name"]."\">".$row["skill_name"]."</label>";
            echo "<input type=\"radio\" name=\"service\" value=\"".$row["id"]."\"><br> ";
        }
    } else {
        echo "0 results";
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
            echo "<h2>View a day and location</h2>
            <form method=\"POST\" action=\"managerviewdayloc.php\">";
            echo returnFormLocation($conn);
            echo "
            <label for=\"date\">Date</label>
            <input type=\"date\" name=\"date\">
            <input type=\"submit\" value=\"View\">
            </form>";
            //Time service location revenue
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
            //Begin end revenue max
            echo "<h2>View top 3 revenue locations in a given time period</h2>
            <form method=\"POST\" action=\"managerviewperiodtopthree.php\">
            <label for=\"startdate\">Start Date</label>
            <input type=\"date\" name=\"startdate\"><br>
            <label for=\"startdate\">End Date</label>
            <input type=\"date\" name=\"enddate\">    <br>   
            <input type=\"submit\" value=\"View\">
            </form>";
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