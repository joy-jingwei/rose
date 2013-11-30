<?php

RoseImporter::import ('core::RoseProcessorAbstract');
RoseImporter::import ('lib::RoseActionProxyFactory');

class RoseActionInvokeProcessor extends RoseProcessorAbstract
{
	public function execute ()
	{
		$projectPath = _PROJECT_PATH_;
		$moduleName = 'group';
		$submoduleName = NULL;
		$controllerName = 'OnlineController';
		$actionName = 'get_index';

		$controllerFolder = 'controller';
		$controllerFileExtension = '.php';
		$controllerFileFullName = rtrim ($projectPath, DS) . DS;
		$controllerFileFullName .= ($moduleName ? $moduleName . DS : '');
		$controllerFileFullName .= ($submoduleName ? $submoduleName . DS : '');
		$controllerFileFullName .= $controllerFolder . DS;
		$controllerFileFullName .= $controllerName . $controllerFileExtension;

		$proxy = RoseActionProxyFactory::getProxy ($controllerFileFullName, $controllerName, $actionName);
		$this->app->response = $proxy->invoke ($this->app->request);
	}
}