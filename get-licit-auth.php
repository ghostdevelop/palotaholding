<?php global $request_id ?>
<div class="get-auth">
	<?php _e('A licitálási jogosultságot az ingatlanhoz meghatározott árverési biztosíték megfizetése után adjuk meg.', 'palotaholding') ?>
	<h2>Bank adatai</h2>
	<h3>Palota Holding - K & H Bank</h3>	
	<ul class="wc-bacs-bank-details order_details bacs_details">
		<li class="account_number">Számlaszám: <strong>10201006-50071700-00000000</strong></li>
		<li class="iban">IBAN: <strong>HU92 1020 1006 5000 1700 0000 0000</strong></li>
	</ul>	
	<?php _e('Összeg:', 'palotaholding')?>
	<?php echo get_post_meta(get_the_ID(), 'arv_bizt', true)?> <?php _e('HUF', 'palotaholding')?>
	<?php _e('Megjegyzéshez azonosító:', 'palotaholding')?>	
	<?php echo $request_id?>
</div>
