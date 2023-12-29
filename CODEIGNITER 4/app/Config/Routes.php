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
$routes->get( '/api/products', 'ProductController::Products');
$routes->post('/api/submitOrder', 'OrderController::submitOrder');
$routes->get('/api/highest-bought-product', 'ProductController::highestBoughtProduct');
$routes->get('/api/orders', 'OrderController::orders');
$routes->get('/api/search', 'ProductController::search');
$routes->get('/api/orderProducts', 'ProductController::orderProducts');

$routes->get('/api/user/profile', 'UserController::getUserProfile'); 
$routes->post('/api/profile', 'UserController::updateUserProfile');
$routes->get('/api/FindOrders', 'OrderController::FindOrders');
$routes->delete('/api/products/{id}', 'ProductController::removeProduct/$1');
$routes->delete('/api/products/delete/(:num)', 'ProductController::removeProduct/$1');
$routes->get('/api/branch', 'BranchController::index');
$routes->post('/api/create', 'BranchController::create');
$routes->put('/api/update/(:num)', 'RiderPanelController::update/$1');

$routes->get('orders/(:segment)', 'ProductController::index/$1');
$routes->put('orders/update/(:num)', 'ProductController::update/$1');

$routes->post('/api/add-product', 'ProductController::addProduct');
$routes->post('/api/create', 'UserController::create_user'); // Route to create a new user
$routes->put('/api/update_user/(:num)', 'UserController::update_user/$1'); // Route to update a user by ID
$routes->delete('/api/delete/(:num)', 'UserController::delete_user/$1'); // Route to delete a user by ID

$routes->get('/api/users', 'Usercontroller::users');
$routes->get('api/addons', 'OrderController::addons');


$routes->delete('/api/OrderedProducts/{id}', 'OrderController::cancelOrder/$1');
$routes->get('/api/GetOrderDetails/(:num)', 'OrderController::getOrderDetails/$1');
$routes->get('/api/OrderDetails/{Id}', 'OrderController::OrderDetails');
$routes->post('/api/cancelOrder', 'OrderController::cancelOrder');
$routes->post('api/deleteOrder/(:num)', 'OrderController::deleteOrder/$1');
$routes->post('/api/placeOrder', 'OrderController::placeOrder');// app/Config/Routes.php

$routes->get('/api/highest-sales', 'OrderController::getHighestSales');
