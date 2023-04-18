<?php
function display_empty_form() {
    print('<form method="POST" action="welcome.php">
    Enter your name: <input type="text" name="user_name">
    <br>
    <input type="submit" value="Submit Name">
    </form>');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
    <a href="customerpage.php">Customer Page</a>
    <a href="employeepage.php">Employee Page</a>
</body>
</html>
