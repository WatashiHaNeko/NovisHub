<?php
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

$routes->setRouteClass(DashedRoute::class);

$routes->scope('/', function (RouteBuilder $builder) {
  $builder->registerMiddleware('csrf', new CsrfProtectionMiddleware([
    'httpOnly' => true,
  ]));

  $builder->applyMiddleware('csrf');

  $builder->connect('/', [
    'controller' => 'Home',
    'action' => 'index',
  ]);

  $builder->connect('/pages/*', [
    'controller' => 'Pages',
    'action' => 'display',
  ]);

  $builder->fallbacks();
});

$routes->prefix('settings', function (RouteBuilder $builder) {
  $builder->registerMiddleware('csrf', new CsrfProtectionMiddleware([
    'httpOnly' => true,
  ]));

  $builder->applyMiddleware('csrf');

  $builder->connect('/', [
    'controller' => 'Home',
    'action' => 'index',
  ]);

  $builder->fallbacks();
});

$routes->prefix('api', function (RouteBuilder $builder) {
  $builder->setExtensions(['json']);

  $builder->fallbacks(DashedRoute::class);
});

