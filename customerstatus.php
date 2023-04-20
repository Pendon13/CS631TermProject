<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    

<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "woodysdb";
$conn = new mysqli($servername, $username, $password, $dbname);

$cust_id = $_POST["cust_id"];
echo "<a href=\"customer.php\">Customer Page</a>";

$query = "SELECT * FROM `appointment`, `invoicedetails`, `businesslocation` WHERE invoicedetails.appt_id = appointment.id AND invoicedetails.loc_id = businesslocation.id AND `cust_id` = \"$cust_id\"";
$appts = $conn->query($query);
echo "<table>
        <tr>
        <th>Invoice Number</th>
        <th>Date</th>
        <th>Location</th>
        <th>VIN</th>
        <th>Status</th>
        <th>Price</th>
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
echo "</table>";

echo "<h1>Pay for order</h1>";
echo "<form method=\"POST\" action=\"paid.php\">
<label for=\"id\">Invoice Number</label>
<input type=\"text\" name=\"id\"><br>
<input type=\"date\" name=\"date\" id=\"today\" value=\"".date("Y-m-d")."\" readonly><br>
<input type=\"submit\" value=\"Paid\">
</form>";
?>

<script>
    document.getElementById('today').value = moment().format('YYYY-MM-DD');
    </script>
</body>
</html>