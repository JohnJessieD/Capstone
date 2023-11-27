<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->match(['post','get'],'/api/register', 'Usercontroller::register');
$routes->match(['post','get'],'/api/login', 'Usercontroller::login');
$routes->match(['post','get'],'/api/UserList', 'Admin::Userlist');