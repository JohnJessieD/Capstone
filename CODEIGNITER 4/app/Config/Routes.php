<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->match(['post','get'],'/api/register', 'Usercontroller::register');
$routes->match(['post','get'],'/api/login', 'Usercontroller::login');


$routes->get('/api/sales/(:any)', 'Home::getSales/$1');
$routes->match(['get', 'post'], '/api/isales', 'Home::isales');
$routes->match(['get', 'post'], '/api/setsales/(:any)', 'Home::setsales/$1');
$routes->match(['get', 'post'], '/api/getProducts', 'Home::getProducts');
$routes->match(['get', 'post'], '/api/updateQuantity', 'Home::updateQuantity');
$routes->match(['get', 'post'], '/api/audit/(:any)', 'Home::audit/$1');
$routes->match(['get', 'post'], '/api/newproduct', 'Home::newproduct');
$routes->put('api/updateproduct/(:num)', 'Home::updateProduct/$1');
$routes->match(['get', 'post'], '/api/products', 'Home::getProducts');



//$routes->get('/api/sales/(:any)', 'ProductController::getSales/$1');
//$routes->match(['get', 'post'], '/api/isales', 'ProductController::isales');
//$routes->match(['get', 'post'], '/api/setsales/(:any)', 'ProductController::setsales/$1');
//$routes->match(['get', 'post'], '/api/getProducts', 'ProductController::getProducts');
//$routes->match(['get', 'post'], '/api/updateQuantity', 'ProductController::updateQuantity');
//$routes->match(['get', 'post'], '/api/audit/(:any)', 'ProductController::audit/$1');
//$routes->match(['get', 'post'], '/api/newproduct', 'ProductController::newproduct');
//$routes->put('api/updateproduct/(:num)', 'ProductController::updateProduct/$1');
//$routes->match(['get', 'post'], '/api/products', 'ProductController::getProducts');

$routes->post('/api/create', 'Usercontroller::create_user');
$routes->put('/api/updateuser/(:num)', 'Usercontroller::update_user/$1');
$routes->delete('/api/deleteuser/(:num)', 'Usercontroller::delete_user/$1');


$routes->get('/api/users', 'Usercontroller::users');

$routes->get('/api/branch', 'BranchController::index');      // Route to fetch all branches
$routes->post('/api/create', 'BranchController::create'); // Route to create a new branch