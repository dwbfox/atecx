#ATEC Experimental


  
##Changelog
####19 November 2012
* Fixed sign in bug causing malformed requests to the account/create method
* Fixed an issue with 

####17 November 2012
* Fixed a bug where project images were failing to upload
* Users are now required to upload an image for their project

####15 November 2012
* Users can now join and part projects
* Fixed a bug where the project end date was not being set into the database
* Changed the database schemas so that various user_id columns are now FK to the users table, ATECX.sql updated to reflect the changes
* Projects are now catagorized under three catagories, which the user will have the option of choosing from
when first creating a project.
* Removed Bootstrap.min.css from header.php as there was currently no need for it
* Project duration is shown in the project page, along with the number of days left before launch
* Other projects by the user are shown in the bottom of the project page


####8 November 2012
* TimelineJS now implemented
* A new controller parameter for project, (project/:id/timeline) now spits out JSON to be used by TimelineJS or exports
* Users now can upload text only updates to their projects
* Project page redesigned and now operational
* Minor bug fixes

####7 November 2012
* Project thumbnails are now smaller and narrower. Also, the "Project Page" buttons are removed from project thumbnails.
* Empty thumbnail added to allow the user to add a new project
* Users are now able to delete their accounts, but their project data is preserved.
* Added a new controller with new methods(account/delete and account/create) to handle account creation and deletion
* The step 1 of the sign process ( the connect page) might take a little longer than anticipated.For now, I removed the first step so it's now a three-step signup process
* Proficiency lists are now dynamically fetched from the database, allowing us to add or remove new proficiencies as we see fit.
* In the front-end, proficiencies are now based on a scale of 1-4, with 1 being beginner and 4 being master.
* The user gets a visual feedback in a form of a label being updated via JavaScript as the user moves the proficiency slider
* Lots of back end fixes and corrections
* atec.sql updated to reflect the latest database 

####2 November 2012
* Implemented recent projects list in the front page
* Sign up page now has back buttons before AJAX is sent
* Proficiencies and interests have been redesigned from the ground up
* Back-end coded added to support project suggestion feature
* Project image resizing based on the GD Library implemented
* Projects tiles now appear when the user creates a project
* Small backend fixes
* The callback process altered so that a centralized method (/auth) is 
now used to handle login/logout process



##Deployment Guide
#### Requirements
* PHP 5.2+ with cURL+, Apache with mod_rewrite, MySQL.
* Codeigniter 2.1.3 (included)


1. Import the SQL file located in the root of the project (atecx.sql). This will set up the database
structure ATECX needs.

2. Navigate to /src/application/config/database.php and change following lines to properly 
refelct your database setup:
```php
	$db['default']['hostname'] = 'localhost';
	$db['default']['username'] = 'root';
	$db['default']['password'] = '';
	$db['default']['database'] = 'atecx';
	$db['default']['dbdriver'] = 'mysql';
```			
			
3. Navigate to /src/application/helpers/utils_helper.php and edit the following line to point it to the correct callback URL for Twitter:
```php
define('CALLBACK_URL','http://example.com/atecx/callback'); // the callback URL for Twitter's OAuth
```


##Tutorial: Extending the functionalities of ATECX

###Adding a new "stats" page
Even if you're not familiar with Codeigniter, extending the functionality of ATECX should be very, very simple to undertake. Say you want to to create a page to display site stats like the number of users there are in ATECX. Following the principles of the MVC pattern, this could be accomplished by a few easy steps.

1. First off, let's create a method in our `user_model` located in `application/models/user_model.php`. This method will
tap into the database to retrieve the number of users our app has that will ultimately be displayed to the user.
	```php
	/* application/models/user_model.php */

	/* ... */

	function getMemberCount()
	{
		// Build a query to count the number of people using ATECX
		$this->db->select("COUNT(user_id) as numUsers");
		$this->db->from('users');

		// execute the query
		$query = $this->db->get();
		
		// uh oh, something went wrong
		if ($query->num_rows() <= 0)
		{
			return false;
		}

		// We have the count, return it!
		$result = $query->row();
		return $result->numUsers;		
	}
	```

3. Next, create a controller for the "stats" page. To do this, create a file called `stats.php`
file in the `application/controllers` directory. In this controller, we will create one method called "users" that
will display the number of users/members in ATECX:

	```php
	/* application/controllers/stats.php */
	<?php
	
	
	class Stats extends CI_Controller {

			public function users()
			{
				// Get the requested data from our model
				$numUsers = $this->User_model->getMemberCount();

				// Build our view. We will attach two files from our /assets directroy
				// that will customize the look and functionality of our view

				// Attach a css called status.css to our view
				$header['css'] = array('stats');

				// Attach a js called status.js to our view
				$footer['js'] = array('stats');

				// Attach view-specific content
				$content['numUsers'] = $numUsers;

				// Now begin loading our view
				$this->load->view('_template/header',$header);
				$this->load->view('status_view',$content);
				$this->load->view('_template/viewer',$footer);

				
			}
		}
	?>
	```
Codeigniter will automatically route `stats/users` to the method we just created. That is, if the user navigates to  `http://atecxexample.com/stats/users`, the method we just created would be executed! However, if 
you feel comfortable with Codeigniter, you can head on to `application/config/routes.php` to set up custom routes to
this controller. It's all up to you. For more information about routing, check out this link: http://codeigniter.com/user_guide/general/routing.html

3. Next, we'll create our view. The view will be responsible for  presenting the data retrieved to the user in a friendly format. The view does not have access to any assets in the model other than what was supplied to it 
from the controller we created. Create a file called `status_view.php` under `application/views/`. Listen up! Naming conventions matter in Codeigniter. Go back to step two and examine the following line:
```php 
$this->load->view('status_view',$content);
```
When this is called, Codeigniter will automatically search for a file called `status_vew` in `application/views/`. Expect to run into errors if you neglect to maintain a consistent name between the view and the controller. You'll also want to create `css` and `js` files named `stats` and put them under the `/assets/js` and `/assets/css` folders respectively. They'll be automatically attached to the header and footer as our controller builds the view.

Back to `status_view.php`, we'll add some required HTML markup:
```HTML
<div id="content">
	<div class="content">
		<!-- STUFF GOES HERE -->
	</div>
</div>
```

All of the views in ATECX begin with the format above. All of the method specific code, in this case the number of users to be displayed to the user, will go under the `<div class="content">` element:

```HTML
<div id="content">
	<div class="content">
		<h1><?php echo $numUsers; ?></h1>
	</div>
</div>
```

And that's all there is to it! To recap, as soon as the user naviates to `http://.../stats/users`, the routing engine
will the users `users()` method. The `users()` method will in turn call our model called `users_model` and retrieve the number of 
members in ATECX and return it to the controller. The controller, will then build the view  called `stats_view` and attach the 
content retrieved from the model to be displayed to the user.  


###Resources
http://codeigniter.com/user_guide/general/models.html
http://codeigniter.com/user_guide/general/urls.html
http://codeigniter.com/user_guide/general/controllers.html

## Upgrading Codeigniter
Codeigniter's modular nature allows it to be upgraded without affecting the user application. The core
components of ATECX ( with the exception of assets/  and appData/ directory) are all stored in the applications
directory

Assuming the future versions of Codeigniter will be backwards compatible with 2.1.3, you can download the latest stable release and simply replace the system/ directory with the newer version. 
