<?php require_once APP_ROOT . '/views/admin/inc/head.php'; ?>

<div class="dash_container">
	<section class="tg-dash">
		<h1>Routes</h1>
	</section>

	<section class="main-tbl-container" style="margin-top:15px;display:flex;">
		<div class="tbl-wrap" style="width:60%;">
			<div class="content-head">
				<h2>Places</h2>
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
							<th>Location</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody id="data-container">
						<!-- if job is close add row with class name "sold" -->
						<?php if($data['place']) : ?>
							<?php foreach($data['place'] AS $place) : ?>
							<tr class="placeCheck" data-id="<?=$place->id;?>">
								<td>
									<span><?=$place->name;?></span>
								</td>
								<td>
									<span><?=$place->coordinates;?></span>
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
			<div class="alert-content">
				<div class="content-head">
					<h2>Place Details</h2>
                </div>
                <div style="width: 100%;display:flex;flex-direction:column;border-bottom: 1px solid var(--dash-side-hove);" id="showDataPlace">
                    <div style="width:100%;height:200px;background-color:red;">

                    </div>
                    <div class="places-preview">
                        <h2>Name of Place in here</h2>
                        <span>Calindagan Negrod Oriental Dumague blah blahh</span>
                    </div>
                    <!-- <div id="routeChecking" style="width:100%;height:400px;"></div> -->
				<!-- <div id="routeChecking" style="height:430px;"></div> -->
                </div>
                <div id="reviewsPlaces">
                    <h2>All reviews</h2>
                    <div id="rWrapper">
                        <div class="rItem">
                            <div class="userProf">

                            </div>
                            <div class="userReviewData">
                                <h3>Name of Reviewer</h3>
                                <span><?php for($i = 0; $i < 5; $i++) {echo '<i class="fas fa-star"></i>';} ?></span>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque cum a ab consequuntur dolor tenetur! Ut nihil quis reiciendis adipisci ducimus minus dolor delectus repellendus, doloremque libero! Sunt, aliquam inventore!</p>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</section>
</div>
<?php require_once APP_ROOT . '/views/admin/inc/footer.php'; ?>