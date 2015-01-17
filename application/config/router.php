<?php

RouterMap::AddRoute('blog/{postName}', array(
	'controller' => 'blog',
	'action' => 'view'
));

RouterMap::AddRoute('{directory}/{controller}/{action}', array(
	'controller' => 'home',
	'action' => 'index'
));

/*
RouterMap::AddRoute('{controller}/{action}', array(
	'controller' => 'home',
	'action' => 'index'
));
*/