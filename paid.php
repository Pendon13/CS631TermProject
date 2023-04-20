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
$date = $_POST["date"];
$id = $_POST["id"];

$query = "UPDATE `invoice` SET date_paid = '$date' WHERE id = '$id'";
$conn->query($query);
$query = "UPDATE `invoicedetails` SET `status` = 'Paid' WHERE invoice_id = '$id'";
$conn->query($query);

$query = "SELECT * FROM `invoice` WHERE `id` = '$id'";
$invoice = $conn->query($query);
$row = $invoice->fetch_assoc();
echo "You paid $" . $row["amount"] . " on " . $row["date_paid"] . ".";
echo "We charged your credit card.";
echo "<br><a href=\"index.php\">Return</a>";

    ?>
</body>
</html>