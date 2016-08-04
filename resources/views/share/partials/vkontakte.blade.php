<?php
	$link = isset($service['uri']) ? $service['uri'] : 'asd';

	if(count($service['extra']))
	{
		dd($item);
		$i = 1;
		foreach($service['extra'] as $key => $var)
		{
			$union = ($i == 1) ? '?' : '&';
			$link .= sprintf('%s%s=%s', $union, $service['extra'][$key], isset($data[$key]) ? $data[$key] : $var);
			$i++;
		}
	}
?>
{!! $link !!}