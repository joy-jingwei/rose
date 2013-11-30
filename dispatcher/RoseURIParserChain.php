<?php

RoseImporter::import ('lib::url::RoseURIParserInterface');

class RoseURIParserChain
{
	private $_parsers = array ();

	private $_moduleName;
	private $_submoduleName;
	private $_controllerName;
	private $_actionName;

	public function addParser (RoseURIParserInterface $parser)
	{
		$this->_parsers [] = $parser;
		return $this;
	}

	public function parse ($uri)
	{
		$this->_moduleName = NULL;
		$this->_submoduleName = NULL;
		$this->_controllerName = NULL;
		$this->_actionName = NULL;
		
		foreach ($this->_parsers as $p) 
		{
			if ($p->tryParse ($uri) !== FALSE)
			{
				$this->_moduleName = $p->getModuleName ();
				$this->_submoduleName = $p->getSubmoduleName ();
				$this->_controllerName = $p->getControllerName ();
				$this->_actionName = $p->getActionName ();

				return TRUE;
			}
		}

		return FALSE;
	}
}