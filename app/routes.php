<?php

$router->add('/', 'AppController@index');

$router->add('seg/:title', 'AppController@show');

$router->add('search/:query/:age/:gender/:page', 'AppController@search');

$router->add('create', 'AppController@create');

$router->add('vote', 'AppController@vote');

$router->add(':page', 'AppController@pages');