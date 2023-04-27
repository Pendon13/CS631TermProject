<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "woodysdb";
$conn = new mysqli($servername, $username, $password, $dbname);
$cust_id = $_POST["id"];
$cust_email = $_POST["email"];
$veriquery = "SELECT * FROM `customer` WHERE `id` = $cust_id";
// if ($conn->query($veriquery) === $cust_id)
$query = "SELECT `vin`, `model`, `make_year`, `color`, `vehicle_type`, `manufacturer` FROM `vehicle` WHERE `cust_id` = $cust_id";

$veriresult = $conn->query($veriquery);
$vehicles = $conn->query($query);

$servicequery = "SELECT * FROM `servicesoffered`";
$services = $conn->query($servicequery);

if($veriresult->num_rows === 1) {
    $row = $veriresult->fetch_assoc();
    if($cust_id === $row["id"] && $cust_email === $row["email"]) {
        echo "Welcome " . $row["fname"]. " " . $row["lname"] . "!<br>";
        echo "Your vehicles are: <br>";
        if ($vehicles->num_rows >= 0) {
            // output data of each row
            while($row = $vehicles->fetch_assoc()) {
              echo "VIN: " . $row["vin"]. " - Model: " . $row["model"]. " - Year: " . $row["make_year"]. " - Color: " . $row["color"]. " - Type: " . $row["vehicle_type"]." - Manufacturer: " . $row["manufacturer"]."<br>";
            }
            echo "<br>
            <h2>View All Appointments and Invoices</h2>
            <form method=\"POST\" action=\"customerstatus.php\">
                <label for=\"cust_id\">ID</label>
                <input type=\"text\" name=\"cust_id\" value=\"$cust_id\"readonly><br>
                <input type=\"submit\" value=\"View\">
            </form>
            
            <br>
            <h2>Would you like to submit an order?</h2>
            <form method=\"POST\" action=\"submitorder.php\">
                <label for=\"cust_id\">ID</label>
                <input type=\"text\" name=\"cust_id\" value=\"$cust_id\"readonly><br>
                <label for=\"date\">Date</label>
                <input type=\"date\" name=\"date\" id=\"\"><br>
                <label for=\"vin\">VIN</label>
                <input type=\"text\" name=\"vin\"><br>
                <label for=\"vehicle_type\">Type</label>
                <input type=\"radio\" name=\"vehicle_type\" value=\"Car\">Car
                <input type=\"radio\" name=\"vehicle_type\" value=\"Van\">Van
                <input type=\"radio\" name=\"vehicle_type\" value=\"Truck\">Truck<br>";
                
                echo returnFormLocation($conn);
                echo returnFormSkills($conn);
                echo "
                <input type=\"submit\" value=\"Request Order\">
            </form>
            
            <br>
            <h1>Register a Vehicle</h1>
            <form method=\"POST\" action=\"registeredvehicle.php\">
                <label for=\"cust_id\">ID</label>
                <input type=\"text\" name=\"cust_id\" value=\"$cust_id\"readonly><br>
                <label for=\"vin\">VIN</label>
                <input type=\"text\" name=\"vin\"><br>
                <label for=\"model\">Model</label>
                <input type=\"text\" name=\"model\"><br>
                <label for=\"make_year\">Year</label>
                <input type=\"number\" name=\"make_year\"><br>
                <label for=\"color\">Color</label>
                <input type=\"text\" name=\"color\"><br>
            
                <label for=\"manufacturer\">Manufacturer</label>
                <input type=\"text\" name=\"manufacturer\"><br>
                <label for=\"vehicle_type\">Type</label>
                <input type=\"radio\" name=\"vehicle_type\" value=\"Car\">Car
                <input type=\"radio\" name=\"vehicle_type\" value=\"Van\">Van
                <input type=\"radio\" name=\"vehicle_type\" value=\"Truck\">Truck<br>
                <input type=\"submit\" value=\"Register Vehicle\">
            </form>";


            echo "<br><table>
            <tr>
            <th>Service Name</th>
            <th>Vehicle Type</th>
            <th>Price (Not including labor or Parts)</th>
            </tr>";
            
            if ($services->num_rows > 0) {
              while($row = $services->fetch_assoc()) {
                echo "<tr>
                <td>".$row["svc_type"]."</td>
                <td>".$row["vehicle_type"]."</td>
                <td>$".$row["price"]."</td>
                </tr>";
              }
            }
            echo "</table><br>";
            echo "<a href=\"index.php\">Return</a>";
          } else {
            echo "0 results<br><a href=\"index.php\">Return</a>";
          }
    } else {
        echo "Not a customer<br><a href=\"index.php\">Return</a>";
    }
}

function returnFormSkills($conn) {
    $query = "SELECT `skill_name` FROM `skill`";
    $skills = $conn->query($query);
    echo "<h4>Services</h4>";
    if ($skills->num_rows > 0) {
        // output data of each row
        while($row = $skills->fetch_assoc()) {
            echo "<label for=\"".$row["skill_name"]."\">".$row["skill_name"]."</label>";
            echo "<input type=\"radio\" name=\"skill\" value=\"".$row["skill_name"]."\"><br> ";
        }
      } else {
        echo "0 results";
      }
}

function returnFormLocation($conn) {
  $query = "SELECT `loc_address` FROM `businesslocation`";
  $skills = $conn->query($query);
  echo "<h4>Location</h4>";
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

?>