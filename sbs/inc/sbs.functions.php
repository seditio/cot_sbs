<?php
/**
 * SBS Plugin Functions
 *
 * @package sbs
 * @version 1.00
 * @author SED.BY
 * @copyright (c) sed.by 2024
 */

defined('COT_CODE') or die('Wrong URL');

require_once cot_incfile('sbs', 'plug', 'settings');

function sedby_banner_exists($area, $id) {
	global $sbs_banners;
	// cot_message('Banner not found!', 'error');
	return array_key_exists($id, $sbs_banners[$area]);
}

function sedby_banner($tpl = 'sbs', $area = 'global', $id = 'random') {
	global $sbs_banners;
	(!isset($tpl) || empty($tpl)) && $tpl = 'sbs';
	$t = new XTemplate(cot_tplfile($tpl, 'plug'));

	if ($id == 'random') {
		$random = array_rand($sbs_banners[$area]);
		$t->assign([
			$banner_image = $sbs_banners[$area][$random]['image'],
			$banner_link = $sbs_banners[$area][$random]['link'],
			$banner_alt = $sbs_banners[$area][$random]['alt'],
		]);
	} else {
		$t->assign([
			$banner_image = $sbs_banners[$area][$id]['image'],
			$banner_link = $sbs_banners[$area][$id]['link'],
			$banner_alt = $sbs_banners[$area][$id]['alt'],
		]);
	};

	$t->assign([
		"BANNER_IMAGE" => Cot::$cfg['mainurl'] . Cot::$cfg['plugin']['sbs']['folder'] . $banner_image,
		"BANNER_LINK" => $banner_link,
		"BANNER_ALT" => $banner_alt,
		"BANNER_REL" => 'rel="' . Cot::$cfg['plugin']['sbs']['rel'] . '"',
	]);

	$t->parse();
	$output = $t->text();
	return $output;
}
