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

$routes->get('/home', 'home::index');
$routes->post('/home', 'home::index');

$routes->get('/insertPassword', 'home::insertPassword');
$routes->post('/insertPassword', 'home::insertPassword');

$routes->get('/deletePassword', 'home::deletePassword');
$routes->post('/deletePassword', 'home::deletePassword');

$routes->get('/deleteUser', 'home::index');
$routes->post('/deleteUser', 'home::deleteUser');

$routes->get('/editProfile', 'user::editProfile');
$routes->post('/editProfile', 'user::editProfile');

$routes->get('/insertChangesProfile', 'user::insertChangesProfile');
$routes->post('/insertChangesProfile', 'user::insertChangesProfile');