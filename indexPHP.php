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
    <form id="form1" method="post" action="dataQuery.php">
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
</body>
</html>
