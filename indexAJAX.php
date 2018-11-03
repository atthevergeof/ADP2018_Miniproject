<!DOCTYPE html>
<html>
<head>
  <title>Weather Data | CS207</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <?php include('dataLoad.php'); ?>
  <script type = "text/javascript" src = "googlecharts.js"></script>
  <script type = "text/javascript" src = "AJAXquery.js"></script>
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
    <form id="form1">
      <label for="from" class="items">From: </label>
      <input type="date" id="from" class="items" name="from" onchange="trigger()">
      <label for="to" class="items">To: </label>
      <input type="date" id="to" class="items" name="to" onchange="trigger()">
      <select id="dropdown" class="items" name="dropdown" onchange="trigger()">
        <option value="Temperature">Temperature</option>
        <option value="Pressure">Pressure</option>
        <option value="Relative_Humidity">Relative Humidity</option>
        <option value="Rain">Rain</option>
        <option value="Light_Intensity">Light Intensity</option>
      </select>
      <br>
      <input type="checkbox" name="min" class="items" value="Minimum" id="min" onchange="trigger()">Minimum
      <input type="checkbox" name="avg" class="items" value="Average" id="avg" onchange="trigger()">Average
      <input type="checkbox" name="max" class="items" value="Maximum" id="max" onchange="trigger()">Maximum
      <hr id="rule">
    </form>
  </div>
  <div class="container">
    <div id="result" style="text-align: center;">
    </div>
    <div id="chart">
    </div>
  </div>
</body>
</html>
