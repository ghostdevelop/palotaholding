<?php /* Template Name: Kezdőlap */ ?>
<?php get_header()?>
	<div class="container">
		<div class="row headline-row">
			<?php dynamic_sidebar('home-sidebar')?>		
		</div>
	</div>
	<div class="container content">
		<div class="row">
			<div class="col-md-12">
				<?php get_template_part('featured-flats')?>
				<?php get_template_part('sell-flats')?>
			</div>
		</div>
	</div>
<?php get_footer()?>