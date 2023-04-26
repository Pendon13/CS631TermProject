<?php
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
    <a href="index.php">Home</a>
    <h1>New Customer</h1>
    <form method="POST" action="registered.php">
        <p><label for="fname">First Name</label>
        <input type="text" name="fname"></p>
        <p><label for="minit">Middle Initial</label>
        <input type="text" name="minit"></p>
        <p><label for="lname">Last Name</label>
        <input type="text" name="lname"></p>
        <p><label for="haddress">Home Address</label>
        <input type="text" name="haddress"></p>
        <p><label for="phone">Phone Number</label>
        <input type="tel" name="phone"></p>
        <p><label for="creditcard">Credit Card</label>
        <input type="text" name="creditcard"></p>
        <p><label for="email">Email Address</label>
        <input type="email" name="email"></p>
        <p><input type="submit" value="Register"></p>
    </form>
    <h1>Returning Customer</h1>
    <form method="POST" action="customerhome.php">
        <p><label for="id">Id</label>
        <input type="number" name="id"></p>
        <p><label for="email">Email Address</label>
        <input type="email" name="email"></p>
        <input type="submit" value="Go to Customer Page">
    </form>
</body>
</html>