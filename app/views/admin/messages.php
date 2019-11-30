<?php require_once APP_ROOT . '/views/admin/inc/head.php'; ?>
<div class="dash_container">
	<section class="tg-dash">
		<h1>Administrator Messages</h1>
	</section>

	<section class="updates-msgs">
		<div class="msgs-acc">
			<div class="msgs-container">
				<div class="content-head">
					<h2>Faculty Messages</h2>
				</div>	
				<div id="msgs-update-3-col">
					<div class="msgs-3-col-item">
						<div id="search-sort" class="job-search-field">
							<input type="text" name="search" placeholder="Search Here" style="width: 100%;">
							<i class="fal fa-search"></i>
						</div>
						<ul class="jobs-updates">
							<li>Geology Department</li>
							<li>Pharmacy Department</li>
							<li>Chemistry Department</li>
						</ul>
					</div>
					<div class="msgs-3-col-item">
						<ul class="jobs-updates bidders">
							<li>
								<div>
									<img src="<?=URL_ROOT?>/img/icons/small-prof.jpg" /> <span>Lissa Heir</span>								
								</div>
								<div class="pep-chat-list">
									<span class="trash"><i class="fal fa-trash"></i></span>	
									<span class="acc-status-online"></span>									
								</div>
							</li>
							<li>
								<div>
									<img src="<?=URL_ROOT?>/img/icons/small-prof.jpg" /> <span>Lissa Heir</span>								
								</div>
								<div class="pep-chat-list">
									<span class="trash"><i class="fal fa-trash"></i></span>	
									<!-- <span class="acc-status-online"></span>									 -->
								</div>
							</li>
							<li>
								<div>
									<img src="<?=URL_ROOT?>/img/icons/small-prof.jpg" /> <span>Lissa Heir</span>								
								</div>
								<div class="pep-chat-list">
									<span class="trash"><i class="fal fa-trash"></i></span>	
									<span class="acc-status-online"></span>									
								</div>
							</li>
						</ul>
					</div>
					<div class="msgs-3-col-item">
						<div class="message-container">
							<div class="message-reciever">
								<img src="<?=URL_ROOT?>/img/icons/small-prof.jpg" />
								<div class="msg-content">
									<p>Duis aute irure dolor in reprehenderit in voluptate velit esse
									cillum dolore eu fugiat nulla pariatur.</p>
									<span>Jan. 13, 2019</span>
								</div>
							</div>
							<div class="current-user-sender">
								<div class="msg-content">
									<p>Duis aute irure dolor in reprehenderit in voluptate velit esse
									cillum dolore eu fugiat nulla pariatur.</p>
									<span>Jan. 13, 2019 <i class="far fa-check"></i></span>
								</div>
								<img src="<?=URL_ROOT?>/img/icons/small-prof.jpg" />
							</div>
							<div class="message-reciever">
								<img src="<?=URL_ROOT?>/img/icons/small-prof.jpg" />
								<div class="msg-content">
									<p>Duis aute irure dolor in reprehenderit in voluptate velit esse
									cillum dolore eu fugiat nulla pariatur.</p>
									<span>Jan. 13, 2019</span>
								</div>
							</div>
							<div class="message-reciever">
								<img src="<?=URL_ROOT?>/img/icons/small-prof.jpg" />
								<div class="msg-content">
									<p>Duis aute irure dolor in reprehenderit in voluptate velit esse
									cillum dolore eu fugiat nulla pariatur.</p>
									<span>Jan. 13, 2019</span>
								</div>
							</div>
						</div>
						<div class="input-msgs-content">
							<div class="container-of-msgs">
								<div class="ctl-msg" contenteditable>									
									<label for="typing-msg">Type here your message</label>
								</div>
								<div class="cta-buttons">
									<i class="fal fa-thumbs-up"></i>
									<i class="fal fa-thumbs-down"></i>
									<span>Send</span>
								</div>
							</div>
						</div>
					</div>
				</div>			
			</div>			
		</div>
	</section>
</div>

<?php require_once APP_ROOT . '/views/admin/inc/footer.php'; ?>