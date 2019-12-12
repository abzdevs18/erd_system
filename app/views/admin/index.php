<?php require_once APP_ROOT . '/views/admin/inc/head.php'; ?>
<div class="dash_container">
	<section class="tg-dash">
		<h1>Dashboard</h1>
	</section>

	<section class="main-section mar-30">
		<div class="row">
			<div class="col-4 msgs-3-col-item">
				<sup><i class="fal fa-question-circle" style="font-size:12px;" title="Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eligendi est eaque laborum eum sit? Ipsa earum dolor velit non praesentium architecto hic cupiditate fugiat sed. Maiores quod repellendus aliquam commodi."></i></sup>
				<div class="col-wrap pad-30">
					<figure>
						<img src="<?=URL_ROOT;?>/img/icons/jeep.png">				
					</figure>
					<div class="col-content">
						<p id="jeepney">562</p>
						<h3>Jeepney</h3>
						<a href="#">view details <i class="fal fa-angle-right"></i></a>						
					</div>
				</div>
			</div>
			<div class="col-4 msgs-3-col-item">
				<sup><i class="fal fa-question-circle" style="font-size:12px;" title="Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eligendi est eaque laborum eum sit? Ipsa earum dolor velit non praesentium architecto hic cupiditate fugiat sed. Maiores quod repellendus aliquam commodi."></i></sup>
				<div class="col-wrap pad-30">
					<figure>
						<img src="<?=URL_ROOT;?>/img/icons/driver.png">				
					</figure>
					<div class="col-content">
						<p id="numJeep">562</p>
						<h3>Drivers</h3>
						<a href="#">view details <i class="fal fa-angle-right"></i></a>
					</div>
				</div>
			</div>
			<div class="col-4 msgs-3-col-item">
				<sup><i class="fal fa-question-circle" style="font-size:12px;" title="Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eligendi est eaque laborum eum sit? Ipsa earum dolor velit non praesentium architecto hic cupiditate fugiat sed. Maiores quod repellendus aliquam commodi."></i></sup>
				<div class="col-wrap pad-30">
					<figure>
						<img src="<?=URL_ROOT;?>/img/icons/way.png">				
					</figure>
					<div class="col-content">
						<p id="routes">562</p>
						<h3>Routes</h3>
						<a href="#">view details <i class="fal fa-angle-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="offices-msgs">
		<div class="alerts-notif"style="width:66.66%;">
			<div class="alert-content">
				<div class="content-head">
					<h2>Recent Activity <sup><i class="fal fa-question-circle" style="font-size:12px;" title="Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eligendi est eaque laborum eum sit? Ipsa earum dolor velit non praesentium architecto hic cupiditate fugiat sed. Maiores quod repellendus aliquam commodi."></i></sup></h2>
				</div>
				<div id="erdActivity" style="height:430px;"></div>
			</div>
		</div>
		<div class="alerts-notif">
			<div class="alert-content">
				<div class="content-head">
					<h2>Transit Activity <sup><i class="fal fa-question-circle" style="font-size:12px;" title="Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eligendi est eaque laborum eum sit? Ipsa earum dolor velit non praesentium architecto hic cupiditate fugiat sed. Maiores quod repellendus aliquam commodi."></i></sup></h2>
				</div>
				<div id="log">
					<ul id="content-log-list" class="mCustomScrollbar content fluid light" data-mcs-theme="inset-2-dark" style="height: 400px;width: 100%;">
						<?php for($i = 0; $i <= 10; $i++) :?>
						<li>
							<h3>You Posted A Chemical - Carpenter Required</h3>
							<time>02 Minutes Ago</time>
						</li>
						<?php endfor;?>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<div id="add_record">
		<p><i class="fal fa-plus"></i></p>
	</div>
</div>
<?php require_once APP_ROOT . '/views/admin/inc/footer.php'; ?>
