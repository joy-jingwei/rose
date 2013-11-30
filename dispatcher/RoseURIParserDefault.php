<?php

RoseImporter::import ('RoseURIParserAbstract');

class RoseURIParserDefault extends RoseURIParserAbstract
{
	public function tryParse ()
	{
		$uri = trim ($this->request->uri);
		$segements = explode('/', $uri);

		if (count ($segements) !== 2) return FALSE;

		$modules = explode ('-', $segements [0]);
		$controllerAction = explode ('-', $segements [1]);
		if (count ($modules) > 2 || count ($controllerAction) > 2) return FALSE;

		$this->_moduleName = $modules [0];
		$this->_submoduleName = isset ($modules) ? $modules [1] : NULL;
		$this->_controllerName = $controllerAction [0];
		$this->_actionName = isset ($controllerAction [1]) : $controllerAction [1] : 'get_index';

		return TRUE;
	}
}
