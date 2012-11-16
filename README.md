#ATEC Experimental


  
##Changelog

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

## Upgrading Codeigniter
Codeigniter's modular nature allows it to be upgraded without affecting the user application. The core
components of ATECX ( with the exception of assets/  and appData/ directory) are all stored in the applications
directory

Assuming the future versions of Codeigniter will be backwards compatible with 2.1.3, you can download the latest stable release and simply replace the system/ directory with the newer version. 
