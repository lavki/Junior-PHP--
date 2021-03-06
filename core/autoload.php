<?php

$namespaces = function ($path) {
	if (preg_match('/\\\\/', $path))
	{
		$path = str_replace('\\', DIRECTORY_SEPARATOR, $path);
	}

	if (file_exists("{$path}.php"))
	{
		require_once("{$path}.php");
	}
};

spl_autoload_register($namespaces);

$underscores = function ($classname) {
	$path = str_replace('_', DIRECTORY_SEPARATOR, $classname);
	$path = __DIR__ . "/$path";

	if (file_exists("{$path}.php"))
	{
		require_once("{$path}.php");
	}
};

spl_autoload_register($underscores);