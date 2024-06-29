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
	return array_key_exists($id, $sbs_banners[$area]);
}

function sedby_banner($tpl = 'sbs', $area = 'global', $id = 'random', $elems = 'first') {

	if (Cot::$cfg['plugin']['sbs']['enable']) {
		global $sbs_banners;

		($id == 'random') && $id = array_rand($sbs_banners[$area]);

		if ($elems == 'random') {
			$banner_link = array_rand($sbs_banners[$area][$id]['link']);
			$banner_image = array_rand($sbs_banners[$area][$id]['image']);
			$banner_text_1 = array_rand($sbs_banners[$area][$id]['text_1']);
			$banner_text_2 = array_rand($sbs_banners[$area][$id]['text_2']);
		} else {
			$banner_link = $banner_image = $banner_text_1 = $banner_text_2 = 0;
		}

		(!isset($tpl) || empty($tpl)) && $tpl = 'sbs';
		$t = new XTemplate(cot_tplfile($tpl, 'plug'));
		$t->assign([
			"BANNER_LINK" => $sbs_banners[$area][$id]['link'][$banner_link],
			"BANNER_IMAGE" => Cot::$cfg['mainurl'] . Cot::$cfg['plugin']['sbs']['folder'] . $sbs_banners[$area][$id]['image'][$banner_image],
			"BANNER_TEXT_1" => $sbs_banners[$area][$id]['text_1'][$banner_text_1],
			"BANNER_TEXT_2" => $sbs_banners[$area][$id]['text_2'][$banner_text_2],
			"BANNER_REL" => 'rel="' . Cot::$cfg['plugin']['sbs']['rel'] . '"',
		]);
		$t->parse();
		$output = $t->text();
	} else {
		$output = '';
	}

	return $output;
}
