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
	  		'alt' => 'астронавт',
	  	],
	  	'67' => [
	  		'image' => 'desktop.jpg',
	  		'link' => 'https://sed.by/cot',
	      'alt' => 'десктоп',
	  	],
	  ],
	];

	$cache && $cache->db->store('banners', $sbs_banners, SBS_REALM, Cot::$cfg['plugin']['sbs']['cache']);
}
