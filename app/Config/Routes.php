<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->setAutoRoute(true);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.




// Room Routes (admin routes)
$routes->get('admin/rooms', 'Admin\RoomsController::index');
$routes->get('admin/rooms/create', 'Admin\RoomsController::create');
$routes->post('admin/rooms/store', 'Admin\RoomsController::store');
$routes->get('admin/rooms/edit/(:num)', 'Admin\RoomsController::edit/$1');
$routes->get('admin/rooms/delete/(:num)', 'Admin\RoomsController::delete/$1');
$routes->post('admin/update_room/(:num)', 'Admin\RoomsController::update/$1');

// Booking Routes
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    $routes->get('bookings', 'BookingsController::index');
    $routes->get('bookings/detail/(:num)', 'BookingsController::detail/$1');
    $routes->get('bookings/cancel/(:num)', 'BookingsController::cancel/$1');
    $routes->get('bookings/confirm/(:num)', 'BookingsController::confirm/$1');
});

// User Routes
// Routes for user
$routes->get('user/booking', 'User\BookingController::index');
$routes->post('user/booking/store', 'User\BookingController::store');
$routes->get('user/payment/(:num)', 'User\PaymentController::index/$1');
$routes->post('user/payment/confirm/(:num)', 'User\PaymentController::confirm/$1');
$routes->get('user/payment/success/(:num)', 'User\\PaymentController::success/$1');

// Authentication Routes
$routes->get('login', 'Admin\AuthController::login');
$routes->post('authenticate', 'Admin\AuthController::authenticate');
$routes->get('logout', 'Admin\AuthController::logout');
$routes->get('admin/register', 'Admin\AuthController::register');
$routes->post('admin/register', 'Admin\AuthController::register');
$routes->get('/', 'Admin\AuthController::login');
$routes->post('admin/send_verification_code', 'Admin\AuthController::sendVerificationCode');

// Dashboard Route
$routes->get('admin/dashboard', 'Admin\DashboardController::index');

// User Routes
$routes->get('admin/users', 'Admin\UsersController::index');
$routes->get('admin/users/edit/(:num)', 'Admin\UsersController::edit/$1');
$routes->post('admin/users/update/(:num)', 'Admin\UsersController::update/$1');
$routes->get('admin/users/delete/(:num)', 'Admin\UsersController::delete/$1');



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
