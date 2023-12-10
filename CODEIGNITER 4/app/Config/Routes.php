<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->match(['post','get'],'/api/register', 'Usercontroller::register');
$routes->match(['post','get'],'/api/login', 'Usercontroller::login');
$routes->match(['post','get'],'/api/UserList', 'Admin::Userlist');
$routes->match(['post', 'get'], '/api/users', 'UserController::getUsers');
$routes->get('/api/sales/(:any)', 'ProductController::getSales/$1');
$routes->match(['get', 'post'], '/api/isales', 'ProductController::isales');
$routes->match(['get', 'post'], '/api/setsales/(:any)', 'ProductController::setsales/$1');
$routes->match(['get', 'post'], '/api/getProducts', 'ProductController::getProducts');
$routes->match(['get', 'post'], '/api/updateQuantity', 'ProductController::updateQuantity');
$routes->match(['get', 'post'], '/api/audit/(:any)', 'ProductController::audit/$1');
$routes->match(['get', 'post'], '/api/newproduct', 'ProductController::newproduct');
$routes->put('api/updateproduct/(:num)', 'ProductController::updateProduct/$1');
$routes->match(['get', 'post'], '/api/products', 'ProductController::getProducts');