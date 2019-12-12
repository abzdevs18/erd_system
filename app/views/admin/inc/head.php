<!DOCTYPE html>
<html>
<head>
	<title><?=SITE_NAME;?></title>
	<link rel="icon" type="image/x-icon" href="<?=URL_ROOT;?>/img/logo_icon/lab.ico">
	<link href="https://fonts.googleapis.com/css?family=Quicksand:400,500&display=swap" rel="stylesheet"> 
	<link rel="stylesheet" type="text/css" href="https://cdndevelopment.blob.core.windows.net/cdn/fa/css/all.min.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="<?=URL_ROOT;?>/css/style.css">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="<?=URL_ROOT;?>/css/jquery.mCustomScrollbar.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="<?=URL_ROOT;?>/js/routeMap.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>

	<!-- <script src="https://cdn.tiny.cloud/1/hhu3aczt7p034dcjnizjwnns5faj5u4s14e894midesztea0/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->
    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
        integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
		crossorigin="" />
		<!-- leaflet routing -->
		<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
        integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
		crossorigin=""></script>
		<!-- leftlet routing js -->
		<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
	

	<style>
		@import url("<?=URL_ROOT;?>/css/static-style.css");

		#navigation-scroll > .mCSB_inside > .mCSB_container {
			margin-right: 0px !important;
		}
		#accordion .ui-state-active {
			background-color:#2b2f3e !important;
			border-color:#2b2f3e !important;
		}
		#accordion h3 {
			font: var(--font-quick-500-18);
			font-size: 15px;
		}
		.mCSB_inside > .mCSB_container {
			margin-right: 5px !important;
		}
		.tox-statusbar__branding {
			display: none !important;
		}
		.leaflet-routing-container {
			display:none;
		}
		#example_wrapper {
			margin: 10px;
		}
		#example_info, #example_length {
			float:left;
			margin-left: 20px;
			font: var(--font-quick-400-13);
			font-size: 14px;
			font-weight: 400;
		}
		#example_length {
			margin-bottom: 10px;
		}
		#example_filter {
			float: right;
			margin-bottom: 10px;
			margin-right: 20px;
		}
		#example {
			width: 97% !important;
		}
		#example_length label, #example_filter label {
			display:flex;
			font: var(--font-quick-500-16);
			line-height: 2.2;
		}
		#example_paginate {
			float: right;
			margin-right: 20px;
		}
		#example_paginate span {
			margin: 0 10px;
		}
		#example_paginate span a {
			margin: 0 10px;
		}
		#example_paginate a {
			font: var(--font-quick-400-13);
			font-size: 14px;
			font-weight: 600;
		}
		/* Time picker */
		.ui-timepicker-standard {
			z-index: 9999;
		}
	</style>
	<script>
		$( function() {
			$( "#accordion" ).accordion();
			$('input.timepicker').timepicker();
		} );
	</script>
	<!-- <script>
		tinymce.init({
			selector: 'textarea#chemicalFormula',
			// without the below lines of code. TinyMCE editor gets the value of the textarea
			// on second click, not on the first click.
			//NOTE: important code.
			setup: function (editor) {
				editor.on('change', function () {
					tinymce.triggerSave();
				});
			}
		});
	</script> -->
	<!-- Base on the documentation, if multiple editors we need to initialize each -->
	<script>
		$( function() {
			$('i').tooltip();
		});
	</script>
</head>
<body style="position:relative;">
	<!-- Modal for confirmation in deleting Blog -->
	<div class="confirmationModal" style="display:none;">
		<div class="confirmationMessage">
			<h2></h2>
			<div class="mapCon mCustomScrollbar content fluid light" data-mcs-theme="inset-2-dark" style="max-height: 400px;width: 100%;">
				<div class="changepass-holder">
					<div class="form-group">
						<select style="width: 100%;border-radius:35px;" name="itemAdd" id="addT">
							<optgroup>
								<option value="1">Terminal</option>
								<option value="2">Route</option>
								<option value="3">Place</option>
								<option value="4">Driver</option>
								<option value="5">Dispatcher</option>
								<option value="6">Bus</option>
							</optgroup>
						</select>
						<label for="itemAdd">Choose item</label>
					</div>
				</div>
				<!-- Start adding form -->
				<div id="placeForm" style="display:none;">
					<div class="changepass-holder">
						<div class="form-group">
							<select style="width: 100%;border-radius:35px;" name="from" id="placeTerminal">
								<optgroup>
									<?php if($data['terminal']) : ?>
										<?php foreach($data['terminal'] AS $terminal) : ?>
											<option value="<?=$terminal->latlong?>" data-id="<?=$terminal->id?>"><?=$terminal->name?></option>
										<?php endforeach;?>
									<?php endif;?>
								</optgroup>
							</select>
							<label for="from">Place Terminal:</label>
						</div>
					</div>
					<div class="changepass-holder">
						<div class="form-group">
							<input type="file" id="placeImageData" value="" name="placeImg" style="width: 100%;border-radius:35px;">
							<label for="placeImg">Photo</label>
						</div>
						<div class="form-group">
							<input type="text" id="placeName" value="" name="placeN" style="width: 100%;border-radius:35px;">
							<label for="placeN">Name of place</label>
						</div>
						<div class="form-group">
							<input type="text" id="placeAdd" value="" name="address" style="width: 100%;border-radius:35px;">
							<label for="address">Address</label>
						</div>
					</div>
				</div>
				<!-- End of adding place -->
				<!-- Start of adding Bus and if posible add user -->
				<div id="busForm" style="display:none;">
					<div class="changepass-holder">
						<div class="form-group">
							<select style="width: 100%;border-radius:35px;" name="from" id="driveId">
								<optgroup>
									<?php if($data['drivers']) : ?>
										<?php foreach($data['drivers'] AS $driver) : ?>
											<option value="<?=$driver->id?>"><?=$driver->username?></option>
										<?php endforeach;?>
									<?php endif;?>
								</optgroup>
							</select>
							<label for="from">Bus Driver:</label>
						</div>
					</div>
					<div class="changepass-holder">
						<div class="form-group">
							<input type="text" id="driverN" value="" name="busNum" style="width: 100%;border-radius:35px;">
							<label for="driverNum">Bus number</label>
						</div>
					</div>
				</div> 
				<!-- end of adding Bus and if posible add user -->
				<!-- Adding driver -->
				<div id="driverForm" style="display:none;">
					<div class="changepass-holder">
						<div class="form-group">
							<select style="width: 100%;border-radius:35px;" name="from" id="assignTerminal">
								<optgroup>
									<?php if($data['bus']) : ?>
										<?php foreach($data['bus'] AS $bus) : ?>
											<option value="<?=$bus->id?>"><?=$bus->body_num?></option>
										<?php endforeach;?>
									<?php endif;?>
								</optgroup>
							</select>
							<label for="from">Bus assigned:</label>
						</div>
					</div>
					<div class="changepass-holder">
						<div class="form-group">
							<input type="text" id="driverN" value="" name="driverName" style="width: 100%;border-radius:35px;">
							<label for="driverName">Driver's Name</label>
						</div>
						<div class="form-group">
							<input type="text" id="driverCon" value="" name="contact" style="width: 100%;border-radius:35px;">
							<label for="contact">Contact</label>
						</div>
					</div>
				</div> 
				<!-- end of adding driver -->				
				<div id="dispatcherForm" style="display:none;">
					<div class="changepass-holder">
						<div class="form-group">
							<select style="width: 100%;border-radius:35px;" name="from" id="assignTerminal">
								<optgroup>
									<?php if($data['terminal']) : ?>
										<?php foreach($data['terminal'] AS $terminal) : ?>
											<option value="<?=$terminal->latlong?>" data-id="<?=$terminal->id?>"><?=$terminal->name?></option>
										<?php endforeach;?>
									<?php endif;?>
								</optgroup>
							</select>
							<label for="from">Assign To:</label>
						</div>
					</div>
					<div class="changepass-holder">
						<div class="form-group">
							<input type="text" id="disPatch" value="" name="dispatcherName" style="width: 100%;border-radius:35px;">
							<label for="dispatcherName">Dispathcer Name</label>
						</div>
						<div class="form-group">
							<input type="text" id="disContact" value="" name="contact" style="width: 100%;border-radius:35px;">
							<label for="contact">Contact</label>
						</div>
					</div>
				</div>
				<div id="routeForm" style="display:none;">
					<div class="changepass-holder">
						<div class="form-group">
							<input type="text" value="" id="routeNames" name="routeNameN" style="width: 100%;border-radius:35px;">
							<label for="routeNameN">Route Name</label>
						</div>
					</div>
					<div class="changepass-holder">
						<div class="form-group">
							<select style="width: 100%;border-radius:35px;" name="from" id="fromR">
								<optgroup>
									<?php if($data['terminal']) : ?>
										<?php foreach($data['terminal'] AS $terminal) : ?>
											<option value="<?=$terminal->latlong?>" data-id="<?=$terminal->id?>"><?=$terminal->name?></option>
										<?php endforeach;?>
									<?php endif;?>
								</optgroup>
							</select>
							<label for="from">From:</label>
						</div>
					</div>
					<div class="changepass-holder">
						<div class="form-group">
							<select style="width: 100%;border-radius:35px;" name="to" id="toR">
								<optgroup>
									<?php if($data['terminal']) : ?>
										<?php foreach($data['terminal'] AS $terminal) : ?>
											<option value="<?=$terminal->latlong?>" data-id="<?=$terminal->id?>"><?=$terminal->name?></option>
										<?php endforeach;?>
									<?php endif;?>
								</optgroup>
							</select>
							<label for="to">To:</label>
						</div>
					</div>
				</div>
				<div id="termAddForm">
					<div class="changepass-holder termFC">
						<div class="form-group">
							<input type="text" value="" id="nameTerm" name="nameTerminal" style="width: 100%;border-radius:35px;">
							<label for="nameTerminal">Terminal Name</label>
						</div>
					</div>
					<div class="changepass-holder">
						<div class="form-group">
							<div id="mapid" style="width:100%;height:300px;"></div>
							<input type="hidden" id="latlong">
						</div>
					</div>
				</div>
				<div class="actionButtonModal">
					<button data-u="1">Continue</button>
					<button id="cancelDeletion">Cancel <sup><i class="fal fa-question-circle" style="font-size:12px;" title="Separate driver from bus because it could happen that the company has a spare busses."></i></sup></button>
				</div>				
			</div>
		</div>
	</div>
	<!-- End of modal blog Deletion -->
	
	<!-- <img style="position:absolute;z-index:-1;" src="<?=URL_ROOT;?>/css/svg/header.svg" alt="" class="src"> -->
			<!-- Modal: For adding chemicals. First Plan -->
	<div id="modal" style="display:none;width: 100%;height: 100vh;background: rgba(51, 51, 51, 0.37);z-index: 999999;position: fixed;">
		<form>
			<section class="offices-msgs">
				<div class="alerts-notif" style="width: 66.66%;margin: 0 auto;position: relative;">
					<span class="modal-close" style="position: absolute;color: #fff;z-index: 9;right: 0;padding: 10px;background: green;top: -21px;border-radius: 50%;width: 20px;height: 20px;text-align: center;line-height: 20px;font-size: 20px;"><i class="fal fa-times"></i></span>
					<div class="alert-content no-fixed-height" style="display: flex;flex-direction: column;">
						<div class="content-head">
							<h2>Job Details</h2>
						</div>
					</div>
				</div>
			</section>
			<section class="offices-msgs">
				<div class="alerts-notif">
					<div class="alert-content">
						<div class="content-head">
							<h2>Site Activity Log</h2>
						</div>
						<div id="log">
							<ul id="content-log-list" class="mCustomScrollbar content fluid light" data-mcs-theme="inset-2-dark" style="height: 400px;width: 100%;">
								<?php for($i = 0; $i <= 10; $i++) :?>
								<li>
									<h3>You Posted A Job - Carpenter Required</h3>
									<time>02 Minutes Ago</time>
								</li>
								<?php endfor;?>
							</ul>
						</div>
					</div>
				</div>
				<div class="alerts-notif">
					<div class="alert-content">
						<div class="content-head">
							<h2>Recent request</h2>
						</div>
						<div class="ad-log">
							<ul class="mCustomScrollbar content fluid light" data-mcs-theme="inset-2-dark" style="height: 400px;width: 100%;">
								<?php for($i = 0; $i <= 10; $i++) :?>
								<li>							
									<span class="tg-adverified">Verified Ad</span>
									<h3>Brand new lenovo laptop i5 for sale</h3>
									<time datetime="2017-08-08">01 Day Ago</time>									
								</li>
								<?php endfor;?>
							</ul>
						</div>
					</div>
				</div>
			</section>
		</form>
	</div>			
	<!-- End Modal -->
	
	<!-- Right Sidebar -->
	<div class="request_side">
		<span><i class="fal fa-times"></i></span>
		<div class="req_details mCustomScrollbar content fluid light" data-mcs-theme="inset-2-dark" style="height: calc( 100vh - 100px );width:100%;">
			<div id="head_name">
				<div class="request_icon_wrapper m_icon">
					<div class="req_icon m_icon_req">
						<span>IV</span>
					</div>
					<div style="margin:5px;margin-top:11px;" class="m_head_req">
						<h3>Clint Anthony Abueva</h3>
					</div>
					<p style="font:var(--font-quick-500-18);font-size:15px;">Department</p>
					<div id="m_req_status">
						<span><i class="fas fa-circle" style="font-size:10px;"></i> Pending</span>
					</div>
				</div>
			</div>
			<div id="accordion">
				<h3>Requested</h3>
				<div class="ad-log">
					<ul class="mCustomScrollbar content fluid light" data-mcs-theme="inset-2-dark" style="height: 300px;width: 100%;">
						<?php for($i = 0; $i <= 10; $i++) :?>
						<li>							
							<span class="tg-adverified cat_chemical">Salt</span>
							<h3>Sodium Orthophosphate</h3>
							<time datetime="2017-08-08">01 Day Ago</time>									
						</li>
						<?php endfor;?>
					</ul>
				</div>
				<h3>Note</h3>
				<div class="ad-log">
					<ul class="mCustomScrollbar content fluid light" data-mcs-theme="inset-2-dark" style="height: 300px;width: 100%;">
						<?php for($i = 0; $i <= 2; $i++) :?>
						<li>							
							<span class="tg-adverified cat_chemical">Salt</span>
							<h3>Sodium Orthophosphate</h3>
							<time datetime="2017-08-08">01 Day Ago</time>									
						</li>
						<?php endfor;?>
					</ul>
				</div>
			</div>
			<div class="actionButtonModal">
				<button>Deny</button>
				<button id="cancelDeletion">Approve</button>
			</div>
		</div>
	</div>	
	<!-- End Right Sidebar -->

	<!-- Notification Modal -->
	<div class="m_notification">
		<h3>Notification</h3>
		<div class="ad-log">
			<ul class="mCustomScrollbar content fluid light" data-mcs-theme="inset-2-dark" style="height: 400px;width: 100%;">
				<?php for($i = 0; $i <= 10; $i++) :?>
				<li style="padding-bottom:0px;margin-bottom:10px;border-bottom:1px solid #888;cursor:pointer;">							
					<!-- <span class="tg-adverified"><i class="fal fa-atom" style="padding-right:5px;"></i> user identification</span> -->
					<div class="m_tag_time">
						<label for="notification" class="notif_tag">Admin</label>
						<span>12:00 am</span>
					</div>
					<div class="request_icon_wrapper" style="margin-top:4px;margin-bottom:5px;">
						<div class="req_icon m_notif_icon">
							<span>KS</span>
						</div>
						<div style="margin:5px;" class="m_notif_content">
							<b>Kate Saycon</b>
							<h3>EDTA Disodium Salt dihydrate, crystal  </h3>
							<time datetime="2017-08-08">01 Day Ago</time>
						</div>
					</div>									
				</li>
				<?php endfor;?>
			</ul>
		</div>
	</div>
	<!-- End Notification Modal -->
	<main>
		<header class="dashboard-nav">
			
			<section id="side-navigation" class="sideNav-full">	
				<!--  data-simplebar -->
				<div id="navigation-scroll" class="mCustomScrollbar content fluid light" data-mcs-theme="inset-2-dark" style="height: 100%;width: 100%;">			
					<!-- <div id="logo-admin" dir="ltr"> 
						<div style="width: 116px;">
							<img style="width: 100%;" src="<?=URL_ROOT;?>/img/logo1.png" id="logo-icon">
						</div>
					</div> -->
					<div id="admin-profile">
						<div id="profile-container" class="adm-prof">
							<div id="admin-icon">
								<img src="<?=URL_ROOT;?>/img/icons/header_icon.png">
							</div>
							<div id="admin-details">
								<h3>Hi! I'm Ansgela</h3>
								<p>Administrator</p>
							</div>
							<div id="admin-edit">
								<a href="<?=URL_ROOT;?>/admin/profile"><i class="fal fa-pencil"></i></a>
							</div>
						</div>
					</div>
					<nav>
						<div id="admin-details" class="menu-head">
							<h3>Menu</h3>
						</div>
						<ul id="menus-nav" style="margin-bottom:20px;">
							<li data-link="<?=URL_ROOT;?>/admin" class="<?=($_SESSION['menu_active']=="home") ? 'menu-active' : ''; ?>">
								<i class="fal fa-chart-bar"></i>
								<a href="#"> Analytics</a>
							</li>
							<li data-link="<?=URL_ROOT;?>/admin/profile" class="<?=($_SESSION['menu_active']=="profile") ? 'menu-active' : ''; ?>">
								<i class="fal fa-cog"></i>
								<a href="#"> Profile settings</a>
							</li>
							<li data-link="<?=URL_ROOT;?>/admin/schedule" class="<?=($_SESSION['menu_active']=="schedule") ? 'menu-active' : ''; ?>">
								<i class="fal fa-calendar-week"></i>
								<a href="#"> Schedules</a>
							</li>
							<li data-link="<?=URL_ROOT;?>/admin/messenger" class="<?=($_SESSION['menu_active']=="messages") ? 'menu-active' : ''; ?>">
								<i class="fal fa-envelope"></i>
								<a href="#"> Chat</a>
							</li>
							<li data-link="<?=URL_ROOT;?>/admin/driver" class="<?=($_SESSION['menu_active']=="driver") ? 'menu-active' : ''; ?>">
								<i class="fal fa-car"></i>
								<a href="#"> Drivers</a>
							</li>
							<li data-link="<?=URL_ROOT;?>/admin/routes" class="<?=($_SESSION['menu_active']=="routes") ? 'menu-active' : ''; ?>">
								<i class="fal fa-route"></i>
								<a href="#"> Routes</a>
							</li>
							<li data-link="<?=URL_ROOT;?>/admin/places" class="<?=($_SESSION['menu_active']=="places") ? 'menu-active' : ''; ?>">
								<i class="fal fa-map-marked-alt"></i>
								<a href="#"> Places</a>
							</li>
							<li data-link="<?=URL_ROOT;?>/admin/logs" class="<?=($_SESSION['menu_active']=="logs") ? 'menu-active' : ''; ?>">
								<i class="fal fa-history"></i>
								<a href="#"> Logs</a>
							</li>
						</ul>
						<div id="admin-details" class="menu-head">
							<h3>Actions</h3>
						</div>
						<ul id="menus-nav">
							<li data-link="<?=URL_ROOT;?>/users/signout">
								<i class="fal fa-sign-out"></i>
								<a href="#"> Logout</a>
							</li>
						</ul>
					</nav>
				</div>
			</section>
			<div id="add-post">
				<div class="right-menu">
					<div id="r-sock">
						<i class="fal fa-ellipsis-v"></i>
						<i class="fal fa-ellipsis-v"></i>
						<i class="fal fa-ellipsis-v"></i>
					</div>
					<h2>Terminal hub</h2>
					<!-- <div class="logo">
						<img src="<?=URL_ROOT?>/img/default/road.png" alt="">
					</div> -->
					<!-- <i class="fas fa-th"></i> -->
				</div>
				<div class="search-dash">
					<div id="search-sort">
						<input type="text" name="search" placeholder="Search Here" style="width: 100%;" id="admin-search-field">
						<i class="fal fa-search"></i>
						<select name="search" id="searchOptions" style="position: absolute;top: 0;width: 150px;right: 0;">
							<option value="">Driver</option>
							<option value="">Route</option>
							<option value="">Bus</option>
						</select>
					</div>	
					<div class="dash-result">
						<div>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
						</div>
					</div>				
				</div>
				<div>
					<!-- <a href="<?=URL_ROOT;?>/admin/form"><i class="fal fa-bookmark"></i> Store Chemical</a> -->
					<div id="notif-icon">
						<button><i class="fal fa-bell"></i></button>
						<span id="notif-counter"></span>
					</div>
					<div style="margin-top:5px;">
						<div style="width: 30px;height: 30px;margin-left: 10px;border-radius: 50%;background: #f3f3f3;background-image: url('<?=URL_ROOT;?>/img/prof.png');background-size: contain;background-repeat: no-repeat;background-position: center;">
							
						</div>
					</div>
				</div>
			</div>
		</header>
	
	