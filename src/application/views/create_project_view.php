<div id="content">
	<div class="content">
	<h1><i class="icon-file"></i> Create a project</h1>

	<form enctype="multipart/form-data" class="form-horizontal" method="post" action="<?php echo base_url() . 'project/create_project';?>">
		<div class="control-group">
			<label>Name your project</label>
		 	<input type="text" name="project_name" required="" />

		 </div>

		 <div class="control-group">
		 	<label>What catagory does your project fall into?</label>
 		 	<select name="project_catagory">
	 			<option value="Animation">Animation</option>
		 		<option value="Game Design">Game Design</option>
		 		<option value="Intreactive">Web/Interactive</option>
		 	</select>
		 </div>

		<div class="control-group">
			<label>Upload a nice image for your project.<label>
			<input type="file" name="project_image" size="20" required="" />
			<span class="help-block"><small>Images must be at most 500x500 and less than 2MB. Supported filetypes: PNG, JPG</small></span>
		</div>

		<div class="control-group">
		    <label>Give your project a spiffy tagline</label>
			<input type="text" name="project_tagline" required="" />

			<label>What's your project about?</label>
	 		<textarea name="project_description"></textarea>
		</div>

		<div class="control-group">
	  		<label>When do you plan on finishing the project?</label>
	 		<input type="text" name="project_end" class="datepicker"/>
	 	</div>
	  <button type="Create" class="btn btn-success btn-primary">Create project</button>
	</form>
	</div>
</div>