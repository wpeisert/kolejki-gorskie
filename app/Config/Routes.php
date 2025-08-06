<?php

use App\Controllers\Api\Coasters;
use App\Controllers\Api\Wagons;
use CodeIgniter\Router\RouteCollection;
use App\Controllers\Pages;
use App\Controllers\News;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('news', [News::class, 'index']);
$routes->get('news/new', [News::class, 'new']);
$routes->post('news', [News::class, 'create']);
$routes->get('news/(:segment)', [News::class, 'show']);

$routes->get('pages', [Pages::class, 'index']);
$routes->get('(:segment)', [Pages::class, 'view']);


$routes->post('api/coasters', [Coasters::class, 'create']);
$routes->put('api/coasters/(:num)', [Coasters::class, 'update']);

$routes->post('api/coasters/(:num)/wagons', [Wagons::class, 'create']);
$routes->delete('api/coasters/(:num)/wagons/(:num)', [Wagons::class, 'delete']);
