<?php

define('MISTYFORMS_PATH', __DIR__);

// Mini class loader, feel free to use your own
spl_autoload_register(function($class){

	if( substr( $class, 0, 11 ) !== 'MistyForms\\' ) return false;
	$path = MISTYFORMS_PATH . '/../' . str_replace( '\\', '/', $class ) . '.php';

	if( file_exists( $path ) )
		require $path;
	else
	{
		echo $path;
		return false;
	}
});
