<?php
class AdPostType {

    /**
    * hooks
    */
    public function __construct() {
        add_action('init', array($this, 'register'));
        add_action( 'save_post', array( $this, 'save_metabox' ) );
        add_action( 'init', array(&$this, 'create_taxonomies'), 0 );         
    }

    /**
    * admin_init action
    */
    public function init() {

    }

    /**
    * register Custom Post Type
    */
    public function register() {
        // register the post type
        register_post_type('ad', array(
		
			'labels'=> array(
				'name'               => _x( 'Hírdetések', theme_textdomain() ),
				'singular_name'      => _x( 'Hírdetés', theme_textdomain() ),
				'menu_name'          => _x( 'Hírdetések', theme_textdomain() ),
				'name_admin_bar'     => _x( 'Hírdetés', theme_textdomain() ),
				'add_new'            => _x( 'Új hírdetés', theme_textdomain() ),
				'add_new_item'       => __( 'Új hírdetés hozzáadása', theme_textdomain() ),
				'new_item'           => __( 'Új hírdetés', theme_textdomain() ),
				'edit_item'          => __( 'Hírdetés szerkesztése', theme_textdomain() ),
				'view_item'          => __( 'Hírdetés megtekintése', theme_textdomain() ),
				'all_items'          => __( 'Összes hírdetés', theme_textdomain() ),
				'search_items'       => __( 'Hírdetés keresése', theme_textdomain() ),
				'parent_item_colon'  => __( 'Parent hírdetés:', theme_textdomain() ),
				'not_found'          => __( 'Nincsenek hírdetések.', theme_textdomain() ),
				'not_found_in_trash' => __( 'Nincsenek hírdetések a kukában.', theme_textdomain() )
			),
            'description' => __('Hírdetések', theme_textdomain()),
            'exclude_from_search' => true,
            'publicly_queryable' => true,
            'public' => false,
            'show_ui' => true,
            'auto-draft' => false,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'menu_position' => 4,
            'menu_icon'	=> 'dashicons-tag',
            'revisions' => false,
            'hierarchical' => true,
            'has_archive' => true,
			'supports' => array('title','editor','thumbnail'),
            'rewrite' => false,
            'can_export' => false,
            'capabilities' => array (
                'create_posts' => 'manage_options',
                'edit_post' => 'manage_options',
                'read_post' => 'manage_options',
                'delete_posts' => 'manage_options',
                'edit_posts' => 'manage_options',
                'edit_others_posts' => 'manage_options',
                'publish_posts' => 'manage_options',
                'read_private_posts' => 'manage_options',
            ),
            'register_meta_box_cb' => array(&$this, 'add_metabox')               
        ));
    }
    
    public function add_metabox(){
	    add_meta_box('slider_url', 'Url', array(&$this, 'metabox'), 'ad','side');
    }
    
    public function metabox($post){
	   	// Add an nonce field so we can check for it later.
		wp_nonce_field( 'url_metabox', 'url_metabox_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		$urlID = get_post_meta( $post->ID, 'slider_url_id', true );
		$url = get_post_meta( $post->ID, 'slider_url', true );

		wp_dropdown_pages(array('name' => 'slider_url_id', 'selected' => $urlID, 'show_option_none' => 'Válassz oldalt linkeléshez'));
		
		echo '<input type="text" name="slider_url" value="'.$url.'" />';
    }
    
    public function save_metabox($post_id){
		// Check if our nonce is set.
		if ( ! isset( $_POST['url_metabox_nonce'] ) )
			return $post_id;

		$nonce = $_POST['url_metabox_nonce'];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'url_metabox' ) )
			return $post_id;

		// If this is an autosave, our form has not been submitted,
                //     so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $post_id;

		// Check the user's permissions.
		if ( 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;
	
		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
		}

		/* OK, its safe for us to save the data now. */
		if ($_POST['slider_url_id']){
			update_post_meta( $post_id, 'slider_url_id', $_POST['slider_url_id'] );
			$url = get_the_permalink($_POST['slider_url_id']);
		} else {		
			update_post_meta( $post_id, 'slider_url_id', false);
			$url = sanitize_text_field( $_POST['slider_url'] );
		}
		
		update_post_meta( $post_id, 'slider_url', $url );
	    
    }
    
	// create two taxonomies, genres and writers for the post type "book"
	function create_taxonomies() {
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => _x( 'Megjelenési helyek', 'taxonomy general name' ),
			'singular_name'     => _x( 'Hely', 'taxonomy singular name' ),
			'search_items'      => __( 'Hely keresése' ),
			'all_items'         => __( 'Összes hely' ),
			'parent_item'       => __( 'Szülő hely' ),
			'parent_item_colon' => __( 'Szülő helyek:' ),
			'edit_item'         => __( 'Hely szerkesztése' ),
			'update_item'       => __( 'Hely frissítése' ),
			'add_new_item'      => __( 'Új hely hozzáadása' ),
			'new_item_name'     => __( 'Új hely neve' ),
			'menu_name'         => __( 'Megjelenési helyek' ),
		);
	
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'spots' ),
		);
	
		register_taxonomy( 'spots', array( 'ad' ), $args );
	}	    
    
 }
$AdPostType = new AdPostType();

