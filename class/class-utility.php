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
	
	if (isset($auth->active) && $auth->active) return true;
	
	return false;
}

function get_highest_licit($flat_id){
	global $wpdb;
	
	$licit = $wpdb->get_row("SELECT * FROM licits WHERE flat_ID = $flat_id ORDER BY amount DESC");
	
	if (isset($licit->amount) && $licit->amount > 0){
		return $licit->amount;	
	}	else {
		return false;
	}
	
}

function show_highest_licit($flat_id){
	$licit = get_highest_licit($flat_id);
	
	if ($licit){
		echo number_format($licit) . __('HUF', 'palotaholding');
	} else {
		_e('Még nem érkezett licit erre az ingatlanra.', 'palotaholding');
	}
}

function get_last_licit($id){
	global $wpdb;
	
	$return = $wpdb->get_row("SELECT * FROM licits WHERE flat_ID = $id");
	
	if ($return) return $return;
	
	return false;
}

function get_price($id){
	 $price = get_post_meta($id, 'price', true);
	 
	 if ($price) return $price;
	 
	 return false;
}

function show_price($id){
	$price = get_price($id);
	
	if ($price) {
		echo number_format($price) . " " .  __('HUF', 'palotaholding');
	} else {
		echo __('Nincs megadva ár az ingatlanhoz.', 'palotaholding');
	}
}

function get_amount($id){
	 $price = get_post_meta($id, 'amount', true);
	 
	 if ($price) return $price;
	 
	 return false;
}

function show_amount($id){
	$price = get_amount($id);
	
	if ($price) {
		echo number_format($price) . " " .  __('HUF', 'palotaholding');
	} else {
		echo __('Nincs megadva licitálási lépcső az ingatlanhoz.', 'palotaholding');
	}
}

function show_last_licit_date($id){
	$last_licit = get_last_licit($id);

	if ($last_licit){
		echo '<date>' . $last_licit->date . '</date>';
	} else {
		_e('Még nem volt licit erre az ingatlanra', 'palotaholding');
	}
}