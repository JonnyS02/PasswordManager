<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/', 'Home::index');
$routes->post('/login', 'Home::index');
$routes->get('/login', 'Home::index');
$routes->get('/register', 'Register::index');
