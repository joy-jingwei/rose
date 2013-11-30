<?php

RoseImporter::import ('lib::RoseHTTPResponseHTML');

class RoseHTTPResponsePage extends RoseHTTPResponseHTML
{
	protected $docType = '<!DOCTYPE HTML>';
	public $title = '';
	public $keywords = '';
	public $descriptions = '';
	public $extMetas = array ();
	public $extHeadTags = array ();

	public $htmlAttrs = array ();
	public $headAttrs = array ();
	public $bodyAttrs = array ();
	//protected $html = array ('tag' => 'html', 'attrs' => array (), 'inner' => array ());
	//protected $head = array ('tag' => 'head', 'attrs' => array (), 'inner' => array ());
	//protected $body = array ('tag' => 'body', 'attrs' => array (), 'inner' => array ());
	protected $JSGlobalVars = array ();

	public function render ()
	{
		$titleTag = array ('tag' => 'meta', 'attrs' => '');

		$headInner = array (
			$titleTag,
			$keywordsTag,
			$descriptionsTag,
			$extMetas,
			$extHeadTags,
			$jsTags,
			$cssTags,
		);
		$headTag = array ('tag' => 'head', 'attrs' => $this->headAttrs, 'inner' => $headInner);

		$htmlInner = array (
			$headTag,
			$bodyTag
		);
		$htmlTag = array ('tag' => 'html', 'attrs' => $this->htmlAttrs, 'inner' => $htmlInner);

		$this->httpBody = $this->docType . html_generate ($htmlTag);
	}

	public function setTemplate ()
	{

	}
}