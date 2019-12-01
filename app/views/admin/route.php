<?php require_once APP_ROOT . '/views/admin/inc/head.php'; ?>

<div class="dash_container">
	<section class="tg-dash">
		<h1>Routes</h1>
	</section>

	<section class="main-tbl-container" style="margin-top:15px;display:flex;">
		<div class="tbl-wrap" style="width:35%;">
			<div class="content-head">
				<h2>Registered Students</h2>
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
							<th>Actions</th>
						</tr>
					</thead>
					<tbody id="data-container">
						<!-- if job is close add row with class name "sold" -->
						<?php if($data['routes']) : ?>
							<?php foreach($data['routes'] AS $route) : ?>
							<tr id="routeCheckingRow" data-from="<?=$route->from_terminal;?>" data-to="<?=$route->to_terminal;?>">
								<td>
									<span><?=$route->name;?></span>
								</td>
								<td>
									<span>02131011</span>
								</td>
							</tr>
							<?php endforeach; ?>
						<?php endif;?>
					</tbody>
					<div id="pagination-container"></div>
				</table>
			</div><!-- End of Table Design -->
		</div>
		<div class="alerts-notif" style="width:60%;margin:30px auto;">
			<div class="alert-content">
				<div class="content-head">
					<h2>Route Map</h2>
				</div>
				<div id="routeChecking" style="width:100%;height:400px;"></div>
				<!-- <div id="routeChecking" style="height:430px;"></div> -->
			</div>
		</div>
	</section>

<?php require_once APP_ROOT . '/views/admin/inc/footer.php'; ?>