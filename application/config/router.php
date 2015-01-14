<?php

RouterMap::AddRoute('blog/{postName}', array(
	'controller' => 'blog',
	'action' => 'view'
));

RouterMap::AddRoute('{controller}/{action}', array(
	'controller' => 'home',
	'action' => 'index'
));