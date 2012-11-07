#ATEC Experimental


##Changelog
#7 November 2012
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

#2 November 2012
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
Assuming you have MySQL, PHP ( +cURL), and Apache setup, you'll need to edit the following files
in order to get ATEC up and running in your environment.


0) Import the SQL file located in the root of the project (atecx.sql). This will set up the database
structure ATECX needs.

1) Navigate to /src/application/config/database.php and change following lines to properly 
refelct your database setup:
```php
	$db['default']['hostname'] = 'localhost';
	$db['default']['username'] = 'root';
	$db['default']['password'] = '';
	$db['default']['database'] = 'atecx';
	$db['default']['dbdriver'] = 'mysql';
```			
			
2) Navigate to /src/application/helpers/utils_helper.php and edit the following line to point it to the correct callback URL for Twitter:
```php
define('CALLBACK_URL','http://example.com/atecx/callback'); // the callback URL for Twitter's OAuth
```
