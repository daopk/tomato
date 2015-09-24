<?php

Router_TM_Module::AddRoute('{directory}/{controller}/{action}', array(
    'directory' => '',
    'controller' => 'home',
    'action' => 'index',
    'template' => 'front'
));