    <!-- page-content-wrapper -->
    <div id="page-content-wrapper" class="page-content-toggle">

        <div class="container-fluid">

            <div class="row">
                <div id="content" class="col-md-8 col-md-offset-1 col-xs-12">
				<h2><?php echo $title; ?></h2>

				<div id="chartContainer4" style="height: 270px; width: 49%; display: inline-block;"></div>
				<div id="chartContainer3" style="height: 270px; width: 49%; display: inline-block;"></div><br />
				<div id="chartContainer1" style="height: 370px; width: 100%; margin: 2em 0 1em 0;"></div><br />
				<div id="chartContainer2" style="height: 370px; width: 100%;"></div>



				<script type="text/javascript">

					$(function () {

						CanvasJS.addCultureInfo("es",
							{
							    decimalSeparator: ",",
							    digitGroupSeparator: ".",
							});

						var chart1 = new CanvasJS.Chart("chartContainer1", {
							animationEnabled: true,
							exportEnabled: true,
							culture: "es",
							theme: "light2",
							title:{
								text: "Cheltuieli lunare",
							    fontSize: 25
							},
							data: [{
								type: "column",
								color: "#4267b2",
								fillOpacity: .8,
								cursor: "pointer",
								dataPoints: <?php echo json_encode($data1, JSON_NUMERIC_CHECK); ?>
							}]
						});
						chart1.render();

						var chart2 = new CanvasJS.Chart("chartContainer2", {
							theme: "light2",
							culture: "es",
							exportEnabled: true,
							animationEnabled: true,
							title: {
								text: "Tipuri de lucrări",
							    fontSize: 25
							},
							legend :{
								verticalAlign: "center",
								horizontalAlign: "left"
							},
							data: [{
								type: "pie",
								cursor: "pointer",
								startAngle: 25,
								toolTipContent: "<b>{label}</b>: {y}%",
								showInLegend: "true",
								legendText: "{label}",
								startAngle: -20,
								indexLabelFontSize: 13,
								indexLabel: "{label}: {y}%",
								dataPoints: <?php echo json_encode($data2, JSON_NUMERIC_CHECK); ?>
							}]
						});
						chart2.render();

						var chart3 = new CanvasJS.Chart("chartContainer3", {
							theme: 'light2',
							exportEnabled: true,
							culture: "es",
							title: {
							    text: "Balanța cheltuieli",
							    fontSize: 25
							},
							animationEnabled: true,
							legend: {
							    horizontalAlign: "center",
							    verticalAlign: "bottom"
							},
							toolTip: {
							    shared: true,
							    content: "<span style='\"'color: {color};'\"'>{name}</span> : {y} Lei"
							},
							data: [
							{
							    type: "stackedBar100",
							    showInLegend: true,
							    color: "#4267b2",
								fillOpacity: .8,
								cursor: "pointer",
							    name: "Cheltuieli",
							    dataPoints: <?php echo json_encode($data3c, JSON_NUMERIC_CHECK); ?>
							},
							{
							    type: "stackedBar100",
							    showInLegend: true,
							    cursor: "pointer",
							    name: "Incasari",
							    dataPoints: <?php echo json_encode($data3i, JSON_NUMERIC_CHECK); ?>
							}]
							});
						chart3.render();

						var chart4 = new CanvasJS.Chart("chartContainer4", {
							animationEnabled: true,
							theme: "light2",
							culture: "es",
							exportEnabled: true,
							title:{
								text: "Costuri",
								fontSize: 25
							},
							dataPointWidth: 30,
							legend:{
								cursor: "pointer",
								verticalAlign: "bottom",
								horizontalAlign: "center"
							},
							data: [{
								type: "bar",
								name: "Bugetat",
								fillOpacity: .8,
								yValueFormatString: "#0.## Lei",
								showInLegend: true,
								dataPoints: <?php echo json_encode($data_b_s, JSON_NUMERIC_CHECK); ?>
							},{
								type: "bar",
								name: "Contractat",
								fillOpacity: .8,
								yValueFormatString: "#0.## Lei",
								showInLegend: true,
								dataPoints: <?php echo json_encode($data_c_s, JSON_NUMERIC_CHECK); ?>
							},{
								type: "bar",
								name: "Facturat",
								fillOpacity: .8,
								yValueFormatString: "#0.## Lei",
								showInLegend: true,
								dataPoints: <?php echo json_encode($data_f_s, JSON_NUMERIC_CHECK); ?>
							}]
						});
						chart4.render();

					});
				</script>