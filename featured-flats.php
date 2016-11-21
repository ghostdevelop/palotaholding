<div class="title-wrapper">
	<h1><?php _e('Kiadó ingatlanok')?></h1>
	<hr />
</div>			
<div class="property-block">
	<?php $flats = new WP_Query(array('post_type' => 'flat', 'posts_per_page' => 9, 'meta_query' => array(array('key' => '_thumbnail_id')) )) ?>
	<?php if ($flats->have_posts()): ?>
		<div id="property-block" class="property-block flexslider">
			<ul class="slides">
				<?php while ($flats->have_posts()): $flats->the_post()?>
					<li class="prop-item">
						<a href="<?php the_permalink()?>">
							<span class="size"><?php echo get_post_meta(get_the_ID(), '_size', true) ?> m<sup>2</sup></span>
							<div class="prop-item-title">
								<h3><?php the_title()?></h3>
							</div>
							<?php if (has_post_thumbnail()):?>
								<?php the_post_thumbnail('medium')?>
							<?php else:?>
								<img src="<?php bloginfo('template_url')?>/images/no-image-featured-image.png" />
							<?php endif;?>
						</a>
					</li>
				<?php endwhile;?>	
			</ul>					
		</div>	
	<?php endif;?>																						
	<p>A teljes kínálat az Üzleti ingatlanok menüpontban érhető el.</p>														
</div>	
<script>
    jQuery(document).ready(function ($) {	 
	  $('#property-block').flexslider({
	    animation: "slide",
	    controlNav: true,
	    animationLoop: false,
	    slideshow: true,
	    itemWidth: 310,
	    itemMargin: 5,	    	    
	  });
    });
</script>