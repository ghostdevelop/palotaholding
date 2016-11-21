<div class="title-wrapper">
	<h1><?php _e('Eladó ingatlanok')?></h1>
	<hr />
</div>			
<div class="property-block">
	<p>A Palota Holding Ingatlan- és Vagyonkezelő Zrt Budapest Főváros XV. kerület Rákospalota, Pestújhely, Újpalota Önkormányzata Képviselő-testületének megbízásából nyilvános hirdetményt tesz közzé az önkormányzat kizárólagos tulajdonában lévő ingatlanok árverés útján történő értékesítésére.

<a href="http://palotah.hu/tevekenysegeink/%E2%80%8Bingatlan-ertekesites/">Az ingatlanok értékesítéséről itt olvashat bővebben.</a></p>

<!--
	<?php $flats = new WP_Query(array('post_type' => 'flat', 'posts_per_page' => 9, 'meta_query' => array(array('key' => '_thumbnail_id')) )) ?>
	<?php if ($flats->have_posts()): ?>
		<div class="property-block">
			<?php while ($flats->have_posts()): $flats->the_post()?>
				<div class="prop-item">
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
				</div>
			<?php endwhile;?>																				
		</div>	
	<?php endif;?>		
-->																				
</div>	
