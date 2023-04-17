<?php
$servername = "localhost";
$username = "admin";
$password = "admin";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
echo "<br>";
$sql = "DROP DATABASE woodysDB";
if ($conn->query($sql) === TRUE) {
  echo "Database dropped successfully";
} else {
  echo "Error creating woodysDB database: " . $conn->error;
}
echo "<br>";
$sql = "CREATE DATABASE woodysDB";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating woodysDB database: " . $conn->error;
}
echo "<br>";

$dbname = "woodysdb";

//load schema
$conn = new mysqli($servername, $username, $password, $dbname);
$query = file_get_contents("initializeSchema.sql");
if (mysqli_multi_query($conn, $query)){
  echo "Successfully created tables";
}
else {
  echo "Fail: " . $conn->error;
}
echo "<br>";
//load files
$conn = new mysqli($servername, $username, $password, $dbname);
$query = file_get_contents("loadData.sql");
if (mysqli_multi_query($conn, $query)){
  echo "Successfully loaded data";
}
else {
  echo "Fail: " . $conn->error;
}
echo "<br>";
?>