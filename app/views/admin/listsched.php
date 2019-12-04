<?php require_once APP_ROOT . '/views/admin/inc/head.php'; ?>

<div class="dash_container">
	<section class="tg-dash">
		<h1>Daily Schedule</h1>
	</section>

	<section class="main-tbl-container" style="margin-top:15px;display:flex;">
		<div class="tbl-wrap" style="width:80%;">
			<div class="content-head">
                <h2>Drivers <button id="addSched">Add Schedule</button></h2>
			</div>
			<div class="sortby filter-category">
				<div id="sort-drop" style="width:100%;">
					<span>Sort by:</span>
					<select style="width:40%;">
						<optgroup>
							<option selected>Filter by time</option>
							<option>Most Recent</option>
							<option>Most Recent</option>
							<option>Most Recent</option>
						</optgroup>
					</select>
				</div>
				<div id="search-sort" style="margin-top:5px;">
					<input type="text" name="search" placeholder="Search Here Bus/Number" style="padding-left:35px;">
					<i class="fal fa-search"></i>
				</div>
			</div><!-- End of Sorting -->
			<div class="job-list-tables">
				<table style="margin:10px auto;">
					<thead>
						<tr>
							<th>Bus Number</th>
							<th>Driver</th>
							<th>Time</th>
							<th>Route</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="data-container" class="schedSearchRes">
						<?php if($data['listSchedule']) : ?>
							<?php foreach($data['listSchedule'] AS $schedule) : ?>
							<tr class="driverRouteCheck" data-id="<?=$schedule->id;?>">
								<td>
									<span><?=$schedule->busNum;?></span>
								</td>
								<td>
									<span><?=$schedule->driver;?></span>
								</td>
								<td>
									<span><?=$schedule->Time;?></span>
								</td>
								<td>
									<span><?=$schedule->routeName;?></span>
								</td>
								<td>
                                    <button>Delete</button>
                                    <button>Update</button>
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
		</div>
	</section>
</div>
<?php require_once APP_ROOT . '/views/admin/inc/footer.php'; ?>