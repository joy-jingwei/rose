<?php

function html_generator ($options)
{
	if (!is_array ($options) || !isset ($options ['tag'])) 
		return '';

	$tag = htmlspecialchars($options ['tag']);
	$attrs = (isset ($options ['attrs']) && is_array ($options ['attrs'])) ? 
		$options ['attrs'] : array ();
	$inner = isset ($options ['inner']) ? $options ['inner'] : '';

	$innerHTML = is_array ($inner) ? __FUNCTION__ ($inner) : $inner;

	$attrsString = '';
	foreach ($attrs as $name => $value)
	{
		$name = htmlspecialchars($name);
		$value = str_replace ('"', '\"', htmlspecialchars($value));
		$attrsString .= " {$name}=\"{$value}\"";
	}

	$html = "<{$tag}{$attrsString}>{$innerHTML}</{$tag}>";

	return $html;
}
