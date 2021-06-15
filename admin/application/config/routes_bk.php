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
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['get-search'] = 'home/get_search';
$route['load-more-search'] = 'home/load_more_search';

// User Auth API Routes
$route['login'] = 'auth/login_page';
$route['forgot-password'] = 'auth/forgot_password_request';
$route['verify-token/(:any)'] = 'auth/veify_request_token';
$route['update-password'] = 'auth/update_password';
$route['logout'] = 'auth/logout_user';

// Admin Routes
$route['admin'] = 'admin/business_profiles';
$route['admin/businesses'] = 'admin/business_profiles';
$route['admin/business/notes/(:num)'] = 'admin/get_business_notes';
$route['admin/businesses/page/(:num)'] = 'admin/business_profiles';
$route['admin/business/add'] = 'admin/add_business';
$route['admin/business/edit/(:num)'] = 'admin/edit_business';
$route['admin/business/update'] = 'admin/updateBusiness';
$route['admin/business/add-new'] = 'admin/saveBusiness';
$route['business/add-new'] = 'home/saveBusiness';

$route['admin/business/primary-category'] = 'admin/business_category';
$route['admin/business/primary-category/page/(:num)'] = 'admin/business_category';

$route['admin/business/secodary-category'] = 'admin/business_secodary_category';
$route['admin/business/secodary-category/page/(:num)'] = 'admin/business_secodary_category';

$route['admin/users'] = 'admin/users';
$route['admin/settings'] = 'admin/settings';
$route['admin/upload_logo'] = 'settings/upload_logo';
$route['admin/import-businesses'] = 'admin/import_businesses';
$route['admin/update-business-count'] = 'admin/update_business_count';