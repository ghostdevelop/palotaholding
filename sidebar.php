<div class="col-md-3" id="left-sidebar"> 
	<?php if (is_post_type_archive('flat')):?>
		<div id="nav_menu-3" class="widget widget_flat_search">
			<div class="widget-title"><h3><?php _e('Részletes keresés')?></h3></div>
			<div class="widget-content">
				<form method="POST" class="searchform group" action="<?php echo home_url()?><?php echo $_SERVER['REQUEST_URI']?>">
					<?php 
						$terms = get_terms( array(
						    'taxonomy' => 'proposals',
						    'hide_empty' => false,
						) );
					?>		
					<?php foreach ($terms as $term):?>
						<fieldset>
							<input type="checkbox" name="flat_proposal[]" value="<?php echo $term->term_id?>"/><label><?php echo $term->name?></label>
						</fieldset>
					<?php endforeach;?>
					<?php 
						$terms = get_terms( array(
						    'taxonomy' => 'sources',
						    'hide_empty' => false,
						) );
					?>		
					<?php foreach ($terms as $term):?>
						<fieldset>
							<input type="checkbox" name="flat_source[]" value="<?php echo $term->term_id?>"/><label><?php echo $term->name?></label>
						</fieldset>
					<?php endforeach;?>
					<fieldset class="slider">
						<label for="amount">Nettó bérleti díj/hó:</label>
						<input type="text" id="amount" name="amount" readonly> 
						<span>HUF</span>	
						<div id="slider-range-price"></div>			
					</fieldset>
					<fieldset class="slider">
						<label for="amount">Méret:</label>
						<input type="text" id="size" readonly name="size">
						<span>m<sup>2</sup></span>	
						<div id="slider-range-size"></div>			
					</fieldset>		
					<button type="submit" class="flat-search-sidebar-button"><i class="fa fa-search" aria-hidden="true"></i>Szűrés</button>
				</form>
				<p>A paramétereket minden szűrés után újra be kell állítani</p>
			</div>
		</div>

		<script>
			jQuery( function($) {
				$( "#slider-range-price" ).slider({
				  range: true,
				  min: 0,
				  max: 1000000,
				  values: [ 0, 100000 ],
				  slide: function( event, ui ) {
				    $( "#amount" ).val( ui.values[ 0 ] + "-" + ui.values[ 1 ]);
				  }
				});
				$( "#amount" ).val($( "#slider-range-price" ).slider( "values", 0 ) +
				  "-" + $( "#slider-range-price" ).slider( "values", 1 ));
				  
				$( "#slider-range-size" ).slider({
				  range: true,
				  min: 0,
				  max: 200,
				  values: [ 0, 70 ],
				  slide: function( event, ui ) {
				    $( "#size" ).val( ui.values[ 0 ] + "-" + ui.values[ 1 ]);
				  }
				});
				$( "#size" ).val($( "#slider-range-size" ).slider( "values", 0 ) +
				  "-" + $( "#slider-range-size" ).slider( "values", 1 ) );      
			});
		</script>		
	<?php endif;?>
	<?php dynamic_sidebar('left-sidebar')?>
</div>


	
