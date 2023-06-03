<?php
//echo "<pre>"; print_r($_SERVER);
require_once('controllers/departamento.php');
require_once('controllers/sistema.php');
require_once('controllers/proyecto.php');
//$departamento -> validateRol('Usuario');
include("views/header.php");
include("views/menu.php");
$reporte = $proyecto->chartProyecto();
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

  // Load the Visualization API and the corechart package.
  google.charts.load('current', { 'packages': ['corechart'] });

  // Set a callback to run when the Google Visualization API is loaded.
  google.charts.setOnLoadCallback(drawChart);

  // Callback that creates and populates a data table,
  // instantiates the pie chart, passes in the data and
  // draws it.
  function drawChart() {

    // Create the data table.
    var data = google.visualization.arrayToDataTable([
      ['Element', 'Density', { role: 'style' }],
      <?php foreach ($reporte as $key => $value): ?>
        ['<?php echo $value['mes']; ?>', <?php echo $value['cantidad']; ?>, 'gold']            // English color name
         <?php endforeach; ?>
    ]);

    // Set chart options
    var options = {
      'title': 'Cuántos proyectos hay por mes',
      'width': 400,
      'height': 300
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
</script>

<body>
  <!--Div that will hold the pie chart-->
  <div id="chart_div"></div>
</body>
<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://127.0.0.1:5000/factura',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
)
);

$response = curl_exec($curl);

curl_close($curl);
echo $response;
?>
<?php
include("views/footer.php");
?>