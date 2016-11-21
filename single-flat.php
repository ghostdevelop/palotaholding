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
						<div class="entry-content">
							<?php the_content() ?>
						</div>
						<!--
						<div class="title-wrapper">
							<h2><?php _e('Adatok', theme_textdomain())?></h2>
							<hr>
						</div>
						-->							
						<table class="flat-data">
							<tr>
								<th><?php _e('Cím', theme_textdomain())?></th>
								<th><?php _e('Alapterület', theme_textdomain())?></th>
								<th><?php _e('Nettó bérleti díj', theme_textdomain())?></th>
								<th><?php _e('Pályázati biztosíték', theme_textdomain())?></th>
								<th><?php _e('Nettó igénybevételi díj', theme_textdomain())?></th>
							</tr>					
							<tr>
								<td><?php the_title()?></td>
								<td><?php echo get_post_meta(get_the_ID(), '_size', true)?> m<sup>2</sup></td>
								<td><?php echo get_post_meta(get_the_ID(), '_price_m2', true)?> HUF</td>
								<td><?php echo get_post_meta(get_the_ID(), '_plyzbiztkft', true)?> HUF</td>
								<td><?php echo get_post_meta(get_the_ID(), '_price', true)?> HUF</td>
							</tr>
						</table>						
						<?php $images = get_attached_media('image', get_the_ID())?>
						<?php if (is_array($images) && !empty($images)):?>
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
				<?php get_template_part('featured-flats')?>				
			</div>
		</div>
	</div>
<?php get_footer()?>

<style>
.flexslider {

}
#slider.flexslider .slides li img{
	width: calc(100% - 10px);
	height: auto;
	max-height: 100%;
    border: 5px solid #152a6d;
}

#carousel.flexslider .slides li img{
	width: calc(100% - 10px);
    border: 5px solid #152a6d;	
}

#slider.flexslider .slides li {
    width: 100%;
    height: 500px;
}	
</style>

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