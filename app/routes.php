<?php

$router->add('hot/{page?}', 'AppController@hot');

$router->add('seg/{title}', 'AppController@show');

$router->add('search/{query}/{age}/{gender}/{page?}', 'AppController@search');

$router->add('create', 'AppController@create');

$router->add('vote', 'AppController@vote');

$router->add('mod', 'AppController@mod');

$router->add('post_mod', 'AppController@post_mod');

$router->add('/{page?}', 'AppController@index');