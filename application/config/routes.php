<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
// $route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['default_controller'] = 'Home';

//Dashboard
$route['dashboard'] = 'dashboard/Dashboard_controller';
$route['dashboard/appraiser_and_moderator'] = 'dashboard/Dashboard_controller/appraiser_and_moderator';
$route['dashboard/appraiser_and_moderator/add'] = 'dashboard/Dashboard_controller/add_appraiser_and_moderator';

//Personal file
$route['personal_file'] = 'personal_file/PersonalFile_controller';


//Performance Appraisal
$route['performance_appraisal'] = 'performance/Performance_Appraisal_controller';
$route['performance_appraisal/add_appraisee_details'] = 'performance/Performance_Appraisal_controller/add_appraisee_details';
$route['performance_appraisal/appraisee_details/edit/(\d+)'] = 'performance/Performance_Appraisal_controller/edit_appraisee_details/$1';
$route['performance_appraisal/appraiser_details/(\d+)/(:any)'] = 'performance/Performance_Appraisal_controller/appraiser_details/$1/$2';
$route['performance_appraisal/appraiser_details/update/(\d+)'] = 'performance/Performance_Appraisal_controller/update_appraiser_details/$1';

//account
$route['login_form'] = 'account/Account_controller/login_form';
$route['login'] = 'account/Account_controller/login';
$route['logout'] = 'account/Account_controller/logout';
$route['profile'] = 'account/Account_controller/profile';