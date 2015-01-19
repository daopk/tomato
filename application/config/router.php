<?php

RouterMap::AddRoute('blog/{postName}', array(
	'controller' => 'blog',
	'action' => 'view',
	'template' => 'default'
));

RouterMap::AddRoute('{directory}/{controller}/{action}', array(
	'controller' => 'home',
	'action' => 'index',
	'template' => 'default'
));

/*
RouterMap::AddRoute('{controller}/{action}', array(
	'controller' => 'home',
	'action' => 'index'
));
*/