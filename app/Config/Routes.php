<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->post('/', 'Login::index');

$routes->get('/login', 'Login::index');
$routes->post('/login', 'Login::index');

$routes->get('/register', 'User::index');
$routes->post('/register', 'User::index');

$routes->get('/home', 'Home::index');
$routes->post('/home', 'Home::index');

$routes->get('/insertPassword', 'Home::insertPassword');
$routes->post('/insertPassword', 'Home::insertPassword');

$routes->get('/deletePassword', 'Home::deletePassword');
$routes->post('/deletePassword', 'Home::deletePassword');

$routes->get('/deleteUser', 'Home::index');
$routes->post('/deleteUser', 'Home::deleteUser');

$routes->get('/editProfile', 'User::editProfile');
$routes->post('/editProfile', 'User::editProfile');

$routes->get('/insertChangesProfile', 'User::insertChangesProfile');
$routes->post('/insertChangesProfile', 'User::insertChangesProfile');

$routes->get('/password', 'Home::password');
$routes->post('/password', 'Home::password');

$routes->post('/isverified', 'Email::isVerified');
$routes->get('/isverified', 'Email::isVerified');

$routes->post('/verify', 'Email::verify');
$routes->get('/verify', 'Email::verify');

$routes->post('/verified', 'Email::verified');
$routes->get('/verified', 'Email::verified');