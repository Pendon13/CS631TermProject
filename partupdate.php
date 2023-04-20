<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "woodysdb";
$conn = new mysqli($servername, $username, $password, $dbname);

$partname = $_POST["part"];
$locationid = $_POST["locationid"];
$getpartidquery = "SELECT * FROM `part` WHERE part_name = '$partname'";
$parts = $conn->query($getpartidquery);
$partid = $parts->fetch_assoc()["id"];

$query = "UPDATE `inventory` SET quantity = quantity - 1 WHERE part_id = '$partid' AND loc_id = '$locationid'";
$conn->query($query);
echo "Parts have been updated.<br>";


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