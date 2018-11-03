<?php
if(isset($_GET['submit']))
{
  $servername = "localhost";
  $username = "shreyanshkuls";
  $password = "";
  $conn = mysqli_connect($servername, $username, $password, 'weatherData');

  $datef = date('Y-m-d', strtotime($_GET['from']));
  $datet = date('Y-m-d', strtotime($_GET['to']));

  if($datef > $datet)
  {
    die();
  }
  // elseif ($datef < $mindate || $datet > $maxdate) {
  //   echo "<font color=red>From and To dates should be between $mindate and $maxdate!</font>";
  // }
  else
  {
    $result = mysqli_query($conn, "SELECT * FROM wdata WHERE dateAndTime>='$datef 00:00:00' AND dateAndTime<='$datet 23:59:59'");
    $rows = array();
    while($tmp = mysqli_fetch_assoc($result))
    {
      $rows[] = $tmp;
    }
    print json_encode($rows);
  }
  mysqli_close($conn);
}
?>
