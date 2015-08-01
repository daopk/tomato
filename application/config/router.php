<?php

Router_TM_Module::AddRoute('{directory}/{controller}/{action}', [
    'directory' => '',
    'controller' => 'home',
    'action' => 'index',
    'template' => 'front'
]);