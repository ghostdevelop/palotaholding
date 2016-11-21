<?php 

if(!class_exists('ThemeFramework')) {
	
	class ThemeFramework{
		
		public function __construct(){
			add_action('admin_menu', array(&$this, 'create_pages'));		
			add_action('admin_init', array(&$this, 'register_settings') );			
			add_action( 'init', array(&$this, 'images_setup' ));
			add_action( 'init', array(&$this, 'nav_menus_setup' ));			
			$this->init();					
		}
		
		public function init(){
			if (class_exists("wCore")){
				wCore::get_dir('class', false, dirname(__FILE__));			
				wCore::get_dir('post-types', false, dirname(__FILE__));
				wCore::get_dir('widgets', false, dirname(__FILE__));							
			}				

			if (function_exists('theme_textdomain')) load_theme_textdomain( 'palotaholding', get_template_directory().'/languages' );
		}		
		
		public function logout_url(){
		  wp_redirect( home_url() );
		  exit();
		}		
		
		public function create_pages(){
			add_menu_page('Téma beállítások', 'Téma beállítások', 'administrator', 'theme_settings_page', array(&$this, 'theme_settings_page'),'dashicons-welcome-view-site', 998);			
			add_menu_page('Licitek kezelése', 'Licitek kezelése', 'administrator', 'licits_admin_page', array(&$this, 'licits_admin_page'),'dashicons-backup', 998);			
		}
		
		public function theme_settings_page(){
			include(sprintf("%s/admin-templates/theme-options.php", dirname(__FILE__)));	
		}
		
		public function licits_admin_page(){
			include(sprintf("%s/admin-templates/manage-licits.php", dirname(__FILE__)));	
		}
		
		public function register_settings(){
			register_setting('theme-group', 'twitter'); 
			register_setting('theme-group', 'facebook'); 
			register_setting('theme-group', 'gplus'); 
			register_setting('theme-group', 'page-login'); 	
			register_setting('theme-group', 'page-register'); 	
		}					
		
		public function images_setup(){		
			add_theme_support( 'post-thumbnails' );			
		
			//Add image sizes
			add_image_size( 'product-big-thumb', 270, 270, true );					
		}	

		public function nav_menus_setup() {
			register_nav_menu( 'top-menu', __( 'Top menu', 'theme-phrases' ) );
		}
		
	}
}

$ThemeFramework = new ThemeFramework();

function get_all_vehicle_posts( $query ) {
    if( !is_admin() && $query->is_main_query() && is_post_type_archive( 'flat' ) ) {
        $query->set( 'posts_per_page', '15' );
    }
}

add_action( 'pre_get_posts', 'get_all_vehicle_posts' );

function my_home_category( $query ) {
    if ( $query->is_post_type_archive('flat') && $query->is_main_query()) {
		$query->set('posts_per_page', -1);
		
		$args['tax_query'] = array(
		    'relation' => 'AND'
		);
		$args['meta_query'] = array(
		    'relation' => 'AND'
		);	
				
		if (!empty($_POST['flat_proposal'])){
			$args['tax_query'][] = array(
		        'taxonomy' => 'proposals',
		        'field' => 'term_id',
		        'terms' => $_POST['flat_proposal'],
		        'operator' => 'IN',
		    );
		}
			
		if (!empty($_POST['flat_source'])){
			$args['tax_query'][] = 	    array(
		        'taxonomy' => 'sources',
		        'field' => 'term_id',
		        'terms' => $_POST['flat_source'],
		        'operator' => 'IN',
		    );
		}
				
		if (!empty($_POST['amount'])){
			$amount = explode("-", $_POST['amount']);
			
			$args['meta_query'][] = array(
				'key'     => '_price',
				'value'   => $amount,
				'type' => 'NUMERIC',
				'compare' => 'BETWEEN',
			);
		}
		
		if (!empty($_POST['size'])){
			$size = explode("-", $_POST['size']);
			
			$args['meta_query'][] = array(
				'key'     => '_size',
				'value'   => $size,
				'type' => 'NUMERIC',
				'compare' => 'BETWEEN',
			);
		}	

		$query->set('tax_query', $args['tax_query']);
		$query->set('meta_query', $args['meta_query']);

    }
}
add_action( 'pre_get_posts', 'my_home_category' );