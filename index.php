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
  <div class="container">
    <form id="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <label for="from" class="items">From: </label>
      <input type="date" id="from" class="items" name="from">
      <label for="to" class="items">To: </label>
      <input type="date" id="to" class="items" name="to">
      <select id="dropdown" class="items" name="dropdown">
        <option value="Temperature">Temperature</option>
        <option valur="Pressure">Pressure</option>
        <option value="Relative_Humidity">Relative Humidity</option>
        <option value="Rain">Rain</option>
        <option value="Light_Intensity">Light Intensity</option>
      </select>
      <input type="submit" id="submit" calss="items" value="Submit Query" name="submit">
      <br>
      <input type="checkbox" name="min" class="items" value="Minimum">Minimum
      <input type="checkbox" name="avg" class="items" value="Average">Average
      <input type="checkbox" name="max" class="items" value="Maximum">Maximum
      <hr id="rule">
    </form>
  </div>
  <div class="container">
    <br>
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
      if($datef >= $datet)
      {
        echo "<font color=red>From date cannot be larger than To Date!</font>";
      }
      // elseif ($datef < $mindate || $datet > $maxdate) {
      //   echo "<font color=red>From and To dates should be between $mindate and $maxdate!</font>";
      // }
      else
      {
        if($_POST['min'])
        {
          $result = mysqli_query($conn, "SELECT MIN({$field}) FROM wdata WHERE dateAndTime >= '$datef' & dateAndTime <= '$datet'");
          $row = mysqli_fetch_array($result);
          echo "Minimum $field = " . $row["MIN({$field})"] . "<br>";
        }
        if($_POST['avg'])
        {
          $result = mysqli_query($conn, "SELECT AVG({$field}) FROM wdata WHERE dateAndTime >= '$datef' & dateAndTime <= '$datet'");
          $row = mysqli_fetch_array($result);
          echo "Average $field = " . $row["AVG({$field})"] . "<br>";
        }
        if($_POST['max'])
        {
          $result = mysqli_query($conn, "SELECT MAX({$field}) FROM wdata WHERE dateAndTime >= '$datef' & dateAndTime <= '$datet'");
          $row = mysqli_fetch_array($result);
          echo "Maximum $field = " . $row["MAX({$field})"] . "<br>";
        }
      }
    }
    ?>
  </div>
</body>
</html>
