<?php

declare(strict_types=1);

use CodeIgniter\Router\RouteCollection;

/**
 * Routes configuration
 *
 * @var RouteCollection $routes
 */

// --------------------------------------------------------------------
// Public routes
// --------------------------------------------------------------------

// Home (landing page)
$routes->get('/', 'Home::index');

// Beta programme sign-up form submission
$routes->post('signup', 'Home::signup');

// Redirect any other request to the homepage
$routes->set404Override('Home::index');
