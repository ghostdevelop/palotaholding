<?php get_header()?>
	<div class="container content">
		<div class="row">
			<?php get_sidebar()?>
			<div class="col-md-9" id="content-wrap">
				<div class="wrapper">
					<?php if (have_posts()): the_post()?>
						<div class="title-wrapper">
							<h1><?php the_title()?></h1>
							<hr />
						</div>
						<div class="entry-content">
							<?php the_content() ?>
						</div>
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
<?php get_footer()?>