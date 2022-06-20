<!DOCTYPE html>
<html>
<head>
	<title><?php if( isset($html_title) && $html_title != '' ){
     echo $html_title;
} ?></title>
	<meta charset="utf-8" />
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
	<meta http-equiv="Pragma" content="no-cache">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>

	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<!--	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" /></script>

	<script src="https://code.jquery.com/jquery-1.11.1.min.js" /></script>
	<script src="https://code.jquery.com/jquery-3.3.1.js" /></script>
	-->

	<script>
		$(function () {
			// #sidebar-toggle-button
			$('#sidebar-toggle-button').on('click', function () {
					$('#sidebar').toggleClass('sidebar-toggle');
					$('#page-content-wrapper').toggleClass('page-content-toggle');
					fireResize();
			});

			// sidebar collapse behavior
			$('#sidebar').on('show.bs.collapse', function () {
				$('#sidebar').find('.collapse.in').collapse('hide');
			});

			// To make current link active
			var pageURL = $(location).attr('href');
			var URLSplits = pageURL.split('/');

			//console.log(pageURL + "; " + URLSplits.length);
			//$(".sub-menu .collapse .in").removeClass("in");

			if (URLSplits.length === 5) {
				var routeURL = '/' + URLSplits[URLSplits.length - 2] + '/' + URLSplits[URLSplits.length - 1];
				var activeNestedList = $('.sub-menu > li > a[href="' + routeURL + '"]').parent();

				if (activeNestedList.length !== 0 && !activeNestedList.hasClass('active')) {
					$('.sub-menu > li').removeClass('active');
					activeNestedList.addClass('active');
					activeNestedList.parent().addClass("in");
				}
			}

			function fireResize() {
				if (document.createEvent) { // W3C
					var ev = document.createEvent('Event');
					ev.initEvent('resize', true, true);
					window.dispatchEvent(ev);
				}
				else { // IE
					element = document.documentElement;
					var event = document.createEventObject();
					element.fireEvent("onresize", event);
				}
        	}
		})
	</script>

</head>
<body>
	<!-- header -->
	<nav id="header" class="navbar navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<div id="sidebar-toggle-button">
					<i class="fa fa-bars" aria-hidden="true"></i>
				</div>
				<div class="brand">
					<a href="/ci-3/buget/offices_management">
						Buget șantier <span class="hidden-xs text-muted">RON | <?php if( isset($html_title) && $html_title != '' ){ echo $html_title; } ?></span>
						<?php if(isset($santier)) {
							echo $santier;
						} ?>
						<?php if(isset($partener)) {
							echo '| ' . $partener;
						} ?>
					</a>
				</div>

			</div>
		</div>
	</nav>
	<!-- /header -->

	<!-- sidebar -->
	<div id="sidebar" class="sidebar-toggle">
		<ul class="nav nav-sidebar">
				<li>
						<a href="<?php echo 'http://10.12.50.170/ci-3/buget/locations_management' ?>">
								<i class="fa fa-map-marker" aria-hidden="true"></i>
								<span>LOCAȚII</span>
						</a>
				</li>
				<li role="separator" class="divider"></li>

				<li>
						<a href="http://10.12.50.170/ci-3/buget/hr_management">
								<i class="fa fa-users" aria-hidden="true"></i>
								<span>PERSONAL TESA</span>
						</a>
				</li>
				<li role="separator" class="divider"></li>

				<li>
						<a href="http://10.12.50.170/ci-3/buget/offices_management">
								<i class="fa fa-gears" aria-hidden="true"></i>
								<span>ȘANTIERE</span>
						</a>
				</li>
				<li role="separator" class="divider"></li>
<!--				<li>
						<a href=
							"<?php
								if(isset($siteCode)) {
									echo 'http://10.12.50.170/ci-3/buget/customers_management/index/' . $siteCode;
								}
								else {
									echo 'http://10.12.50.170/ci-3/buget/customers_management';
								}
							?>"
						>
								<i class="fa fa-plus" aria-hidden="true"></i>
								<span>SUBCONTRACTORI</span>
						</a>
				</li>
				<li role="separator" class="divider"></li>

				<li>
						<a href="<?php echo 'http://10.12.50.170/ci-3/buget/partners' ?>">
								<i class="fa fa-user-plus" aria-hidden="true"></i>
								<span>PARTENERI</span>
						</a>
				</li>
				<li role="separator" class="divider"></li> -->
<!--
				<li>
						<a href="http://10.12.50.170/ci-3/buget/employees_management">
								<i class="fa fa-black-tie" aria-hidden="true"></i>
								<span>MANAGERI PROIECT</span>
						</a>
				</li>
				<li role="separator" class="divider"></li>
-->
				<li>
						<a href="<?php echo '#' ?>" title="În lucru">
								<i class="fa fa-truck" aria-hidden="true"></i>
								<span>LOGISTICĂ</span>
						</a>
				</li>


				<li role="separator" class="divider"></li>

				<!--  hala -->
				<li>
						<a href="<?php echo 'http://10.12.50.170/ci-3/buget/steel_structures' ?>">
								<i class="fa fa-industry" aria-hidden="true"></i>
								<span>STRUCTURI METALICE</span>
						</a>
				</li>

				<li role="separator" class="divider"></li>

					<li>
							<a href="<?php echo 'http://10.12.50.170/ci-canvas' ?>">
									<i class="fa fa-area-chart" aria-hidden="true"></i>
									<span>GRAFIC PRODUCȚIE</span>
							</a>
					</li>
					<!--  /hala -->

				<li role="separator" class="divider"></li>

		</ul>

	<!-- footer -->
	<div id="footer">
		<em>&copy; <?php echo date("Y"); ?> SSAB-AG</em>
	</div>
	<!-- /footer -->
	</div>
	<!-- /sidebar -->

    <!-- page-content-wrapper -->
    <div id="page-content-wrapper" class="page-content-toggle">

        <div class="container-fluid">

            <div class="row">

				<h1><?php // echo $title; ?></h1>

				<div style="padding: 10px">
					<?php echo $output; ?>
				</div>

            </div> <!-- /row -->
        </div> <!-- /container-fluid -->

    </div>
    <!-- /page-content-wrapper -->

	<?php foreach($js_files as $file): ?>
	    <script src="<?php echo $file; ?>"></script>
	<?php endforeach; ?>

</body>
</html>