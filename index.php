<?

	define('DS', DIRECTORY_SEPARATOR);
	spl_autoload_register(function ($class){
		require_once(str_replace('\\', '/', $class . '.php'));
	});
	new \Core\Routes;