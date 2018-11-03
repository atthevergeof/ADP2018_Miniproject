<?php
if(isset($_GET['submit']))
{
  $servername = "localhost";
  $username = "shreyanshkuls";
  $password = "";
  $conn = mysqli_connect($servername, $username, $password, 'weatherData');

  $datef = date('Y-m-d', strtotime($_GET['from']));
  $datet = date('Y-m-d', strtotime($_GET['to']));
  $field = $_GET['dropdown'];

  $res = mysqli_fetch_array(mysqli_query($conn, "SELECT MIN(dateAndTime) FROM wdata"));
  $mindate = $res["MIN(dateAndTime)"];
  $res = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(dateAndTime) FROM wdata"));
  $maxdate = $res['MAX(dateAndTime)'];
  if($datef == '1970-01-01' || $datet == '1970-01-01')
  {
    die('<font color=red><H2>Date field cannot be left empty!</H2></font>');
  }
  if($datef > $datet)
  {
    echo "<font color=red>From date cannot be larger than To Date!</font>";
  }
  // elseif ($datef < $mindate || $datet > $maxdate) {
  //   echo "<font color=red>From and To dates should be between $mindate and $maxdate!</font>";
  // }
  else
  {
    echo "<H2>$field</H2>";
    if($_GET['min'])
    {
      $result = mysqli_query($conn, "SELECT MIN({$field}) FROM wdata WHERE dateAndTime>='$datef 00:00:00' AND dateAndTime<='$datet 23:59:59'");
      $row = mysqli_fetch_array($result);
      // echo "SELECT MIN({$field}) FROM wdata WHERE dateAndTime>='$datef 00:00:00' AND dateAndTime<='$datet 23:59:59'<br>";
      echo "Minimum = " . $row["MIN({$field})"] . "<br>";
    }
    if($_GET['avg'])
    {
      $result = mysqli_query($conn, "SELECT AVG({$field}) FROM wdata WHERE dateAndTime>='$datef 00:00:00' AND dateAndTime<='$datet 23:59:59'");
      $row = mysqli_fetch_array($result);
      echo "Average = " . $row["AVG({$field})"] . "<br>";
    }
    if($_GET['max'])
    {
      $result = mysqli_query($conn, "SELECT MAX({$field}) FROM wdata WHERE dateAndTime>='$datef 00:00:00' AND dateAndTime<='$datet 23:59:59'");
      $row = mysqli_fetch_array($result);
      echo "Maximum = " . $row["MAX({$field})"] . "<br>";
    }
  }
  mysqli_close($conn);
}
else {
  echo "<font color=red><H2>Error in submission!</H2></font>";
}
?>
