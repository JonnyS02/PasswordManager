<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->post('/', 'Login::index');

$routes->get('/login', 'Login::index');
$routes->post('/login', 'Login::index');

$routes->get('/register', 'user::index');
$routes->post('/register', 'user::index');
