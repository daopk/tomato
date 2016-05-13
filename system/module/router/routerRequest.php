<?php

/**
* Router Request
*/
class RouterRequest_TM_Module
{
    private $url = '';
    private $rule;
    private $request;

    function __construct($rules)
    {
        if (isset($_SERVER['REQUEST_URI'])) {
            $this->url = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), '/');
        }

        $begin_path = strpos(rtrim(BASE_URL, '/'), '/', 8); // Remove http:// , https://
        if($begin_path !== false)
        {
            $sub_path = rtrim(substr(BASE_URL, $begin_path), '/');

            if(isset($_SERVER['REDIRECT_URL']) && strpos($_SERVER['REDIRECT_URL'], $sub_path) === 0)
                $this->url = substr($_SERVER['REDIRECT_URL'], strlen($sub_path));
        }

        $this->rule = $this->GetValidRule($rules, $this->url);
    }

    private function GetValidRule($rules, $url)
    {
        foreach ($rules as $key => $rule) {
            if($rule['prefix'])
            {
                if(strpos($url, rtrim($rule['prefix'], '/')) === 0)
                    return $rule;
                else continue;
            }
            return $rule;
        }
    }

    public function ApplyRule()
    {
        if(empty($this->rule))
            throw new Exception("No rule found!", 1);
        $this->request = $this->MappingRouteUrl($this->rule, $this->url);

        // Apply default value
        foreach ($this->rule['default'] as $key => $value) {
            if(empty($this->request[$key]))
                $this->request[$key] = $value;
        }

        return $this->request;
    }

    private function MappingRouteUrl($rule, $url)
    {
        $variables = $this->ExtractMapToVariables($rule['map']);
        $values = $this->ExtractUrlToVariables($url, $rule['prefix']);

        $directory = $this->CheckDirectory($variables, $values,
            isset($rule['default']['directory']) ? $rule['default']['directory'] : '');

        $result = array('directory' => $directory, 'params' => array());

        foreach ($values as $key => $value) {
            if(isset($variables[$key]))
                $result[$variables[$key]] = $value;
            else $result['params'][] = $value;
        }
        return $result;
    }

    private function CheckDirectory(&$vars, &$values, $default_dir)
    {
        foreach ($vars as $key => $variable) {
            if($variable == 'directory')
            {
                $dirIndex = $key;
                break;
            }
        }
        if(!isset($dirIndex)) return;

        $directory = ltrim(rtrim($default_dir, DS).DS, DS);

        if(sizeof($values) > $dirIndex)
        {
            for ($i = $dirIndex; $i <= sizeof($values); $i++) {
                if(is_dir(TOMATO_DIR_APP_CTRL.$directory.$values[$i]))
                {
                    $directory .= $values[$i].DS;
                    unset($values[$i]);
                }
                else break;
            }
        }
        unset($vars[$dirIndex]);
        $vars = array_values($vars);
        $values = array_values($values);
        return $directory;
    }

    private function ExtractMapToVariables($map)
    {
        if(empty($map))
            return array();
        $variables = explode('}', $map);
        foreach ($variables as $key => $variable) {
            if(empty($variable))
            {
                unset($variables[$key]);
                continue;
            }
            $beginPos = strpos($variable, '{');
            $variables[$key] = substr($variable, $beginPos + 1);
        }
        return array_values($variables);
    }

    private function ExtractUrlToVariables($url, $prefix)
    {
        if(!empty($prefix) && strpos($url, rtrim($prefix, '/')) === 0)
            $url = substr($url, strlen($prefix));
        $values = explode('/', $url);
        foreach ($values as $key => $value) {
            if($value === '')
                unset($values[$key]);
        }
        return array_values($values);
    }

    public function GetRoute()
    {
        return $this->request;
    }
}