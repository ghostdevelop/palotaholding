<?php $p = new WP_Query(array('p' => $query_args, 'post_type' => 'any'))?>
<?php if ($p->have_posts()): $p->the_post()?>
	<a href="<?php the_permalink()?>">
		<div class="image-with-headline" style="background: url(<?php the_post_thumbnail_url('medium')?>); background-size: cover;">
			<h2><?php the_title()?></h2>
		</div>	
	</a>
<?php endif?>