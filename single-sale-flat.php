<?php 
	if (isset($_POST['get_licit_auth'])){	
		global $notifications;
		
		if ( 
		    ! isset( $_POST['make_licit_nonce'] ) 
		    || ! wp_verify_nonce( $_POST['make_licit_nonce'], 'make_licit' ) 
		) {
		
			$notifications['error'] = __('Sikertelen azonosítás próbáld újra', 'palotaholding');
		   exit;
		
		} else {
			$user_id = get_current_user_id();
			$flat_id = (int) $_POST['flat_ID'];
				
			if (!user_send_licit_req($user_id, $flat_id)){
				$wpdb->insert('licits', array(
				    'user_ID' => $user_id,
				    'flat_ID' => $flat_id,
				    'active' => false
				));			
				$request_id = $wpdb->insert_id;
				
				if ($request_id){
					$notifications['success'] = __('Sikeres licitálási kérelem.', 'palotaholding');	
					ob_start(); // turn on output buffering
					locate_template('get-licit-auth.php', true);				
					$notifications['html'] = ob_get_contents(); // get the contents of the output buffer
					ob_end_clean(); 								
				} else {
					$notifications['error'] = __('Sikertelen licitálási kérelem. További információért érdeklődj telefonon.', 'palotaholding');				
				}
			} else {
					$notifications['error'] = __('Sikertelen licitálási kérelem. Már korábban küldtél licitálási kérelmet amelynek a vizsgálata még folyamatban van. További információért érdeklődj telefonon.', 'palotaholding');				
			}
			
	
		}			
	}
	
	if (isset($_POST['make_licit_submit'])){
		global $notifications;
		
		if ( 
		    ! isset( $_POST['make_licit_nonce'] ) 
		    || ! wp_verify_nonce( $_POST['make_licit_nonce'], 'make_licit' ) 
		) {
		
			$notifications['error'] = __('Sikertelen azonosítás próbáld újra', 'palotaholding');
		   exit;
		
		} else {
			
			$user_id = get_current_user_id();
			$flat_id = (int) $_POST['flat_ID'];
			$date = get_post_meta($flat_id, 'licit_end', true);
			$amount = get_highest_licit($flat_id) + get_post_meta($flat_id, 'amount', true);
			if (user_can_licit($user_id, $flat_id)){	
				if (strtotime($date) > mktime(0,0,0)){
					$notifications['success'] = __('Sikeres licit!', 'palotaholding');
					$licit = $wpdb->update( 'licits', array( 'amount' => $amount ), array( 'user_ID' => $user_id, 'flat_ID' => $flat_id ), array( '%d' ), array( '%d', '%d'  ) );
				} else {
					$notifications['error'] = __('Sikertelen licit, ez a licit már lejárt.', 'palotaholding');
				}
			} else{
				$notifications['error'] = __('Sikertelen licit, nincs jogod licitálni erre a lakásra, kérlek olvasd el a licitálási feltételeinket.', 'palotaholding');
			}	
		}		
	}	
?>
<?php get_header()?>
	<div class="content">
		<div class="row">
			<?php get_sidebar()?>
			<div class="col-md-9 content-block">
				<?php if (have_posts()): the_post()?>
					<div id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
						<div class="title-wrapper">
							<h1><?php the_title()?></h1>
							<hr />
						</div>
						<?php if (!empty($notifications)):?>
							<?php foreach ($notifications as $key => $notification):?>
								<div class="notifications <?php echo $key?>"><?php echo $notifications[$key];?></div>
							<?php endforeach;?>
						<?php endif;?>
						<div class="sale-info">
							<div class="price-box">
								<div class="price">
									<label><?php _e('Legmagasabb licit:', 'palotaholding')?></label><span><?php show_highest_licit(get_the_ID())?></span>
								</div>							
								<div class="price">
									<label><?php _e('Kikiáltási ár:', 'palotaholding')?></label><span><?php show_price(get_the_ID())?></span>
								</div>
								<div class="amount">
									<label><?php _e('Licit lépcső:', 'palotaholding')?></label><span><?php show_amount(get_the_ID())?></span>
								</div>

							</div>
							<div class="dates">
								<div>
									<label><?php _e('Utolsó licit ideje:', 'palotaholding')?></label>
									<?php show_last_licit_date(get_the_ID())?>
								</div>							
								<div>
									<label><?php _e('Licit meghírdetett ideje:', 'palotaholding')?></label>
									<date><?php echo get_post_meta(get_the_ID(), 'licit_start', true)?></date> - <date><?php echo get_post_meta(get_the_ID(), 'licit_end', true)?></date>
								</div>
								<div>
									<label><?php _e('Hátralévő idő:', 'palotaholding')?></label><numb id="time-back"></numb>
									<script type="text/javascript">
									  jQuery("#time-back")
									  .countdown("<?php echo date('Y/m/d',strtotime(get_post_meta(get_the_ID(), 'licit_end', true)))?>", function(event) {
									    jQuery(this).text(
									      event.strftime('%D nap %H:%M:%S')
									    );
									  });
									</script>
								</div>
							</div>
							<div class="actions">
								<form method="post" class="single-flat-actions-form">
										<input type="hidden" value="<?php echo get_the_ID()?>" name="flat_ID" />
										<?php wp_nonce_field( 'make_licit', 'make_licit_nonce'); ?>									
									<?php if (user_can_licit(get_current_user_id(), get_the_ID())):?>
										<input type="submit" class="licit-button" name="make_licit_submit" value="<?php _e('Licitálok', 'palotaholding')?>" />
									<?php else:?>
										<input type="submit" class="licit-button" name="get_licit_auth" value="<?php _e('Licitálási kérelem küldése', 'palotaholding')?>" />
									<?php endif;?>
								</form>
							</div>
						</div>
						<div class="entry-content">
							<?php the_content() ?>
						</div>			
						<?php $parameters = SaleFlatPostType::get_fields('parameters');?>
						<table class="flat-parameters">
							<thead>
								<tr>
									<th colspan="4"><?php _e('Ingatlan adatok és településrendezési előírások', 'palotaholding')?></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($parameters as $key => $parameter):?>
									<tr>
										<td><?php echo $parameter['label']?></td>
										<td><?php echo get_post_meta(get_the_ID(), $key, true)?> <?php echo (isset($parameter['suffix']) ? $parameter['suffix'] : "")?></td>
									</tr>
								<?php endforeach;?>	
							</tbody>
						</table>
						
						<?php $parameters = SaleFlatPostType::get_fields('info');?>
						<table class="flat-parameters">
							<thead>
								<tr>
									<th colspan="4"><?php _e('Ingatlanjogi jellemzők', 'palotaholding')?></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($parameters as $key => $parameter):?>
									<tr>
										<td><?php echo $parameter['label']?></td>
										<td><?php echo get_post_meta(get_the_ID(), $key, true)?> <?php echo (isset($parameter['suffix']) ? $parameter['suffix'] : "")?></td>
									</tr>
								<?php endforeach;?>	
							</tbody>
						</table>		
						
						<?php $parameters = SaleFlatPostType::get_fields('sources');?>
						<table class="flat-parameters">
							<thead>
								<tr>
									<th colspan="4"><?php _e('Közművek, energiaellátás, telekommunikáció', 'palotaholding')?></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($parameters as $key => $parameter):?>
									<tr>
										<td><?php echo $parameter['label']?></td>
										<td><?php echo get_post_meta(get_the_ID(), $key, true)?> <?php echo (isset($parameter['suffix']) ? $parameter['suffix'] : "")?></td>
									</tr>
								<?php endforeach;?>	
							</tbody>
						</table>	
						
						<?php $parameters = SaleFlatPostType::get_fields('building');?>
						<table class="flat-parameters">
							<thead>
								<tr>
									<th colspan="4"><?php _e('Építmény (épület) jellemzői', 'palotaholding')?></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($parameters as $key => $parameter):?>
									<tr>
										<td><?php echo $parameter['label']?></td>
										<td><?php echo get_post_meta(get_the_ID(), $key, true)?> <?php echo (isset($parameter['suffix']) ? $parameter['suffix'] : "")?><td>
									</tr>
								<?php endforeach;?>	
							</tbody>
						</table>																					

						<br clear="all">							
						<?php $images = get_attached_media('image', get_the_ID())?>
						<?php if (is_array($images) && !empty($images)):  $thumbs = "";?>
							<!-- Place somewhere in the <body> of your page -->
							<div id="slider" class="flexslider">
							  <ul class="slides">
								  <?php foreach ($images as $img):?>
									    <li>
									     	<?php echo wp_get_attachment_image($img->ID, 'medium')?>
									    </li>
									    <?php 
									    	$thumbs .= '<li>';
									    	$thumbs .= wp_get_attachment_image($img->ID, 'thumbnail');
									    	$thumbs .= '</li>';
									    ?>
								    <?php endforeach?>
							  </ul>
							</div>
							<div id="carousel" class="flexslider">
							  <ul class="slides">
								  <?php echo $thumbs;?>
							  </ul>
							</div>						
						<?php endif;?>				
				<?php endif;?>		
			</div>
		</div>
	</div>
<?php get_footer()?>
<script>
    jQuery(document).ready(function ($) {
	  // The slider being synced must be initialized first
	  $('#carousel').flexslider({
	    animation: "slide",
	    controlNav: false,
	    animationLoop: false,
	    slideshow: false,
	    itemWidth: 210,
	    itemMargin: 5,	    
	    asNavFor: '#slider'
	  });
	 
	  $('#slider').flexslider({
	    animation: "slide",
	    controlNav: false,
	    animationLoop: false,
	    slideshow: true,
	    after: function(slider){
	    	console.log($(this).find('.slides > li'));
	       $(this).height( $(this).find('.slides > li').eq(slider.currentSlide).height() );
	     },			    
	    sync: "#carousel"
	  });
    });
</script>