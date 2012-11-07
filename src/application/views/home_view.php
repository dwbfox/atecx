<div id="content">
	<div class="content">
		<div id="myCarousel" class="carousel slide">
		  <!-- Carousel items -->
		  <div class="carousel-inner">
			<div class="item active"><img src="<?php echo asset_url(); ?>/images/hero2.jpg"></div>
			<div class="item"><img src="<?php echo asset_url(); ?>/images/rainbow.jpg"></div>
			<div class="item"><img src="<?php echo asset_url(); ?>/images/hero.png"></div>

		  </div>
		  <!-- Carousel nav -->
		  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
		</div>
		
		<!-- Sign up -->
		<div class="panel panel-left pull-left">
			<div>
			  <h2>join.</h2>
			  <p><?php echo SITE_NAME; ?> is a platform to showcase your talents and develop your potential. Give <?php echo SITE_NAME; ?> a spin!</p>
		  </div>
		  <?php if (!is_logged_in()): ?>
  		  <div class="pull-left" id="signup_buttons">
			<a href="auth/login" class="btn btn-primary btn-large"><strong>Sign Up</strong></a>
  		  </div>
  		<?php endif; ?>
		</div>
		
		<!-- status update-->
		<div class="panel panel-right pull-right">
			<div class="pull-left">
			  <h2>watch.</h2>
			  <p>Latest updates on <?php echo SITE_NAME; ?></p>
			  <div id="latest_updates">
			  	<div class="avatar"><img src="<?php echo twitter_profile_image('atecdag','normal'); ?>" alt="avatar" /></div>
			  		<div class="update">
			  			<p>Hey guys, I just uploaded yet another version of the model!</p>
			  		</div>
			  </div>
		  </div>
		</div>
		<div class="panel" id="trending_projects">
			<div class="panel" id="projects-inner">
				<h2>explore.</h2>
				<!-- project grid -->
				<ul class="thumbnails">
					<?php if (!is_array($recent_projects)) return;
					 foreach ($recent_projects  as $project): ?>
					  <li>
					    <div class="project-thumbnail thumbnail">
						      <a href="<?php echo base_url() . 'project/view/' . $project->project_id; ?>" class="project-thumbnail-img">
						      	<img src="<?php echo base_url() .  $project->project_image_thumb;?>" alt="">
						      </a>
					      <h3><?php echo $project->project_name; ?></h3> 
					      <small><?php echo anchor('profile/' .  $project->screen_name,$project->screen_name); ?></small>
					      <p class="project-thumbnail-tagline"><?php echo $project->project_tagline; ?></p>
					    </div>
					  </li>
					<?php endforeach; ?>
				</ul>

				<!-- END PROJECT  GRID -->
			</div> <!-- END PROJECT INNTER -->
		</div>
	</div>
</div>