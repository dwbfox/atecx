<div id="content">
	<div class="content">
		<div id="myCarousel" class="carousel slide">
		  <!-- Carousel items -->
		  <div class="carousel-inner">
			<div class="item active"><img src="<?php echo asset_url();?>/images/hero2.jpg"></div>
			<div class="item"><img src="<?php echo asset_url();?>/images/rainbow.jpg"></div>
			<div class="item"><img src="<?php echo asset_url();?>/images/hero.png"></div>

		  </div>
		  <!-- Carousel nav -->
		  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
		</div>
		
				<!-- Sign up -->
		<div id="signup_head">

			<div class="pull-left">
			  <h1>join the experiment.</h1>
			  <p>ATEC Experimental is a platform to showcase your talents and develop your potential. Give ATEC Experimental a spin!</p>
		  </div>
		  <?php if (!is_logged_in()): ?>
		  <div class="pull-left" id="signup_buttons">
			<a href="signup/" class="btn btn-primary btn-large"><strong>Sign Up</strong></a> <strong>or</strong>
			<a href="signup/" class="btn btn-primary btn-large"><strong>Sign In</strong></a>
  		  </div>
  		 <?php endif; ?>

		</div>
		<div id="trending_projects">
			<h2>Trending Projects</h2>
			<div class="" id="projects-inner">
					<!-- project grid -->
				<div class="project-thumb thumbnail">
					<div class="project-thumb-inner">
						<a href="project.html"><img src="http://dummyimage.com/150x150/000000/fff&text=project" alt="project-name"></a>
						<div class="project-thumb-description">
							<span><strong>Diablo 4</strong></span>
							<i class="icon-user"></i> <strong>jane09</strong>
							<span>Members:<strong>5</strong></span>
						</div>
					</div>
				</div>
				
				<div class="project-thumb thumbnail">
					<div class="project-thumb-inner">
						<a href="project.html"><img src="http://dummyimage.com/150x150/000000/fff&text=project" alt="project-name"></a>
						<div class="project-thumb-description">
							<span><strong>Diablo 4</strong></span>
							<i class="icon-user"></i> <strong>jane09</strong>
							<span>Members:<strong>5</strong></span>
						</div>
					</div>
				</div>

				<div class="project-thumb thumbnail">
					<div class="project-thumb-inner">
						<a href="project.html"><img src="http://dummyimage.com/150x150/000000/fff&text=project" alt="project-name"></a>
						<div class="project-thumb-description">
							<span><strong>Diablo 4</strong></span>
							<i class="icon-user"></i> <strong>jane09</strong>
							<span>Members:<strong>5</strong></span>
						</div>
					</div>
				</div>
				
				<div class="project-thumb thumbnail">
					<div class="project-thumb-inner">
						<a href="project.html"><img src="http://dummyimage.com/150x150/000000/fff&text=project" alt="project-name"></a>
						<div class="project-thumb-description">
							<span><strong>Diablo 4</strong></span>
							<i class="icon-user"></i> <strong>jane09</strong>
							<span>Members:<strong>5</strong></span>
						</div>
					</div>
				</div>
			<!-- /project grid -->
			</div>
		</div>
	</div>
</div>