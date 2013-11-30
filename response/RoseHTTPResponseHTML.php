<?php

RoseImporter::import ('core::RoseHTTPResponse');
RoseImporter::import ('lib::RoseViewEngine');

class RoseHTTPResponseHTML extends RoseHTTPResponse
{
	public $contentType = self::HTTP_CONTENT_TYPE_HTML;

	public $ve;

	public $defaultJSHost;
	public $defaultCSSHost = '/';
	public $defaultJSRoot;
	public $defaultCSSRoot = '/';

	public $headJS = array ();
	public $footerJS = array ();
	public $CSS = array ();
	public $globalJSVars = array ();

	public function render ()
	{
		parent::render ();
		$this->body = $this->ve->render ();

		return $this;
	}
	
	protected function _normalizeJS ($files) {
        $normalized = array ();
        foreach ($files as $f) {
            $arr = $this->_normalize($f, $this->_jsHost, $this->_jsRoot);
            $host = $arr ['host'];
            $file = $arr ['file'];
            $normalized [$host . $file] = $arr;
        }

        return $normalized;
    }

    protected function _normalizCSS ($files) {
        $normalized = array ();
        foreach ($files as $f) {
            $arr = $this->_normalize($f, $this->_cssHost, $this->_cssRoot);
            $host = $arr ['host'];
            $file = $arr ['file'];
            $normalized [$host . $file] = $arr;
        }

        return $normalized;
    }

    protected function _normalize ($file, $defaultHost, $defaultRoot) 
    {
        if (strncasecmp($file, 'http://', 7) === 0) 
        {
            $hostStrLen = strpos($file, '/', 7);
            $host = substr($file, 0, $hostStrLen);
            $file = substr($file, $hostStrLen);
        } 
        else 
        {
            $host = $defaultHost;
        }

        // 
        if ($versionOffset = strrpos($file, '?')) 
        {
            $versionStr = substr($file, $versionOffset + 1);
            $file = substr($file, 0, $versionOffset);
        }

        // 
        $fileWithRoot = (strncmp ($file, '/', 1) === 0) ? $file : $defaultRoot . $file;

        $normalized = array ('host' => rtrim ($host, '/'), 'file' => '/' . trim ($fileWithRoot, '/'));
        if (isset ($versionStr)) $normalized ['version'] = $versionStr;

        return $normalized;
    }

	////////////////////////////////////////////////
	//////////////   act as a bridge    ////////////
	////////////////////////////////////////////////

	public function veAssignEscaped ($var, $value)
	{
		return $this->ve->assignEscaped ($var, $value);
	}

	public function veAssignRaw ($var, $value)
	{
		return $this->ve->assignRaw ($var, $value);
	}

	public function setTemplate ($path)
	{
		return $this->ve->setTemplate ($path);
	}
}