<!DOCTYPE html>
<html>
<head>
  <title>Weather Data | CS207</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <?php include('dataLoad.php'); ?>
</head>
<body>
  <div id="heading" class="container flexdown">
    <div id="innerContainer">
      <center>
      <h1 class="headitem">CS207 Miniproject</h1>
      <hr class="headitem">
      <h3 class="headitem">Aug-Nov 2018</h3>
      </center>
    </div>
  </div>
  <p /><p />
  <div class="container">
    <div style="text-align: center;">
    <?php
    if(isset($_POST['submit']))
    {
      $servername = "localhost";
      $username = "shreyanshkuls";
      $password = "";
      $conn = mysqli_connect($servername, $username, $password, 'weatherData');

      $datef = date('Y-m-d', strtotime($_POST['from']));
      $datet = date('Y-m-d', strtotime($_POST['to']));
      $field = $_POST['dropdown'];

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
        if($_POST['min'])
        {
          $result = mysqli_query($conn, "SELECT MIN({$field}) FROM wdata WHERE dateAndTime>='$datef 00:00:00' AND dateAndTime<='$datet 23:59:59'");
          $row = mysqli_fetch_array($result);
          echo "Minimum = " . $row["MIN({$field})"] . "<br>";
        }
        if($_POST['avg'])
        {
          $result = mysqli_query($conn, "SELECT AVG({$field}) FROM wdata WHERE dateAndTime>='$datef 00:00:00' AND dateAndTime<='$datet 23:59:59'");
          $row = mysqli_fetch_array($result);
          echo "Average = " . $row["AVG({$field})"] . "<br>";
        }
        if($_POST['max'])
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
  </div>
  </div>
</body>
</html>
