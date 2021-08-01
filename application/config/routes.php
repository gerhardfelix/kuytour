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
$route['default_controller'] = 'auth/login';

/*
| -------------------------------------------------------------------------
| Mobil Routes
| -------------------------------------------------------------------------
*/
$route['mobil/create'] = 'mobil/create';
$route['mobil/edit_mobil'] = 'mobil/edit_mobil';
$route['mobil/(:any)'] = 'mobil/view/$1';
$route['mobil'] = 'mobil';
$route['api/mobil_api/mobil/(:num)'] = 'api/mobil_api/mobil/slug/$1'; 

/*
| -------------------------------------------------------------------------
| Supir Routes
| -------------------------------------------------------------------------
*/
$route['supir/create'] = 'supir/create';
$route['supir/edit_supir'] = 'supir/edit_supir';
$route['supir/(:any)'] = 'supir/view/$1';
$route['supir'] = 'supir';
$route['api/supir_api/supir/(:num)'] = 'api/supir_api/supir/id/$1';


/*
| -------------------------------------------------------------------------
| Pesanan Mobil Routes
| -------------------------------------------------------------------------
*/
$route['pesanan_mobil/create'] = 'pesanan/create';
$route['pesanan_mobil/edit_pesanan_mobil/(:any)'] = 'pesanan/edit_pesanan_mobil/$1';
$route['pesanan_mobil/delete_pesanan_mobil/(:any)'] = 'pesanan/delete_pesanan_mobil/$1';
$route['pesanan_mobil/(:any)'] = 'pesanan/view_pesanan_mobil/$1';
$route['pesanan_mobil'] = 'pesanan';
$route['api/pesanan_api/pesanan_mobil/(:num)'] = 'api/pesanan_api/pesanan_mobil/id/$1';

/*
| -------------------------------------------------------------------------
| Pelanggan REST API Routes
| -------------------------------------------------------------------------
*/

$route['api/pelanggan_api/pelanggan/(:num)'] = 'api/pelanggan_api/pelanggan/slug/$1';
$route['api/pelanggan_api/pelanggan/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/pelanggan_api/pelanggan/slug/$1/format/$3$4'; 
