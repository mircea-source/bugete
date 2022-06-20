    <!-- page-content-wrapper -->
    <div id="page-content-wrapper" class="page-content-toggle">

        <div class="container-fluid">

            <div class="row">
                <div id="content" class="col-md-8 col-md-offset-1 col-xs-12">
				<h2><?php echo $title; ?></h2>

				<div id="chartContainer" style="height: 370px; width: 100%;"></div>



				<script type="text/javascript">

					$(function () {

						CanvasJS.addCultureInfo("es",
							{
							    decimalSeparator: ",",
							    digitGroupSeparator: ".",
							});


						var chart = new CanvasJS.Chart("chartContainer", {
							animationEnabled: true,
							theme: "light2",
							culture: "es",
							exportEnabled: true,
							title:{
								text: "*Doar cele cu buget introdus",
								fontSize: 20,
								margin: 25
							},
							axisX:{
								labelFontSize: 12,
								labelAutoFit: true,
								gridThickness: 1,
								interval: 1,
								gridColor: "WhiteSmoke"
							},
							legend:{
								cursor: "pointer",
								verticalAlign: "bottom",
								horizontalAlign: "center"
							},
							data: [{
								type: "column",
								name: "Bugetat",
								fillOpacity: .8,
								yValueFormatString: "#,###.00 Lei",
								showInLegend: true,
								toolTipContent: "{label}<br><b>{name}:</b> {y}",
								dataPoints: <?php echo json_encode($data_b, JSON_NUMERIC_CHECK); ?>
							},{
								type: "column",
								name: "Contractat",
								fillOpacity: .8,
								yValueFormatString: "#,###.00 Lei",
								showInLegend: true,
								toolTipContent: "{label}<br><b>{name}:</b> {y}",
								dataPoints: <?php echo json_encode($data_c, JSON_NUMERIC_CHECK); ?>
							},{
								type: "column",
								name: "Facturat",
								fillOpacity: .8,
								yValueFormatString: "#,###.00 Lei",
								showInLegend: true,
								toolTipContent: "{label}<br><b>{name}:</b> {y}",
								dataPoints: <?php echo json_encode($data_f, JSON_NUMERIC_CHECK); ?>
							}]
						});
						chart.render();

					});
				</script>