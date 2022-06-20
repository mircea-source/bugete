<!-- href links different in integration, collaspe in class added server side in integration -->
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
				<li role="separator" class="divider"></li>

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
							<a href="<?php echo 'http://10.12.50.170/ci-canvas/charts/grafic_productie' ?>">
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