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
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// User Auth API Routes
$route['login'] = 'auth/index';
$route['sign-up'] = 'auth/signup_page';
$route['verify/(:any)'] = 'auth/veify_user';
$route['forgot-password'] = 'auth/forgot_password_request';
$route['verify-token/(:any)'] = 'auth/veify_request_token';
$route['update-password'] = 'auth/update_password';
$route['update-password/(:any)'] = 'auth/update_password';
$route['logout'] = 'auth/logout_user';

// Admin Routes
$route['dashboard'] = 'admin/dashboard';
$route['become-partner-list'] = 'admin/become_partner_list';
$route['become-partner-list/page/(:num)'] = 'admin/become_partner_list';
$route['focus-group-list'] = 'admin/focus_group_list';
$route['focus-group-list/page/(:num)'] = 'admin/focus_group_list';
$route['want-in-list'] = 'admin/want_in_list';
$route['want-in-list/page/(:num)'] = 'admin/want_in_list';

$route['users'] = 'admin/users';
$route['notifications'] = 'admin/notifications';
$route['settings'] = 'admin/settings';

// API
$route['focus-group-request'] = 'api/add_focus_group_list';
$route['become-partners-request'] = 'api/add_become_partner_list';
$route['want-in-request'] = 'api/add_want_in_list';
$route['donate-now'] = 'api/add_donate_now';
$route['get-settings'] = 'api/get_settings';