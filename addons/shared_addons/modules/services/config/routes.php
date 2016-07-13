<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
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
| 	www.your-site.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://www.codeigniter.com/user_guide/general/routing.html
*/

$route['produkhukum/index'] = "produkhukum/index";
$route['produkhukum/admin'] = "produkhukum/admin";
$route['produkhukum/index/(:num)'] = "produkhukum/index/$1";

$route['produkhukum/hit'] = "produkhukum/hit";
$route['produkhukum/hit/(:num)'] = "produkhukum/hit/$1";
$route['produkhukum/hit/(:num)/(:num)'] = "produkhukum/hit/$1/$2";
$route['produkhukum/mostdownload'] = "produkhukum/mostdownload";
$route['produkhukum/mostdownload/(:num)'] = "produkhukum/mostdownload/$1";
$route['produkhukum/mostdownload/(:num)/(:num)'] = "produkhukum/mostdownload/$1/$2";

$route['produkhukum/download/(:num)/(:any)'] = "produkhukum/download/$1/$2";

$route['produkhukum/listings'] = "produkhukum/listings";
$route['produkhukum/search'] = "produkhukum/search";
$route['produkhukum/search/(:num)'] = "produkhukum/search/$1";
$route['produkhukum/search/(:num)/(:num)'] = "produkhukum/search/$1/$2";
$route['produkhukum/search/(:num)/(:num)/(:any)'] = "produkhukum/search/$1/$2/$3";
$route['produkhukum/listings/details/(:num)'] = "produkhukum/details/$1";
$route['produkhukum/listings/page/(:num)'] = "produkhukum/index/$1";
$route['produkhukum/year/(:num)'] = "produkhukum/year/$1";
$route['produkhukum/year/(:num)/(:num)'] = "produkhukum/year/$1/$2";
$route['produkhukum/year/(:num)/(:num)/(:num)'] = "produkhukum/year/$1/$2/$3";

$route['produkhukum/rss/index'] = "produkhukum/rss";
$route['produkhukum/rss/all.rss'] = "produkhukum/rss";
$route['produkhukum/rss/(:any).rss'] = "produkhukum/rss/category/$1";

// Category routes 
$route['produkhukum/category/(:any)/(:num)'] = "produkhukum/category/$1/$2"; // Paginated category routes
$route['produkhukum/category/(:any)'] = "produkhukum/category/$1"; // Main category page

// Archive routes
$route['produkhukum/archive/(:num)/(:num)/(:num)'] = "produkhukum/archive/$1/$2"; // Paginated pages
$route['produkhukum/archive/(:num)/(:num)'] = "produkhukum/archive/$1/$2"; // Main archive pages

$route['produkhukum/(:any)'] = "produkhukum/view/$1";
?>