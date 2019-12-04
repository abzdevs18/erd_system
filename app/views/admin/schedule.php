<?php require_once APP_ROOT . '/views/admin/inc/head.php'; ?>

<div class="dash_container">
	<section class="tg-dash">
		<h1>Routes</h1>
	</section>

	<form id="chemicalAdd">
	<section class="offices-msgs">
		<div class="alerts-notif" style="width: 66.66%;">
			<div class="alert-content no-fixed-height sched" style="display: flex;flex-direction: column;">
				<div class="content-head">
					<h2>Schedule Details</h2>
				</div>
			<!-- 	<div class="changepass-holder" style="text-align: center;">
					<button class="tg-btn open-cat" type="button">Select Category</button>
				</div> -->
				<div class="changepass-holder half-row" style="margin-top: 30px;">
					<div class="form-group half-form-group">
						<!-- <input type="text" name="title" class="form-control"> -->
						<select style="width: 100%;" name="category" id="busNumSched">
							<optgroup>
								<?php foreach ($data['schedule'] as $schedule) : ?>
									<option value="<?=$schedule->id;?>"><?=$schedule->body_num;?></option>
								<?php endforeach; ?>
							</optgroup>
						</select>
						<label for="category">Bus Number</label>
					</div>
					<div class="form-group half-form-group">
						<input type="text" name="title" class="form-control timepicker">
						<label for="label">Time of Departure</label>
					</div>
				</div>
				<div class="changepass-holder half-row">
					<div class="form-group">
						<select style="width: 100%;" name="category" id="schedule_routeMap">
							<optgroup>
								<?php if($data['routes']) : ?>
									<?php foreach($data['routes'] AS $route) : ?>
									<option value="<?=$route->id;?>" data-from="<?=$route->from_terminal;?>" data-to="<?=$route->to_terminal;?>"><?=$route->name;?></option>
									<?php endforeach; ?>
								<?php endif;?>
							</optgroup>
						</select>
						<label for="chemName">Route to Assign</label>
					</div>
				</div>
				<div class="changepass-holder half-row">
					<div id="routeChecking" style="width:100%;height:400px;"></div>
				</div>
				<div class="prof-container">
					<div>
						<button class="tg-btn save-btn" type="button">SEND Assignment</button>
					</div>
				</div>
			</div>
		</div>
		<div class="alerts-notif">
		</div>
	</section>
</form>
</div>
<?php require_once APP_ROOT . '/views/admin/inc/footer.php'; ?>