<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->post('/login', 'Login::login');

$routes->get('/home', 'Home::index');
$routes->post('/insertPassword', 'Home::insertPassword');
$routes->get('/deletePassword', 'Home::deletePassword');
$routes->get('/deleteUser', 'Home::index');
$routes->post('/deleteUser', 'Home::deleteUser');
$routes->get('/password', 'Home::password');
$routes->post('/password', 'Home::password');

$routes->get('/register', 'User::index');
$routes->post('/register', 'User::index');
$routes->get('/editProfile', 'User::editProfile');
$routes->post('/editProfile', 'User::editProfile');
$routes->post('/insertChangesProfile', 'User::insertChangesProfile');

$routes->post('/isverified', 'VerifyEmail::isVerified');
$routes->get('/verify', 'VerifyEmail::verify');
$routes->get('/verified', 'VerifyEmail::verified');

$routes->get('/resetPassword','ResetPassword::index');
$routes->post('/isReset','ResetPassword::isReset');
$routes->get('/resetVerified','ResetPassword::resetVerified');
$routes->get('/insertResetPassword', 'ResetPassword::insertResetPassword');
$routes->post('/submitResetPassword', 'ResetPassword::submitResetPassword');
$routes->get('/abortReset', 'ResetPassword::abortReset');

$routes->get('/backUp','BackUpTrigger::index');

$routes->get('/autoDeleteUser','DeleteUserTrigger::index');


