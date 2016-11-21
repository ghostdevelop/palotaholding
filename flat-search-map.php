<?php /* Template Name: Térképes lakáskereső */ ?>
<?php get_header()?>
	<div class="container content">
		<div class="row">
			<?php get_sidebar()?>
			<div class="col-md-9">
				<div class="wrapper">			
					<div id="map-search-box">
						<?php get_template_part('searchform', 'map')?>
					</div>
				    <div id="map"></div>		    
				</div>
			</div>
		</div>
	</div>
<?php get_footer()?>
<?php 
	$args['post_type'] = 'flat';
	$args['posts_per_page'] = -1;
	
	$args['tax_query'] = array(
	    'relation' => 'AND'
	);
	$args['meta_query'] = array(
	    'relation' => 'AND'
	);	
			
	if (!empty($_POST['flat_proposal'])){
		$args['tax_query'][] = array(
	        'taxonomy' => 'proposals',
	        'field' => 'term_id',
	        'terms' => $_POST['flat_proposal'],
	        'operator' => 'IN',
	    );
	}
		
	if (!empty($_POST['flat_source'])){
		$args['tax_query'][] = 	    array(
	        'taxonomy' => 'sources',
	        'field' => 'term_id',
	        'terms' => $_POST['flat_source'],
	        'operator' => 'IN',
	    );
	}
	
	if (!empty($_POST['amount'])){
		$amount = explode("-", $_POST['amount']);
		
		$args['meta_query'][] = array(
			'key'     => '_price',
			'value'   => $amount,
			'type' => 'NUMERIC',
			'compare' => 'BETWEEN',
		);
	}
	
	if (!empty($_POST['size'])){
		$size = explode("-", $_POST['size']);
		
		$args['meta_query'][] = array(
			'key'     => '_size',
			'value'   => $size,
			'type' => 'NUMERIC',
			'compare' => 'BETWEEN',
		);
	}	

?>
<?php $flats = new WP_Query($args)?>
<?php if ($flats->have_posts()):?>
<script>
	var locations = new Array();	
	<?php while ($flats->have_posts()): $flats->the_post()?>
		<?php $latlng = get_post_meta(get_the_ID(), '_latlng', true)?>
		<?php if ($latlng): ?>
			<?php $latlng = explode(',', $latlng)?>
				var loc = {
					location:{
						lat: <?php echo $latlng[0]?>,
						lng: <?php echo $latlng[1]?>,
					},
					title: '<?php the_title()?>',
					image: '<?php the_post_thumbnail_url('thumbnail')?>',
					permalink: '<?php the_permalink()?>'
				}
				
				locations.push(loc)

		<?php endif;?>
	<?php endwhile;?>
<?php endif; ?>		
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMJwJDzVaVBt0jK1Vi3AbRKao54Cu9Ne0&callback=initMap" async defer></script>
