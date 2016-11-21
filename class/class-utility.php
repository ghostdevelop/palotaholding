<?php
if (!class_exists("wCore")){
	function theme_textdomain($context = ""){
		$template = wp_get_theme();		
		$textdomain = $template->template;
		
		if ($context != ""){
			$textdomain .= $context;
		}
		
		return $textdomain;
	}
}

function image_list($tag = 'Dobo-38'){
	for ($i = 1; $i <= 16; $i++) {
		$formatted_value = sprintf("%02d", $i);
		$url = "http://palotaholding.webcreatives.hu/kepek/".$tag."/".$tag."_".$formatted_value.".jpg";
		if (getimagesize($url)){
			echo $url;
			echo ',';
		}
	}
}

function user_send_licit_req($user_id, $flat_id){
	global $wpdb;
	
	$auth = $wpdb->get_row("SELECT * FROM licits WHERE user_ID = $user_id AND flat_ID = $flat_id");	
	if ($auth) return true;
	
	return false;
}

function user_can_licit($user_id, $flat_id){
	global $wpdb;
	
	$auth = $wpdb->get_row("SELECT active FROM licits WHERE user_ID = $user_id AND flat_ID = $flat_id");	
	
	if ($auth->active) return true;
	
	return false;
}

