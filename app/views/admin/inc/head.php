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
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>	
	<script src="https://cdn.tiny.cloud/1/hhu3aczt7p034dcjnizjwnns5faj5u4s14e894midesztea0/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
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
	</style>
	<script>
		$( function() {
			$( "#accordion" ).accordion();
		} );
	</script>
	<script>
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
	</script>
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
			<div class="mapCon mCustomScrollbar content fluid light" data-mcs-theme="inset-2-dark" style="height: 400px;width: 100%;">
				<div class="changepass-holder">
					<div class="form-group">
						<select style="width: 100%;border-radius:35px;" name="chemBrand">
							<optgroup>
								<option value="">Route</option>
								<option value="">Place</option>
								<option value="">Terminal</option>
								<option value="">Driver</option>
								<option value="">Bus</option>
							</optgroup>
						</select>
						<!-- <label for="chemBrand">Gender</label> -->
					</div>
				</div>
				<div class="changepass-holder">
					<div class="form-group">
					<div id="mapid" style="width:100%;height:300px;"></div>
						<!-- <label for="chemName">Chemical Formula</label> -->
					</div>
				</div>
				<div class="actionButtonModal">
					<button>Continue</button>
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
								<img src="<?=URL_ROOT;?>/img/prof.png">
							</div>
							<div id="admin-details">
								<h3>Hi! I'm Angela</h3>
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
							<li data-link="<?=URL_ROOT;?>/admin/posted" class="<?=($_SESSION['menu_active']=="request") ? 'menu-active' : ''; ?>">
								<i class="fal fa-calendar-week"></i>
								<a href="#"> Schedules</a>
							</li>
							<li data-link="<?=URL_ROOT;?>/admin/biddings" class="<?=($_SESSION['menu_active']=="messages") ? 'menu-active' : ''; ?>">
								<i class="fal fa-envelope"></i>
								<a href="#"> Messages</a>
							</li>
							<li data-link="<?=URL_ROOT;?>/admin/chemical" class="<?=($_SESSION['menu_active']=="chemicals") ? 'menu-active' : ''; ?>">
								<i class="fal fa-car"></i>
								<a href="#"> Drivers</a>
							</li>
							<li data-link="<?=URL_ROOT;?>/admin/student" class="<?=($_SESSION['menu_active']=="student") ? 'menu-active' : ''; ?>">
								<i class="fal fa-map-marked-alt"></i>
								<a href="#"> Places</a>
							</li>
							<li data-link="<?=URL_ROOT;?>/admin/privacy" class="<?=($_SESSION['menu_active']=="privacy") ? 'menu-active' : ''; ?>">
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
	
	