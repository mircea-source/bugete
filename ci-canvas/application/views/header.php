<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<title>Grafice</title>
	<link href="/ci-canvas/assets/bootstrap.min.css" rel="stylesheet">
	<link href="/ci-canvas/assets/style.css" rel="stylesheet">
	<link href="/ci-canvas/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<script src="/ci-canvas/assets/js/jquery-1.12.4.min.js"></script>
	<script src="/ci-canvas/assets/js/bootstrap.min.js"></script>


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

	<script src="/ci-canvas/assets/js/canvasjs.min.js"></script>
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
						Buget șantier <span class="hidden-xs text-muted">RON</span> <?php if(isset($siteName)) {
							echo $siteName; }
						 ?>
					</a>
				</div>

			</div>
		</div>
	</nav>
	<!-- /header -->
