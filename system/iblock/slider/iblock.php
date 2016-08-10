<?php
/**
* Infoblock: Slider
* Images to slider
* Usage:
* {iblock:slider?show=%id} - shows predefined slider with this id
*/

$defaults = array(
	'show' => 1,
);
$args = array_merge($defaults, $args);

if (!is_numeric($args['show'])){
	return;
}

$config = new Config('slider');
$result = $config->get($args['show']);
if (!$result){
	return;
}

if ($args['template'] == 'default' and $result['settings']['type'] == 'nivo') {
	$args['template'] = 'nivo';
}