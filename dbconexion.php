<?php
$servername = "localhost";
$database = "id11690446_bdpuntoventadogo";
$username = "id11690446_bddogo";
$password = "123tamarindo";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//echo "Connected successfully";
//mysqli_close($conn);
?>