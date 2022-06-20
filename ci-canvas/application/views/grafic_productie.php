    <!-- page-content-wrapper -->
    <div id="page-content-wrapper" class="page-content-toggle">

        <div class="container-fluid">

            <div class="row">
                <div id="content" class="col-md-8 col-md-offset-1 col-xs-12">
				<h2><?php echo $title; ?></h2>

				<div id="chartContainer" style="height: 370px; width: 100%;"></div><br />
				<div id="chartContainer3" style="height: 370px; width: 100%; width: 100%; margin: 2em 0;"></div>


				<script type="text/javascript">

					$(function () {

						CanvasJS.addCultureInfo("es",
							{
							    decimalSeparator: ",",
							    digitGroupSeparator: ".",
							});

						var chart = new CanvasJS.Chart("chartContainer", {
							animationEnabled: true,
							exportEnabled: true,
							culture: "es",
							theme: "light2",
							title:{
								text: "Confectie metalica ansamble",
							    fontSize: 25
							},
							axisX: {
								interval: 1,
								interlacedColor: "#f9f9f9"
							},
							axisY: {
								suffix: " KG"
							},
							toolTip: {
								shared: true
							},
							legend: {
								cursor: "pointer",
								itemclick: toggleDataSeries
							},
							data: [{
								type: "rangeArea",
								markerSize: 0,
								name: "Productie hala",
								fillOpacity: .75,
								showInLegend: true,
								toolTipContent: "Luna {label}<br>{name}<br>Comandat: {y[1]} KG<br>Realizat: {y[0]} KG",
								dataPoints: <?php echo json_encode($data_cm, JSON_NUMERIC_CHECK); ?>
							}]
						});
						chart.render();

						var chart3 = new CanvasJS.Chart("chartContainer3", {
						animationEnabled: true,
						exportEnabled: true,
						culture: "es",
						theme: "light2",
						title:{
							text: "Procent realizat",
							fontSize: 25
						},
						axisX:{
							interval: 1,
						    tickPlacement: "inside"
						},
						axisY:{
							interval: 10,
							suffix: "%"
						},
						toolTip:{
							shared: true
						},
						data:[{
							type: "stackedBar100",
							toolTipContent: "{label}<br><b>{name}:</b> {y} KG (#percent%)",
							showInLegend: true,
							name: "Realizat",
							dataPoints: <?php echo json_encode($procent, JSON_NUMERIC_CHECK); ?>
							},{
							type: "stackedBar100",
							toolTipContent: "<b>{name}:</b> {y} KG (#percent%)",
							showInLegend: true,
							name: "Diferenta",
							dataPoints: <?php echo json_encode($comandat, JSON_NUMERIC_CHECK); ?>
							}]
						});
						chart3.render();

						addAverages();

						function addAverages() {
							var dps = [];
							for(var i = 0; i < chart.options.data[0].dataPoints.length; i++) {
								dps.push({
									label: chart.options.data[0].dataPoints[i].label,
									y: (chart.options.data[0].dataPoints[i].y[1] - chart.options.data[0].dataPoints[i].y[0])
								});
							}
							chart.options.data.push({
								type: "line",
								name: "Diferenta cantitativa",
								showInLegend: true,
								markerSize: 0,
								color: "tomato",
								yValueFormatString: "##,### KG",
								dataPoints: dps
							});
							chart.render();
						}

						function toggleDataSeries(e) {
							if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
								e.dataSeries.visible = false;
							} else {
								e.dataSeries.visible = true;
							}
							e.chart.render();
						}

					});
				</script>