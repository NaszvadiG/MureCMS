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
$route['default_controller'] = 'Front';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//后台
$route['admin/manager/add'] = 'admin/managerAdd';
$route['admin/pages/addcate'] = 'admin/pagesAddCateView';
$route['admin/pages/editcate/(:any)'] = 'admin/pagesEditCateView/$1';
$route['admin/pages/(:any)'] = 'admin/pageslist/$1';
$route['admin/pages/add/(:any)'] = 'admin/pagesAddView/$1';
$route['admin/pages/edit/(:any)/(:any)'] = 'admin/pagesEditView/$1/$2';

$route['admin/articles/(:any)'] = 'admin/articleslist/$1';
$route['admin/articles/add/(:any)'] = 'admin/articlesAddView/$1';
$route['admin/articles/add/(:any)/(:any)'] = 'admin/articlesAddView/$1/$2';
$route['admin/articles/edit/(:any)'] = 'admin/articlesEditView/$1';
$route['admin/articles/edit/(:any)/(:any)'] = 'admin/articlesEditView/$1/$2';
$route['admin/articles/edit/(:any)/(:any)/(:any)'] = 'admin/articlesEditView/$1/$2/$3';
$route['admin/articles/(:any)/(:any)'] = 'admin/articleslist/$1/$2';


//前台
$route['pages/(:any)'] = 'FrontPages/index/$1';
$route['pages/(:any)/(:any)'] = 'FrontPages/index/$1/$2';

$route['articles'] = 'ArticlePages/GetArticleSimple';
$route['articles/(:any)'] = 'ArticlePages/index/$1';
$route['articles/(:any)/(:any)'] = 'ArticlePages/index/$1/$2';