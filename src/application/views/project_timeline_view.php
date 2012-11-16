<style type="text/css">
#project_dashboard {
	background:url('<?php echo base_url() . '/'. $project_info->project_image; ?>') no-repeat right;
	box-shadow: inset 0px 0px 264px 70px black;
	height:450px;
}

</style>
<div id="content">
	<div class="content">
		<div id="project_dashboard">
			<div class="project_info">
				<div class="project_title">
					<h3><?php echo $project_info->project_name; ?></h3>
					<p class="project_tagline"><?php echo $project_info->project_tagline; ?></h2>

					<div class="project_control">
						<?php if (is_logged_in() AND !is_project_member($project_info->project_id)): ?>
							<a href="<?php echo base_url() . 'project/join/' . $project_info->project_id; ?>" class="btn btn-success btn-primary">
								<i class=" icon-plus-sign"></i> Join Project
							</a>
						<?php elseif (is_logged_in() AND is_project_member($project_info->project_id)): ?>
							<a href="<?php echo base_url() . 'project/part/' . $project_info->project_id; ?>" class="btn btn-danger btn-primary">
								<i class=""></i> Leave Project
							</a>
							<?php endif; ?>			
					</div>


					<ul class="project_list">
						<li class="">Started on <?php echo $project_info->project_start; ?></li>
						<li class="">Ends on <?php echo $project_info->project_end; ?></li>
						<?php
						// Calc the date diff
						$now = new DateTime(date('Y-m-d'));
						$pEnd = new DateTime($project_info->project_end);
						$pStart = new DateTime($project_info->project_start);

						$dateLeft = date_diff($now,$pEnd);
						$dateTotal = date_diff($pStart,$pEnd);
						$percentLeft = (($dateTotal->days - $dateLeft->days) / $dateTotal->days);
						?>

						<li class="label">
						 	<?php echo $dateLeft->days; ?> days left
						</li>

					</ul>
				</div>

				<div class="project_stats">
					<div class="project_member_list">
						<strong>Members</strong>
						<div class="avatar_list">
							<img src="http://api.twitter.com/1/users/profile_image/atecdag.json?size=mini"/>
							<img src="http://api.twitter.com/1/users/profile_image/app_tester_acc.json?size=mini"/>
							<img src="http://api.twitter.com/1/users/profile_image/twitter.json?size=mini"/>
						</div>
					</div>
					<div class="project_description">
						<strong>Project Description</strong>
						<p><?php echo $project_info->project_description; ?></p>
					</div>
				</div>


				<?php if (is_project_member($project_info->project_id)): ?>
				<form method="POST" action="<?php echo base_url() . 'project/milestone'; ?>" class="pull-right" id="push_status">
					<input type="text" name="update" placeholder="Push a new status update">
					<input type="hidden" value="<?php echo $project_info->project_id; ?>" name="project_id"; ?>
					<button class="btn btn-info btn-primary btn-large"><i class=" icon-external-link"></i> Push</button>
				</form>
				<?php endif;?>
				</div>
			</div>
		<!-- TIMELINE -->
		<div id="timeline-embed"></div>
		<!-- END TIMELINE -->

		<!-- RELATED PROJECTS -->
		<div class="related_projects">
			<h3>Other projects</h3>	
			<ul class="thumbnails">
			<?php foreach ($other_projects  as $project): ?>
			 <?php if ($project->project_id === $project_info->project_id) continue; ?>
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
		</ul>
		</div>
		<!-- END RELATED PROJECTS -->

	    <script type="text/javascript">
	        var timeline_config = {
	            width:              '100%',
	            height:             '600',
	            source:             '<?php echo base_url() . 'project/view/' . $project_info->project_id; ?>/timeline',
	            hash_bookmark:		false,
           	    start_zoom_adjust:  '1',
	            embed_id:           'timeline-embed'              //OPTIONAL USE A DIFFERENT DIV ID FOR EMBED
	        }
	    </script>
	</div> <!-- end content class -->
</div> <!-- end content id -->

