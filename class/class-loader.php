<?php 
	if(!class_exists('THEME_LOADER')) {
	
	    class THEME_LOADER {
	    
		    public function __construct(){
		    	add_action( 'wp_enqueue_scripts', array(&$this, 'front_scripts' ));
		    	add_action( 'wp_enqueue_scripts', array(&$this, 'register_styles' ));
		    	add_action( 'wp_enqueue_scripts', array(&$this, 'register_scripts' ));
		    	add_action( 'admin_enqueue_scripts', array(&$this, 'admin_scripts' ));
		    }
		    
		    function register_scripts(){
				wp_register_script( 'jquery.gmap', get_template_directory_uri() . '/js/jquery.gmap.js', array('jquery'), '1.0.0', true ); 	
				//wp_register_script( $handle, $src, $deps, $ver, $in_footer ); 	
	    
		    }
		    
		    function register_styles(){
		    	//wp_register_style( $handle, $src, $deps, $ver, $media ); 			    
		    }
		    
		    function load_core_scripts(){

		    }
		    	
		    function admin_scripts(){
			    wp_enqueue_media();
				$screen = get_current_screen();

				if ( $screen->post_type == 'sale-flat' ){
					wp_register_style('jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css');
					wp_enqueue_style( 'jquery-ui' );  			    
					wp_enqueue_script('jquery-ui-datepicker');	       
			   	}			    

		    }
		    
		    function front_scripts(){
		    	
		    	//Styles	    			    
				wp_enqueue_style( 'bootstrap');
				wp_enqueue_style( 'wyswyg');
				wp_enqueue_style( 'style-name', get_stylesheet_uri() );
				wp_register_style('jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css');
				wp_register_style('fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css');
				wp_enqueue_style( 'jquery-ui' );				
				wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/css/flexslider.css', array(), false, '');			    
			   
				//wp_enqueue_style( 'sample', get_template_directory_uri() . '/css/sample.css', array(), false, '');			    
			   			   
			   
			   //Scripts
			   wp_enqueue_script( 'jquery');			    
			   wp_enqueue_script( 'jquery-ui-slider');			    
			   wp_enqueue_script( 'bootstrap');
			   wp_enqueue_script( 'jquery.flexslider-min', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'), '1.0.0', true );			    		    
			   wp_enqueue_script( 'map-search', get_template_directory_uri() . '/js/map-search.js', array('jquery'), '1.0.0', true );			    		
			   if (is_singular('sale-flat')) wp_enqueue_script( 'jquery.countdown.min', get_template_directory_uri() . '/js/jquery.countdown.min.js', array('jquery'), '1.0.0', false );			    
			    
				//  wp_enqueue_script( 'init', get_template_directory_uri() . '/js/init.js', array('jquery'), '1.0.0', true );			    
		    }
	    }
	}
	
	if (class_exists('THEME_LOADER')){
		$THEME_LOADER = new THEME_LOADER();
	}
?>