<form method="POST" class="searchform group" action="<?php echo home_url()?><?php echo $_SERVER['REQUEST_URI']?>">
	<div class="default_flat_search">
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Keresés', 'placeholder' ) ?>" value="" name="search" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
		<button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
	</div>
	<div class="extended-search clearfix">
		<div class="extended_search_button closed"><i class="fa fa-angle-left"></i></div>
		<div class="extended_search_wraper">
			<h4><?php _e('Részletes keresés')?></h4>
			<div class="flat-type">
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
			</div>
			<div class="flat-options">
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
					<label for="amount">Ár:</label>
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
			</div>
		</div>
	</div>
</form>

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
