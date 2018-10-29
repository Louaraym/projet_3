<?php
namespace loray\projet_3;

class Autoloader
{
	public static function register()
	{
		spl_autoload_register(array(__CLASS__, 'autoload'));
	}
	
    private static  function autoload($class_name)
	{
		$class_name = str_replace(__NAMESPACE__ . '\\', '',$class_name);
		$class_name = str_replace('\\', '/', $class_name);
		require 'model/'.$class_name.'.php';	
	}  
	
}