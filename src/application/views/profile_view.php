<div id="content">
	<div class="content">
		<div class="container">
			<div id="main_window" class="span8">
				<h2>Projects</h2>
				
			</div>
			<div id="sidebar" class="span2">
				<div id="user_info">
					<div id="info1">
						<h2><?php echo $profile['screen_name']; ?></h2>
						<div class="span2 avatar">
							<img src="<?php echo twitter_profile_image($profile['screen_name'],'bigger'); ?>" alt="Profile Image"  />
						</div>
						<ul>
							<li>Joined <?php echo $profile['join_date']; ?></li>
						</ul>
					</div>
					<div class="info">
						<div class="stat">
							<h3 class="stat-title"><?php echo $profile['num_projects']; ?></h3>
							<span class="stat-verb">projects started</span>
						</div>
					</div>
					<div class="info">
						<div class="stat">
							<h3 class="stat-title"><?php echo $profile['num_projects']; ?></h3>
							<span class="stat-verb">projects watched</span>
						</div>
					</div>
				</div>
				<?php if (is_logged_in()): ?>
				<div id="account_control">
					<h4>Account Control</h4>
	
					<div class="info">
						<a class="btn btn-info">Create a project</a>
					</div>
					<div class="info">
						<a class="btn btn-success">Liberate your data</a>
					</div>
					<div class="info">
						<a class="btn btn-danger">Delete account</a>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>