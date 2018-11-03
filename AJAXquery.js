google.charts.load('current', {packages: ['corechart','line']});

function drawChart(JSONData) {

  // Define the chart to be drawn.
   var data = new google.visualization.DataTable();
   data.addColumn('string', 'Date');
   data.addColumn('number', 'Temperature');
   data.addColumn('number', 'Relative Humidity');
   data.addColumn('number', 'Pressure (x10)');
   data.addColumn('number', 'Rain');
   data.addColumn('number', 'Light Intensity (x650)');

   var dataArray = [];
   var i = 0;
   for(key in JSONData)
   {
     if(JSONData.hasOwnProperty(key))
     {
       dataArray.push([]);
       dataArray[i].push(JSONData[key].dateAndTime);
       dataArray[i].push(parseInt(JSONData[key].Temperature));
       dataArray[i].push(parseInt(JSONData[key].Relative_Humidity));
       dataArray[i].push(parseInt(JSONData[key].Pressure)/10);
       dataArray[i].push(parseInt(JSONData[key].Rain));
       dataArray[i].push(parseInt(JSONData[key].Light_Intensity)/650);
       i++;
     }
   }

   data.addRows(dataArray);

   // Set chart options
   var options = {'title' : 'Weather Data',
      hAxis: {
         title: 'Date and Time'
      },
      vAxis: {
         title: 'Value'
      },
      'width':1500,
      'height':1000
   };

   // Instantiate and draw the chart.
   var chart = new google.visualization.LineChart(document.getElementById('chart'));
   chart.draw(data, options);
}

function sendData(URLstr)
{
  xmlhttp = new XMLHttpRequest();
  xmlhttp2 = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (this.readyState == 4 && this.status == 200)
    {
      document.getElementById("result").innerHTML = this.responseText;
    }
  };
  xmlhttp.open("GET", URLstr, true);
  xmlhttp.send();
  xmlhttp2.onreadystatechange = function()
  {
    if(this.readyState == 4 && this.status == 200)
    {
      var JSONData = JSON.parse(this.responseText);
      drawChart(JSONData);
    }
  };
  xmlhttp2.open("GET", URLstr.replace("dataQueryGET","dataQueryChart"), true);
  xmlhttp2.send();
}

function trigger()
{
  frm = document.getElementById('from').value;
  too = document.getElementById('to').value;
  fld = document.getElementById('dropdown').value;
  mi = (document.getElementById('min').checked)?(1):(0);
  av = (document.getElementById('avg').checked)?(1):(0);
  Ma = (document.getElementById('max').checked)?(1):(0);
  if (frm != "" && too != "" && (mi || av || Ma))
  {
    sendData("dataQueryGET.php?from="+frm+"&to="+too+"&dropdown="+fld+"&submit=Submit+Query&min="+mi+"&avg="+av+"&max="+Ma);
  }
  else {
    document.getElementById('result').innerHTML = "";
  }
}
