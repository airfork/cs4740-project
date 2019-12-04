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
$route['default_controller'] = 'users/main_page';
$route['articles']['GET'] = 'articles/view_all';
$route['articles/checkout']['POST'] = 'articles/checkout';
$route['books']['GET'] = 'books/view_all';
$route['books/checkout']['POST'] = 'books/checkout';
$route['librarians/delete']['GET'] = 'librarians/delete';
$route['librarians/delete']['post'] = 'librarians/search';
$route['librarians/delete_book']['post'] = 'librarians/delete_book';
$route['librarians/delete_movie']['post'] = 'librarians/delete_movie';
$route['librarians/delete_article']['post'] = 'librarians/delete_article';
$route['librarians/insert']['GET'] = 'librarians/insert';
$route['librarians/insert_book']['POST'] = 'librarians/insert_book';
$route['librarians/insert_movie']['POST'] = 'librarians/insert_movie';
$route['librarians/insert_article']['POST'] = 'librarians/insert_article';
$route['login']['GET'] = 'users/index';
$route['login']['POST'] = 'users/login';
$route['logout']['GET'] = 'users/logout';
$route['movies/checkout']['POST'] = 'movies/checkout';
$route['movies']['GET'] = 'movies/view_all';
$route['register']['GET'] = 'librarians/register';
$route['register']['POST'] = 'librarians/create';
$route['search']['GET'] = 'users/search_page';
$route['search']['POST'] = 'users/search';
$route['spaces/reserve']['POST'] = 'spaces/reserve';
$route['spaces/remove_inventory']['POST'] = 'spaces/remove_inventory';
// $route['users/add_inventory']['POST'] = 'users/add_inventory';
$route['accountpage']['GET'] = 'users/accountpage';
$route['books/deadlines']['GET'] = 'books/deadline';
$route['checkouthistory']['GET'] = 'users/checkouthistory';
$route['editinfo']['GET'] = 'users/editinfo';
$route['editinfo']['POST'] = 'users/updateuser';
$route['download_bookhist']['GET'] = 'books/download_bookhist';
$route['download_ajhist']['GET'] = 'articles/download_ajhist';
$route['download_moviehist']['GET'] = 'movies/download_moviehist';
$route['download_studyhist']['GET'] = 'spaces/download_studyhist';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
