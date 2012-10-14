<div id="content">
	<div class="content">
		<div class="avatar">
			<?php echo '<img src="' . twitter_profile_image($_SESSION['screen_name'],'normal') .'" alt="avatar"/>'; ?>
		</div>
		<?php
			echo "<h3>We're almost done, <strong>" . $_SESSION['screen_name'] ."</strong>!</h3>";
		?>

		<div class="offset1" id="progress_breadcrumb">
			<div class="btn-group" data-toggle="buttons-radio">
				<button disabled="" class="btn btn-success"><span class="icon-share"></span><span> Connect with Twitter</span></button>
				<button disabled="" class="btn btn-success"><span class="icon-tasks"></span><span> Profile Information</span></button>
				<button disabled="" id="progress_step1" class="btn"><span class="icon-heart"></span><span> Tell Us About Yourself</span></button>
				<button disabled="" id="progress_step2" class="btn"><span class="icon-ok-circle"></span><span> Done!</span></button>
			</div>
		</div>
		<div id="signup" class="container">
			<div id="step1" class="step-inner row offset4">
				<form>
					<label>Username</label>
					<input type="text" value="<?php echo $_SESSION['screen_name']; ?>"  name="username" disabled="" />
					<div class="input-append">
					  <label>UTD Email</label>
					  <input class="span2" id="appendedInput" size="16" type="text" required=""><span class="add-on">@utdallas.edu</span>
					</div>
					<label>Tell us about yourself</label>
					<textarea><?php echo $_SESSION['bio']; ?></textarea>
				</form>
				<a href="#" id="step1_submit" class="btn btn-primary btn-success btn-large row offset2">Next</a>
			</div> <!-- STEP1  -->
			<div id="step2" class="step-inner row offset4">
					<form>
						<div id="interests">
							<div class="input-append">
								<label>What are some things that spark your curiosity?</label>
								<input type="text" name="interests" placeholder="Steam..."><button class="btn" type="button"><span class="icon-plus-sign"></span></button>
	
							</div>
							<ul id="interests-list">
							</ul>
						</div>
					</form>
					
					<form>
						<div id="proficiencies">
							<div class="input-append">
								<label>You have talent. List some of them below.</label>
								<select>
									<option data-name="Adobe Photoshop" value="1">Adobe Photoshop</option>
									<option data-name="Adobe Premiere" value="2">Adobe Premiere</option>
									<option data-name="Autodesk Maya" value="3">Autodesk Maya</option>
									<option data-name="Blender" value="4">Blender</option>
									<option data-name="GIMP" value="5">GIMP</option>
									<option data-name="UDK" value="6">UDK</option>
									<option data-name="Unity SDK" value="7">Unity SDK</option>
									<option data-name="Source SDK" value="8">Source SDK</option>
								</select>
								<button class="btn" type="button"><span class="icon-plus-sign"></span></button>
							</div>
							<div id="proficiencies-list">
							</div>
						</div>
					</form>
				<a href="#" id="step2_submit" class="btn btn-primary btn-success btn-large row offset2">Next</a>
			</div><!-- STEP2 -->
			<div id="step3" class="step-inner span6 offset4">
				<h2>You're done!</h2>
				<h3>What do you want to do next?</h3>
				<?php echo anchor('profile/' . $_SESSION['screen_name'],'Go to your profile',array('class'=>'btn btn-primary btn-info')); ?>
				<a class="btn btn-primary btn-info">Start a project</a>
			</div>
		</div> <!-- SIGNUP DIV -->
	</div>
</div>

