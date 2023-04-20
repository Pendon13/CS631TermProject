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


function getLocationName($locationkey) {
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
            echo "<br>You work at: ". getLocationName($row["loc_id"]);
            echo "<br><a href=\"index.php\">Return</a>";
        }
        if($managerresult->num_rows === 1) {
            $row = $managerresult->fetch_assoc();
            echo "Welcome ".$row["fname"]. " ".$row["lname"];
            echo "<br>You are a manager. You're salary is: ".$row["salary"];
            echo "<br>You work at: ". getLocationName($row["loc_id"]);
            echo "
            <form method=\"POST\" action=\"manager.php\">
                <h2>View Work Orders For Date:</h1>
                <br>
                <label for=\"date\">Date</label>
                <input type=\"date\" name=\"date\"><br>
                <input type=\"submit\" value=\"submit\">
            </form>
            ";
            echo "<br><a href=\"index.php\">Return</a>";
        }
    }
}
?>