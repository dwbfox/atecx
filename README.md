ATEC Experimental





Deployment Guide
_______________________

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
