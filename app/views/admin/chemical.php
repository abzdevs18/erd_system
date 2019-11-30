<?php require_once APP_ROOT . '/views/admin/inc/head.php'; ?>
<div class="dash_container">

	<section class="tg-dash">
		<h1>Chemicals</h1>
	</section>
	<section class="main-tbl-container">
		<div class="tbl-wrap">
			<div class="content-head">
				<h2>Chemicals</h2>
			</div>
			<!-- <div class="filter-category">
				<ul id="job-filters">
					<li class="active-filter">All Chemicals <span>(10)</span></li>
					<li>Payment Cat_1 <span>(10)</span></li>
					<li>Payment Cat_2 <span>(10)</span></li>
					<li>Payment Cat_3 <span>(10)</span></li>
				</ul>
			</div> -->
			<div class="sortby filter-category">
				<div id="sort-drop">
					<span>Sort by:</span>
					<select>
						<optgroup>
							<option selected>HIMEDIA</option>
							<option>Most Recent</option>
							<option>Most Recent</option>
							<option>Most Recent</option>
						</optgroup>
					</select>
				</div>
				<div id="search-sort">
					<input type="text" name="search" placeholder="Search Here">
					<i class="fal fa-search"></i>
				</div>
			</div><!-- End of Sorting -->
			<div class="job-list-tables">
				<table>
					<thead>
						<tr>
							<th><input type="checkbox" name=""></th>
							<th>Chemical Name</th>
							<th>Chemical Formula</th>
							<th>Mol. Wt.</th>
							<th>% Assay</th>
							<th>Quantity</th>
							<th>Expiry Date</th>
							<th>Brand</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php for($i = 0; $i < 5; $i++) : ?>
						<tr>
							<td style="text-align: center;" valign="middle">
								<input type="checkbox" name="">
							</td>
							<td class="tittle-id" valign="middle">
								<h3>Ammonium Sulphate  AR Grade  </h3>
								<span>Chemical ID: 20190321341</span>
							</td> 
							<td class="item-cat" valign="middle">
								<span>(NH<sub>4</sub>)2SO<sub>3</sub></span>	
							</td>
							<td class="item-cat">
								<span>77.08</span>	
							</td>
							<td>
								<span>98%</span>
							</td>
							<td class="price-loc">								
								<h3>250 g</h3>
								<span><?=$job->comLoc;?></span>
							</td>
							<td class="date-pub">								
								<h4 style="margin-bottom: 10px;">Dec. 13, 2020</h4>
							</td>
							<td class="item-cat">
								<span>UNIVAR</span>
							</td>
							<td class="action-btn">
								<span class="eye"><i class="fal fa-eye"></i></span>
								<span class="pencil"><i class="fal fa-pencil-alt"></i></span>
								<span class="trash"><i class="fal fa-trash"></i></span>
							</td>
						</tr>
						<?php endfor; ?>
					</tbody>
				</table>
			</div><!-- End of Table Design -->
		</div>
	</section>
</div>
<?php require_once APP_ROOT . '/views/admin/inc/footer.php'; ?>