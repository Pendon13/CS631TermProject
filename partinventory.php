<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "woodysdb";
$conn = new mysqli($servername, $username, $password, $dbname);
function returnFormLocation($conn) {
    $query = "SELECT * FROM `businesslocation`";
    $location = $conn->query($query);
    echo "<h4>Inventory Location</h4><br>";
    if ($location->num_rows > 0) {
        // output data of each row
        while($row = $location->fetch_assoc()) {
            echo "<input type=\"radio\" name=\"locationid\" value=\"".$row["id"]."\">".$row["loc_address"]."<br>";
        }
      } else {
        echo "0 results";
      }
  }
  
echo "<h3>Did you use any parts?</h3>";
echo "<form method=\"POST\" action=\"partupdate.php\">";
echo returnFormLocation($conn);
echo "
    <label for=\"part\">Part</label>
    <input type=\"part\" name=\"part\"><br>
    <input type=\"submit\" value=\"Submit Changes\">
</form>

";
echo "<a href=\"employee.php\">Go back</a>";