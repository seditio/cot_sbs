<?php
/**
 * SBS Plugin Settings
 *
 * @package sbs
 * @version 1.00
 * @author SED.BY
 * @copyright (c) sed.by 2024
 */

defined('COT_CODE') or die('Wrong URL');

define('SBS_REALM', '[SEDBY] SBS Simple Banner System');

if ($cache && $cache->db->exists('banners', SBS_REALM)) {
	$sbs_banners = $cache->db->get('banners', SBS_REALM);
}
else {

	$sbs_banners = [
		'page' => [
	    '1' => [
	  		'image' => 'astronaut.jpg',
	  		'link' => 'https://sed.by/blog',
	  		'text_1' => 'Астронавт',
	  		'text_2' => 'Изображение астронавта',
	  	],
	  	'2' => [
	  		'image' => 'desktop.jpg',
	  		'link' => 'https://sed.by/cot',
	      'text_1' => 'Десктоп',
	      'text_2' => 'Изображение десктопа',
	  	],
	  ],
	];

	$cache && $cache->db->store('banners', $sbs_banners, SBS_REALM, Cot::$cfg['plugin']['sbs']['cache']);
}
