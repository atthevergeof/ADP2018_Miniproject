<?php
$servername = "localhost";
$username = "shreyanshkuls";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password);
$filepath = 'WeatherDataCS207.csv';

$dbNew = mysqli_select_db($conn, 'weatherData');
if (!$dbNew)
{
  $handle = fopen($filepath, "r");
  mysqli_query($conn, "CREATE DATABASE weatherData");
  mysqli_query($conn, "USE weatherData");
  mysqli_query($conn, "CREATE TABLE wdata (dateAndTime DATETIME, Temperature FLOAT, Relative_Humidity FLOAT, Pressure FLOAT, Rain FLOAT, Light_Intensity INT)");
  mysqli_query($conn, "LOAD DATA LOCAL INFILE 'WeatherDataCS207.csv' INTO TABLE wdata FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' IGNORE 1 ROWS");
}

mysqli_close($conn);
?>
