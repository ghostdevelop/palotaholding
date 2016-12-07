<?php get_header()?>
	<div class="container content">
		<div class="row">
			<?php get_sidebar()?>
			<div class="col-md-9">
				<div class="wrapper">
					<?php if (have_posts()): ?>
						<?php while (have_posts()): the_post()?>
							<div class="post-item clearfix">
								<div class="title-wrapper">
									<h1><?php the_title()?></h1>
									<hr />
								</div>
								<?php if (has_post_thumbnail()):?>
									<div class="thumb-holder">
										<?php the_post_thumbnail('thumbnail')?>
									</div>
								<?php endif;?>
								<div class="desc_table">
									<table>
										<thead>
											<tr>
												<td><?php _e('Kikiáltási ár', 'palotaholding')?></td>
												<td><?php _e('Licit lépcső', 'palotaholding')?></td>
												<td><?php _e('Legnagyobb licit', 'palotaholding')?></td>
												<td><?php _e('Licit vége', 'palotaholding')?></td>
											</tr>											
										</thead>
										<tbody>
											<tr>
												<td><?php echo number_format(get_post_meta(get_the_ID(), 'price', true))?> <?php _e('HUF', 'palotaholding')?></td>
												<td><?php echo number_format(get_post_meta(get_the_ID(), 'amount', true))?> <?php _e('HUF', 'palotaholding')?></td>
												<td><?php echo number_format(get_highest_licit(get_the_ID())) ?> <?php _e('HUF', 'palotaholding')?></td>
												<td><?php echo get_post_meta(get_the_ID(), 'licit_end', true)?></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="entry-content">
									<?php the_excerpt() ?>
								</div>
								<a href="<?php the_permalink()?>" class="btn btn-default"><?php _e('Megnézem', theme_textdomain())?></a>
							</div>
						<?php endwhile;?>
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
<?php get_footer()?>