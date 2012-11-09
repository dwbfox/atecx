<style type="text/css">
#project_dashboard {
	background:url('<?php echo base_url() . '/'. $project_info->project_image; ?>') no-repeat center;
	box-shadow: inset 0px 0px 264px 70px black;
}

</style>

<div id="content">
	<div class="content">
		<div id="project_dashboard">
			<div class="project_info">
				<div class="project_title">
					<h2><?php echo $project_info->project_name; ?></h2>
					<p><?php echo $project_info->project_tagline; ?></h2>
					<ul class="">
						<li><strong><?php echo $project_member_count; ?></strong> members</li>
						<li>Started on <?php echo $project_info->project_start; ?></li>
						<li></li>
					</ul>
				</div>

				<div class="project_stats">
					<div class="pull-left">
						<span>About <?php echo $project_info->project_name; ?></span>
						<p class="description"><?php echo $project_info->project_description; ?></p>
					</div>

				</div>

				<?php if (is_project_member($project_info->project_id)): ?>
				<form method="POST" action="<?php echo base_url() . 'project/milestone'; ?>" class="pull-right" id="push_status">
					<textarea name="update" placeholder="Push a new status update"></textarea>
					<button class="btn btn-info btn-primary btn-large">Push</button>
					<div class="control-group"<input type="file" name="project_attachment" /></div>
				</form>
				<?php endif;?>
				</div>
			</div>
			<h1>Timeline</h1>
		<!-- TIMELINE -->
		<div id="timeline-embed"></div>
		<!-- END TIMELINE -->

	    <script type="text/javascript">
	        var timeline_config = {
	            width:              '100%',
	            height:             '500',
	            source:             'http://localhost/atecx/src/project/view/<?php echo $project_info->project_id; ?>/timeline',
	            hash_bookmark:		true,
           	    start_zoom_adjust:  '5',
	            embed_id:           'timeline-embed'              //OPTIONAL USE A DIFFERENT DIV ID FOR EMBED
	        }
	    </script>
	</div> <!-- end content class -->
</div> <!-- end content id -->

