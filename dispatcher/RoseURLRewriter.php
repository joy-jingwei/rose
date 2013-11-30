<?php

class RoseURLRewriter
{
	private $_request;
	private $_urlRewriteRuleMap = array ();

	public function construct (RoseHTTPRequest $request, $urlRewriteRuleMap = array ())
	{
		$this->_request = $request;
		$this->_urlRewriteRuleMap = $urlRewriteRuleMap;
	}

	public function rewrite ()
	{
		foreach ($this->_urlRewriteRuleMap as $urlPattern => $urlReplacement)
		{
			if (preg_match($urlPattern, $this->request->url) !== FALSE)
			{
				$this->request->urlRewrited = preg_replace($urlPattern, $urlReplacement, $this->request->url);
				// if match, then stop
				break;
			}
		}
	}
}