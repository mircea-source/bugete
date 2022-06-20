<!-- href links different in integration, collaspe in class added server side in integration -->
		<!-- sidebar -->
		<div id="sidebar" class="sidebar-toggle">
			<ul class="nav nav-sidebar">
					<li>
						<a href="http://10.12.50.170/ci-3/buget/offices_management">
							<kbd>1</kbd>
							<span>ȘANTIERE</span>
						</a>
				</li>
				<li role="separator" class="divider"></li>
				<li>
						<a href="http://10.12.50.170/ci-3/buget/customers_management">
							<kbd>2</kbd>
							<span>SUBCONTRACTORI</span>
						</a>
				</li>
				<li role="separator" class="divider"></li>
				<li>
						<a href="http://10.12.50.170/ci-3/buget/orders_management">
							<kbd>3</kbd>
							<span>FACTURI</span>
						</a>
					</li>
					<li role="separator" class="divider"></li>
					<li>
						<a href="http://10.12.50.170/ci-3/buget/employees_management">
							<i class="fa fa-users" aria-hidden="true"></i>
							<span>MANAGERI PROIECT</span>
						</a>
					</li>
					<li role="separator" class="divider"></li>
					<!--  grafice -->
					<li data-toggle="collapse" href="#features" aria-expanded="false" aria-controls="features">
						<a href="#">
							<i class="fa fa-bar-chart" aria-hidden="true"></i>
							<span>GRAFICE</span>
						</a>
					</li>

					<li>
						<ul id="features" class="sub-menu collapse">
						<?php foreach($santiere as $santier) {; ?>
                            <li><a href="http://10.12.50.170/ci-canvas/charts/santiere/<?php echo $santier['siteCode']; ?>" id=""><?php echo $santier['adresa1']; ?></a></li>
                        <?php }; ?>
						</ul>
					</li>
					<!--  /grafice -->

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
							<a href="<?php echo 'http://10.12.50.170/ci-canvas/charts' ?>">
									<i class="fa fa-area-chart" aria-hidden="true"></i>
									<span>GRAFIC PRODUCTIE</span>
							</a>
					</li>
					<!--  /hala -->

					<li role="separator" class="divider"></li>
			</ul>

        <!-- footer -->
        <div id="footer">
            <em>&copy; <?php echo date("Y"); ?> SSAB AG</em>
        </div>
        <!-- /footer -->
		</div>
		<!-- /sidebar -->