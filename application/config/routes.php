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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'welcome';
$route['translate_uri_dashes'] = FALSE;

$route['underwriter/(:any)'] = 'underwriter/index/$1';
$route['underwriter/(:any)/(:any)'] = 'underwriter/index/$1/$2';

$route['form_listing/(:any)'] = 'form_listing/index/$1';
$route['form_listing/(:any)/(:any)'] = 'form_listing/index/$1/$2';

$route['operation/(:any)'] = 'operation/index/$1';
$route['operation/(:any)/(:any)'] = 'operation/index/$1/$2';

$route['services/(:any)'] = 'services/index/$1';
$route['services/(:any)/(:any)'] = 'services/index/$1/$2';

$route['claims/(:any)'] = 'claims/index/$1';
$route['claims/(:any)/(:any)'] = 'claims/index/$1/$2';

$route['renewals/(:any)'] = 'Renewals/index/$1';
$route['renewals/(:any)/(:any)'] = 'Renewals/index/$1/$2';

$route['Products/(:any)'] = 'Products/index/$1';
$route['Products/(:any)/(:any)'] = 'Products/index/$1/$2';

$route['EnableProducts/(:any)'] = 'Products/update/$1';
$route['DisableProducts/(:any)'] = 'Products/updatedisable/$1';

$route['griveance_customer_services/(:any)'] = 'Grievance/index/$1';
$route['editsaleclosure/(:any)'] = 'form_listing/subadminedit/$1';
$route['add_form/(:any)'] = 'form/index/$1';
$route['admin/old_form'] = 'form/old_form';
$route['addmanager'] = 'manager/addmanager';
$route['getcity'] = 'city/getcity';
$route['initiate_claim/(:any)'] = 'claims/initiate_claim/$1';
$route['showclaimdetails/(:any)'] = 'claims/showclaimdetails/$1';
$route['searchforclaim'] = 'claims/searchclaim';
$route['view_ticket_details/(:any)'] = 'grievance/view_ticket/$1';
$route['form_listing/(:any)'] = 'form_listing/index/$1';
$route['view_sale/(:any)'] = 'form_listing/view_sale/$1';
