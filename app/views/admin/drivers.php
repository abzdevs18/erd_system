<?php require_once APP_ROOT . '/views/admin/inc/head.php'; ?>

<div class="dash_container">
	<section class="tg-dash">
		<h1>Drivers</h1>
	</section>

	<section class="main-tbl-container" style="margin-top:15px;display:flex;">
		<div class="tbl-wrap" style="width:60%;">
			<div class="content-head">
				<h2>Drivers</h2>
			</div>
			<div class="sortby filter-category">
				<div id="sort-drop" style="width:100%;">
					<span>Sort by:</span>
					<select style="width:100%;">
						<optgroup>
							<option selected>Geology Department</option>
							<option>Most Recent</option>
							<option>Most Recent</option>
							<option>Most Recent</option>
						</optgroup>
					</select>
				</div>
				<!-- <div id="search-sort">
					<input type="text" name="search" placeholder="Search Here">
					<i class="fal fa-search"></i>
				</div> -->
			</div><!-- End of Sorting -->
			<div class="job-list-tables">
				<table style="margin:10px auto;">
					<thead>
						<tr>
							<th>Name</th>
							<th>Phone</th>
							<th>Bus Number</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody id="data-container">
						<?php if($data['driver']) : ?>
							<?php foreach($data['driver'] AS $driver) : ?>
							<tr class="driverRouteCheck" data-id="<?=$driver->id;?>">
								<td>
									<span><?=$driver->name;?></span>
								</td>
								<td>
									<span><?=$driver->phone;?></span>
								</td>
								<td>
									<span><?=$driver->busNum;?></span>
								</td>
								<td>
                                    <button>Delete</button>
                                    <button>Update</button>
                                    <button class="removeR" disabled>View Route</button>
								</td>
							</tr>
							<?php endforeach; ?>
						<?php endif;?>
					</tbody>
					<div id="pagination-container"></div>
				</table>
			</div><!-- End of Table Design -->
		</div>
		<div class="alerts-notif place-cont" style="width:36%;margin:30px auto;">
			<div class="alert-content">
				<div class="content-head">
					<h2>Driver Assign Route</h2>
                </div>
                <div style="width: 100%;display:flex;flex-direction:column;border-bottom: 1px solid var(--dash-side-hove);" id="showDataPlace">
                    <div id="routeChecking" style="width:100%;height:200px;"></div>
                    <div class="places-preview">
                        <h2>Name of Place in here</h2>
                        <span>Calindagan Negrod Oriental Dumague blah blahh</span>
                    </div>
                    <!-- <div id="routeChecking" style="width:100%;height:400px;"></div> -->
				<!-- <div id="routeChecking" style="height:430px;"></div> -->
                </div>
			</div>
		</div>
	</section>
</div>
<?php require_once APP_ROOT . '/views/admin/inc/footer.php'; ?>