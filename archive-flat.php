<?php get_header()?>
	<div class="container content">
		<div class="row">
			<?php get_sidebar()?>
			<div class="col-md-9">
				<div class="wrapper">
					<div class="title-wrapper">
						<h1><?php echo post_type_archive_title()?></h1>
						<hr />
					</div>				
					<?php if (have_posts()): ?>
						<div class="property-block">
							<ul>
								<?php while (have_posts()): the_post()?>
									<li class="prop-item-archive">
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
										<div class="prop-taxonomy">
											<div class="prop-tax">
												<?php $sources = get_the_terms(get_the_ID(), 'sources')?>
												<?php if (!empty($sources)):?>
												<h4>Közművek:</h4>
												<ul>
													<?php foreach ($sources as $source):?>
														<li><?php echo $source->name?></li>
													<?php endforeach;?>
												</ul>
												<?php endif;?>
											</div>
											<div class="prop-tax">											
												<?php $proposals = get_the_terms(get_the_ID(), 'proposals')?>
												<?php if (!empty($proposals)):?>
												<h4>Felhasználási javaslatok:</h4>
												<ul>
													<?php foreach ($proposals as $proposal):?>
														<li><?php echo $proposal->name?></li>
													<?php endforeach;?>
												</ul>
												<?php endif;?>		
											</div>		
										</div>
										<a class="btn btn-default" href="<?php the_permalink()?>">További információk</a>							
									</li>
								<?php endwhile;?>	
							</ul>																			
						</div>	
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
<?php get_footer()?>