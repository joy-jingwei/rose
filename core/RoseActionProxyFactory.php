<?php

RoseImporter::import ('core::RoseHTTPRequest');

class RoseActionProxyFactory
{
	private $_actionReflection;
	private $_controllerInstance;

	public function __construct ($controllerInstance, ReflectionMethod $actionReflection)
	{
		$this->_controllerInstance = $controllerInstance;
		$this->_actionReflection = $actionReflection;
	}

	public static function getProxy ($controllerFileFullName, $controllerName, $actionName)
	{
		static $cachedProxies = array ();
		$proxyCacheKey = join ('::', array ($controllerFileFullName, $controllerName, $actionName));
		if (!isset ($cachedProxies [$proxyCacheKey]))
		{
			$controllerCacheKey = $controllerFileFullName;
			static $cachedControllerInstance = array ();
			if (!isset ($cachedControllerInstance [$controllerCacheKey]))
			{
				require_cache ($controllerFileFullName);
				$cachedControllerInstance [$controllerCacheKey] = new $controllerName ();
			}
			$controllerInstance = $cachedControllerInstance [$controllerCacheKey];

			if (!is_callable(array ($controllerInstance, $actionName)))
			{
				trigger_error("{$controllerFileFullName}::{$actionName} nonexist or not callable");	
				return NULL;
			}

			$actionReflection = new ReflectionMethod ($controllerInstance, $actionName);
			$cachedProxies [$proxyCacheKey] = new self ($controllerInstance, $actionReflection);
		}

		return $cachedProxies [$proxyCacheKey];
	}

	public function invoke (RoseHTTPRequest $request)
	{
		return $this->_actionReflection->invokeArgs ($this->_controllerInstance, array ($request));
	}
}