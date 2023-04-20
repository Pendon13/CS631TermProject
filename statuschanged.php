<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager View</title>
</head>
<body>

<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "woodysdb";
$conn = new mysqli($servername, $username, $password, $dbname);

$id = $_POST["id"];
$status = $_POST["status"];
$price = $_POST["price"];

$query = "UPDATE `invoice` SET amount = '$price' WHERE id = '$id'";
if($conn->query($query) === TRUE) {
    echo "<br>Price has been changed to ".$price. " for invoice ".$id;
}
$query = "UPDATE `invoicedetails` SET price = '$price', status = '$status' WHERE invoice_id = '$id'";
if($conn->query($query) === TRUE) {
    echo "<br>Status has been changed to ".$status. " for invoice ".$id;
}

echo "<br><a href=\"partinventory.php\">Edit Part Inventory</a>";
echo "<br><a href=\"employee.php\">Go back</a>";


?>

</body>
</html>