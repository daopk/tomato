<?php

require 'routerRequest.php';
/**
* Router
*/
class Router_TM_Module
{
    protected static $rules = [];

    function __construct()
    {
        $this->LoadRules();
    }

    public function Request()
    {
        $routerRequest = new RouterRequest_TM_Module(self::$rules);
        $route = $routerRequest->ApplyRule();

        $controller_m = Load_TM_Helper::module('controller');
        $controller_m->CheckRequest($route);
    }

    private function LoadRules()
    {
        if(file_exists(TOMATO_DIR_APP_CONFIG.'router.php'))
        {
            require TOMATO_DIR_APP_CONFIG.'router.php';
            $this->SortRules();
        }
        else throw new Exception("No route rule found!", 1);
    }

    private function SortRules()
    {
        $priorities = [];
        foreach (self::$rules as $index => &$rule) {
            $rule['prefix'] = $this->GetPrefixMap($rule['map']);
            if(!empty($rule['prefix']) && empty($rule['map']))
                $priorities[$index] = 0;
            else if(!empty($rule['prefix']) && !empty($rule['map']))
                $priorities[$index] = 1;
            else if(empty($rule['prefix']) && !empty($rule['map']))
                $priorities[$index] = 2;
        }
        array_multisort($priorities, self::$rules);
    }

    private function GetPrefixMap(&$map)
    {
        $beginMap = strpos($map, '{');
        if($beginMap === false)
            $beginMap = strlen($map);
        $prefix = '';
        if($beginMap)
        {
            $prefix = substr($map, 0, $beginMap);
            $map = (string)substr($map, $beginMap);
        }
        return $prefix;
    }

    public static function AddRoute($rule_map, array $rule_default)
    {
        self::$rules[] = ['map' => $rule_map, 'default' => $rule_default];
    }
}