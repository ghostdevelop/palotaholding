<?php get_header()?>
	<div class="content">
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