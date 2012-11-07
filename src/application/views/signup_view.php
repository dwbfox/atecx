<div id="content">
	<div class="content">
		<div class="avatar">
			<?php echo '<img src="' . twitter_profile_image($_SESSION['screen_name'],'normal') .'" alt="avatar"/>'; ?>
		</div>
		<?php
			echo "<h1>We're almost done, <strong>" . $_SESSION['screen_name'] ."</strong>!</h1>";
		?>

		<div class="offset5" id="progress_breadcrumb">
			<div class="btn-group" data-toggle="buttons-radio">
				<button disabled="" class="btn btn-success"><span class="icon-tasks"></span><span> Account Information</span></button>
				<button disabled="" id="progress_step1" class="btn"><span class="icon-heart"></span><span> Profile Information</span></button>
				<button disabled="" id="progress_step2" class="btn"><span class="icon-ok-circle"></span><span> Done!</span></button>
			</div>
		</div>
		<div id="signup" class="container">
			<div id="step1" class="step-inner row offset3">
				<form>
					<label class="text-info">Username</label>
					<input type="text" value="<?php echo $_SESSION['screen_name']; ?>"  name="username" />
					<div class="input-append">
					  <label class="text-info">UTD Email</label>
					  <input class="span2" id="appendedInput" size="16" type="text" required=""><span class="add-on">@utdallas.edu</span>
					</div>
					<label class="text-info">Tell us about yourself</label>
					<textarea><?php echo $_SESSION['bio']; ?></textarea>
				</form>
				<a href="#" id="step1_submit" class="btn btn-primary btn-success btn-large row offset2">Next</a>
			</div> <!-- END STEP1  -->

			<div id="step2" class="">
					<form id="interests">
						<legend>Interests</legend>
							<p class="help-text text-info">We want to learn more about you. 
								What are some of the things that spark your curiosity?
							</p>
							<div class="input-append">
								<input type="text" class="interest-input" placeholder="...">
								<input type="text" class="interest-input" placeholder="">
								<input type="text" class="interest-input" placeholder="">
								<input type="text" class="interest-input" placeholder="">
								<input type="text" class="interest-input" placeholder="">
								<input type="text" class="interest-input" placeholder="">
	
							</div>
					</form>
					
					<form  id="proficiencies" class="pull-right">
						<legend>Proficiencies</legend>
							<p class="help-text text-info">In order to connect you with people that complement your skills,
							you have to tell us what you're good at. </p>
						<div class="controls">
							<a href="#" class="prof-catagory" data-name="game"><i class="icon-down pull-left"></i>Game Design</a>
							<div class="slider-item slider-game">

								<?php foreach($prof_roles['game_design'] as $prof): ?>
									<div class="proficiency">
										<div data-value="0" data-id=""></div>
										<label class="checkbox proficiency-title"><input class="proficiency-checkbox" type="checkbox" /><?php echo $prof->prof_name;?></label>
										<div class="proficiency-container">
											<div class="label pull-right proficiency-value">Beginner</div>
											<div data-id="<?php echo $prof->prof_id; ?>" class="proficiency-slider"></div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>

						<a href="#" class="prof-catagory" data-name="animation"><i class="icon-down pull-left"></i>Animation</a>
						<div class="slider-item slider-animation">

						<?php foreach($prof_roles['animation'] as $prof): ?>
							<div class="proficiency">
								<div data-value="0" data-id=""></div>
								<label class="checkbox proficiency-title"><input class="proficiency-checkbox" type="checkbox" /><?php echo $prof->prof_name;?></label>
								<div class="proficiency-container">
									<div class="label pull-right proficiency-value">Beginner</div>
									<div data-id="<?php echo $prof->prof_id; ?>" class="proficiency-slider"></div>
								</div>
							</div>
						<?php endforeach; ?>

						</div>

						<a href="#" class="prof-catagory" data-name="interactive">Interactive/Web</a>
						<div class="slider-item slider-interactive">

						<?php foreach($prof_roles['interactive'] as $prof): ?>
							<div class="proficiency">
								<div data-value="0" data-id=""></div>
								<label class="checkbox proficiency-title"><input class="proficiency-checkbox" type="checkbox" /><?php echo $prof->prof_name;?></label>
								<div class="proficiency-container">
									<div class="label pull-right proficiency-value">Beginner</div>
									<div data-id="<?php echo $prof->prof_id; ?>" class="proficiency-slider"></div>
								</div>
							</div>
						<?php endforeach; ?>
						</div>
					</div>
					</form>
				<a href="#" id="step2_submit" class="btn btn-primary btn-success btn-large row offset2">Next</a>
				<a href="#" id="step2_back" class="btn btn-primary btn-success btn-large">Back</a>
			</div><!-- END STEP2 -->


			<div id="step3" class="step-inner span4 offset3">
				<h2>You're done!</h2>
				<h3 class="text-info">What do you want to do next?</h3>
				<a class="btn btn-primary btn-info" href="<?php echo base_url() . 'auth/login'; ?>">Go to your profile</a>
				<a class="btn btn-primary btn-info" href="<?php echo base_url() . 'project/create'; ?>">Create a Project</a>
			</div>
		</div> <!-- SIGNUP DIV -->
	</div>
</div>

