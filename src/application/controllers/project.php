<?php

class Project extends CI_Controller {
	
	
	function index() {
		redirect('/');
	}



	function view($project_id=null,$timeline=null)
	{
		// Invalid project. Redirect the user back to the front page
		if ($project_id === null) {
			redirect('/');
		}


		$project_info = $this->projects_model->getProjectInfoByID($project_id);
		if (!$project_info) {
			// invalid project
			redirect('/');
		}


		// we got a call to get the timeline
		if ($timeline !== null)
		{
			
			$this->load->model('milestones_model');
			$milestones = $this->milestones_model->getTimelineByProjectID($project_id);
			
			// Build jsTimeline friendly JSON
			$json['timeline'] = array();
			$json['timeline']['headline'] = $project_info->project_name;
			$json['timeline']['type'] = 'default';
			$json['timeline']['text'] = $project_info->project_tagline;
			$json['timeline']['startDate'] = str_replace('-',',',$project_info->project_start);
			$json['timeline']['endDate'] = str_replace('-',',',$project_info->project_end);
			$json['timeline']['asset']['media'] =  base_url() .  $project_info->project_image;
			$json['timeline']['date'] = array();

			if (!empty($milestones)) {
				foreach ($milestones as $key => $milestone) {
					$json['timeline']['date'][$key]['startDate'] = str_replace('-',',',$project_info->project_start);
					$json['timeline']['date'][$key]['endDate'] = str_replace('-',',',$project_info->project_start);
					$json['timeline']['date'][$key]['headline'] = $milestone->type;
					$json['timeline']['date'][$key]['text'] = $milestone->comment;
					$json['timeline']['date'][$key]['asset']['media'] = '';
					$json['timeline']['date'][$key]['asset']['credit'] = $milestone->screen_name;
					$json['timeline']['date'][$key]['asset']['caption'] = '';
				}
			}


			echo json_encode($json);
			return;
		}

		$content['project_info'] = $project_info;


		$footer['js'] = array (
			'storyjs-embed',
			'view_timeline'
		);

		$header['$page_title'] = 'Project Page';
		$header['css'] = array('project_page','timeline');

		$content['project_id'] = $project_id;
		$content['project_member_count'] = $this->projects_model->getMemeberCountForProject($project_id);
		$content['project_info'] = $this->projects_model->getProjectInfoByID($project_id);;




		$this->load->view('_template/header',$header);
		$this->load->view('project_timeline_view',$content);
		$this->load->view('_template/footer',$footer);


	}

	public function milestone()
	{
		if (!is_logged_in())
		{
			redirect('/');
			exit();
		}

		// First check if the user filled out the necessary fields
		if (!$this->input->post('update')) {
			die("Please enter a project name, tagline, and/or an end date for your project.");
		}

		$milestoneData = array(
			"comment" => $this->input->post('comment'),
			"attachment" => '',
			"user_id" => $_SESSION['user_id']
		);

		$this->load->model('milestones_model');

		$result = $this->milestones_model->addNewMilestone($milestoneData);

		var_dump($result);

	}

	function create_project()
	{
		if (!is_logged_in())
		{
			redirect('/');
			exit();
		}

		// First check if the user filled out the necessary fields
		if (!$this->input->post('project_name') || 
			!$this->input->post('project_tagline') ||
			!$this->input->post('project_end')) {
			die("Please enter a project name, tagline, and/or an end date for your project.");
		}

		// Set up our array to be delivered to our model
		$project_data = array (

			'project_name' => $this->input->post('project_name'),
			'owner_id' => $this->user_model->getUserIDByScreename($_SESSION['screen_name']),
			'project_image' => '',
			'project_end' => $this->input->post('project_end'),
			'project_tagline'  => $this->input->post('project_tagline'),
			'project_description' => ($this->input->post('project_description')) ? $this->input->post('project_description') : 'No description available.'
		);


		// List of allowed format types for image uploads
		$imageExtensions = array('image/png','image/jpeg','image/jpg');

		// Get post data
		if (!isset($_POST['project_name'])) return false;

		// User uploaded an image
		if (isset($_FILES['project_image']['tmp_name']) &&
			$_FILES['project_image']['error'] !== 1 &&
			is_uploaded_file($_FILES['project_image']['tmp_name'])) {

			// Filesize is over 1048576 bytes, or 2 MB
			if ($_FILES['project_image']['size'] > 2097152) {
				// File is too large
				die('The image you uploaded is too big');
			}

			// Check to see if the file has the correct mimetype
			if (!in_array($_FILES['project_image']['type'],$imageExtensions)) {
				// file is an incorrect format
				die("The file is in the incorrect format: " . $_FILES['project_image']['type'] );
			}

			$extension = end(explode(".", $_FILES['project_image']['name']));


			// The image is large enough and has the corret mime type
			$this->load->helper('string');
			$filename = random_string('alnum',5); // Generate a 5-char random filename

			// This is where the image will be stored
			$project_image = PROJECT_IMAGES_FOLDER  . '/' . $filename . '.' . $extension;
			$project_image_thumb = PROJECT_IMAGES_FOLDER  . '/' . $filename . '_thumb.' . $extension;

			// Move it to our server
			$moved = move_uploaded_file($_FILES['project_image']['tmp_name'], $project_image);

			if (!$moved) {
				// Something went wrong when moving the file
				die("Something went wrong while uploading the file. Please try again later.");
			}

			// generate thumbnail for the image, it will be saved with the same file name but _thumb appended to it
			$config['image_library'] = 'gd2';
			$config['source_image']	= $project_image;
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = FALSE;
			$config['width']	 = 214;
			$config['height']	= 121;

			$this->load->library('image_lib', $config); 
			$this->image_lib->resize();

		} else {
			// User didn't supply an image. Simply set the project_image name to nothing
			$project_image = '';
		}

		// Append the name of the image to be passed off to the database
		$project_data['project_image'] = $project_image;
		$project_data['project_image_thumb'] = $project_image_thumb;

		// Now that we have finished handling the file upload, we now move on to handling the text input
		$this->load->model('Projects_model');

		$result = $this->Projects_model->createNewProject($project_data);

		// createNewProject() did not complete successfully
		if (!$result) {
			die("Something went wrong while creating the project. Please try again later.");
		}

		// Redirect the user back to their profile
		redirect('profile/' . $_SESSION['screen_name']);
	}
	
	function create()
	{
		// First make sure the user is already logged in
		if (!is_logged_in())
		{
			redirect('/');
		}


		// Attach the custom css for the view
		$header['page_title'] = 'Create a Project';
		$header['css'] = array('create_project');

		// Attach custom JS for the view
		$footer['js'] = array('create_project');

		// Show the view to the user
		$this->load->view('_template/header',$header);
		$this->load->view('create_project_view');
		$this->load->view('_template/footer',$footer);
	}
	
	function delete($project_id) 
	{
		
	}

	
}
