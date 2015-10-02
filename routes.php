<?php

//Router map scanner
class RouterCheck
{
	private $array = ['.', '..'];

	public $routes = [];

	public function scanDir($path = '/')
	{
		//Load all needed apps
		foreach(scandir(__DIR__.'/routes'.$path, 1) AS $file)
		{
			if(!in_array($file, $this->array))
			{
				$test = explode('.', $file);

				if(isset($test[1]))
					array_push($this->routes, __DIR__.'/routes'.$path.$file);
				else
					$this->scanDir($path.$file.'/');
			}	
		}
	}
}

$dircheck = new RouterCheck;
$dircheck->scanDir();
foreach($dircheck->routes AS $route)
{
	require_once($route);
}