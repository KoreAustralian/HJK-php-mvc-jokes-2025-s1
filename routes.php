<?php
/**
 * Add Routes to Router
 *
 * Adds routes to the $router (instantiated in public/index.php)
 * to allow the calling of the appropriate method
 *
 * Filename:        routes.php
 * Location:        /
 * Project:         XXX-SaaS-Vanilla-MVC-YYYY-SN
 * Date Created:    20/08/2024
 *
 * Author:          Adrian Gould <Adrian.Gould@nmtafe.wa.edu.au>
 *
 */

$router->get('/', 'HomeController@index');

$router->get('/auth/register', 'UserController@create', ['guest']);
$router->get('/auth/login', 'UserController@login', ['guest']);

$router->post('/auth/register', 'UserController@store', ['guest']);
$router->post('/auth/logout', 'UserController@logout', ['auth']);
$router->post('/auth/login', 'UserController@authenticate', ['guest']);

$router->get('/auth/edit', 'UserController@edit', ['auth']);
$router->post('/auth/edit', 'UserController@update', ['auth']);

/**
 * Example Routes for a feature (Feature)
 *
 * $router->HTTP_METHOD('PATH', 'CONTROLLER_NAME@METHOD', OPTIONAL_MIDDLEWARE)
 *
 * PATH is based on the pluralised version of the FEATURE_NAME
 * CONTROLLER_NAME is usually in the form "NAME" in Pascal Case with Controller added
 * METHOD is the Controller Class method (function) that is called
 * OPTIONAL_MIDDLEWARE indicates if middleware is used for example to ensure a user is authenticated, or is a guest
 */
$router->get('/features', 'FeatureController@index');
$router->get('/features/create', 'FeatureController@create', ['auth']);
$router->get('/features/edit/{id}', 'FeatureController@edit', ['auth']);
$router->get('/features/search', 'FeatureController@search');
$router->get('/features/{id}', 'FeatureController@show');

$router->post('/features', 'FeatureController@store', ['auth']);
$router->put('/features/{id}', 'FeatureController@update', ['auth']);
$router->delete('/features/{id}', 'FeatureController@destroy', ['auth']);

/** 
 * Example Product Feature Routes 
 */
$router->get('/products', 'ProductController@index');
$router->get('/products/create', 'ProductController@create', ['auth']);
$router->get('/products/edit/{id}', 'ProductController@edit', ['auth']);
$router->get('/products/search', 'ProductController@search');
$router->get('/products/{id}', 'ProductController@show');

$router->post('/products', 'ProductController@store', ['auth']);
$router->put('/products/{id}', 'ProductController@update', ['auth']);
$router->delete('/products/{id}', 'ProductController@destroy', ['auth']);


/**
 * Joke feature routes
 */
$router->get('/jokes', 'JokeController@index');

$router->get('/jokes/create', 'JokeController@create', ['auth']);
$router->post('/jokes', 'JokeController@store', ['auth']);

$router->get('/jokes/{id}', 'JokeController@show');

$router->get('/jokes/about', 'StaticPageController@about');

$router->get('/jokes/edit/{id}', 'JokeController@edit', ['auth']);
$router->post('/jokes/edit/{id}', 'JokeController@update', ['auth']);

$router->post('/jokes/delete/{id}', 'JokeController@destroy', ['auth']);