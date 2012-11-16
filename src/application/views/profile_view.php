<div id="content">
	<div class="content">
		<div class="container">
			<h1><i class="icon-user"></i> <?php echo is_logged_in() ? 'Dashboard':$profile['screen_name'] .'\'s profile'; ?></h1>
			<div id="main_window" class="">
				<ul class="nav nav-tabs" id="profile_menu">
				  <li><a class="active" href="#projects"><i class="icon-briefcase"></i> Projects</a></li>
				  <li><a href="#proficiencies"><i class="icon-tasks"></i> Skills and Proficiencies</a></li>
				  <?php if(is_logged_in()): ?>
				  <li></i><a href="#settings"><i class="icon-wrench"></i> Settings</a></li>
  				  <?php endif; ?>
				</ul>
				<!-- BEGIN TAB CONTENT -->
				<div class="tab-content">
				  <div class="tab-pane active" id="projects">
					<legend><h3>Projects</h3></legend>
					<div class="">
						<ul class="thumbnails">
						<?php if($profile['num_projects'] == '0'):?>
							<li class="pull-left">
								<a href="<?php echo base_url() . 'project/create'; ?>">
									<div class="project-thumbnail thumbnail project-thumbnail-new">
										<i class="icon-plus-sign"></i>
										<h3>Create a Project</h3>
							   		</div>	
						   		</a>
						   	</li>						
						   <?php else: ?>

							<?php foreach ($profile['project_tiles']  as $project): ?>
							  <li>
							    <div class="project-thumbnail thumbnail">
 							      <a href="<?php echo base_url() . 'project/view/' . $project->project_id; ?>" class="project-thumbnail-img">
 							      	<img src="<?php echo base_url() .  $project->project_image_thumb;?>" alt="">
 							      </a>
							      <h3><?php echo $project->project_name; ?></h3> 
							      <small><?php echo anchor('profile/' .  $project->owner_screename,$project->owner_screename); ?></small>
							      <p class="project-thumbnail-tagline"><?php echo $project->project_tagline; ?></p>
							    </div>
							  </li>
							<?php endforeach; ?>
							<?php if(is_logged_in()): ?>
							<li>
								<a href="<?php echo base_url() . 'project/create'; ?>">
									<div class="project-thumbnail thumbnail project-thumbnail-new">
										<i class="icon-plus-sign"></i>
										<h3>Create a Project</h3>
							   		</div>	
						   		</a>
						   	</li>
							<?php endif; ?>
						</ul>
						<?php endif; ?>
	
					</div>
				  </div>


				  <div class="tab-pane" id="proficiencies">
					<h3>Your Proficiencies</h3>
					<?php if (is_array($profile['profs'])):?>
						<?php 

						$catagory = array();
						$catagory['1'] = "Beginner";
						$catagory['2'] = "Intermediate";
						$catagory['3'] = "Advanced";
						$catagory['4'] = "Master";

						?>
						<?php foreach ($profile['profs'] as $proficiency):?>
						<strong class=""><?php echo $proficiency->prof_name; ?></strong>
						<p class="label label-info"><?php echo $catagory[$proficiency->prof_value]; ?></p>
						<?php endforeach; ?>
					<?php else: ?>
						<p>You didn't specifiy any proficiencies. <a href="#">Get to it!</a>
					<?php endif; ?>
				  </div>
				  <div class="tab-pane" id="settings">
					<h3>Settings</h3>
						<div class="info">
							<a class="btn btn-success" href="<?php echo base_url() . 'auth/liberateData'; ?>">Liberate your data</a>
						</div>
						<div class="info">
							<a class="btn btn-danger" href="<?php echo base_url() . 'account/delete';?>">Delete account</a>
						</div>
				  </div>
				</div>
			</div>

			

			<!--END OF TABS -->

			<div id="sidebar" class="">
				<div id="user_info">
					<div id="info1">
						<ul>
							<li>Joined <?php echo $profile['join_date']; ?></li>
						</ul>
					</div>
					<p><?php echo $profile['bio']; ?></p>
					<div class="info">
						<div class="stat">
							<h3 class="stat-title"><?php echo $profile['num_projects']; ?></h3>
							<span class="stat-verb">projects</span>
						</div>
					</div>
				</div>

				<?php if (is_logged_in()): ?>
				<div id="account_control">	
					<div class="info">
						<a class="btn btn-info" href="<?php echo base_url() . 'project/create'; ?>">Create a project</a>
					</div>
				</div>
				<?php endif; ?>
			</div> <!-- END SIDEBAR -->
		</div>
	</div>
</div>