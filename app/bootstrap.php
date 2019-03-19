<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 17/03/2019
 * Time: 12:45
 */

if (!function_exists('autoload')) {
    function autoload($className)
    {
        $className = ltrim($className, '');
        $fileName  = '';
        $namespace = '';
        if ($lastNsPos = strrpos($className, '')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName  = str_replace('', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }
        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
        $fileName = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . $fileName;
        require $fileName;
    }
    spl_autoload_register('autoload');
}

if (!function_exists("varz")) {
    /**
     * print_r and var_dump friendly
     * @param mixed $arg,...
     */
    function varz($arg)
    {
        $args = func_get_args();
        foreach ($args as $v) {
            echo "<pre>";
            if (is_object($v) || is_array($v))
                print_r($v);
            else
                var_dump($v);
            echo "</pre>";
        }
    }
}
if (!function_exists("varzx")) {
    /**
     * call varz function and exit
     * @param $arg,...
     */
    function varzx($arg)
    {
        $args = func_get_args();
        call_user_func_array('varz', $args);
        die();
    }
}
?>