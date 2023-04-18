<?php
$servername = "localhost";
$username = "admin";
$password = "admin";

$dbname = "woodysdb";
$fname = $_POST["fname"];
$minit = $_POST["minit"];
$lname = $_POST["lname"];
$phone = $_POST["phone"];
$haddress = $_POST["haddress"];
$creditcard = $_POST["creditcard"];
$email = $_POST["email"];


//register query and return id
$conn = new mysqli($servername, $username, $password, $dbname);
$query = "INSERT INTO `customer` (`fname`, `minit`, `lname`, `haddress`, `phone`, `creditcard`, `email`)
VALUES  ('$fname', '$minit', '$lname', '$haddress', '$phone', '$creditcard', '$email');";
?>
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
if ($conn->query($query) === TRUE) {
    $lastid = $conn->insert_id;
    echo "Successfully created an account<br>";
    echo "Your customer id is: " . $lastid;
  }
  else {
    echo "Fail: " . $conn->error;
  }
  ?>
  <br>
  <a href="customerpage.php">Return to customer page</a>
</body>
</html>