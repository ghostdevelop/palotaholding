<?php
class FlatPostType {

    /**
    * hooks
    */
    public function __construct() {
        add_action('init', array($this, 'register'));
        add_action( 'save_post', array( $this, 'save_metabox' ) );
        add_action( 'init', array(&$this, 'create_taxonomies'), 0 );         
        //add_action('save_post', array(&$this, 'save_metabox'), 1, 2); // save the custom fields

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
        register_post_type('flat', array(
		
			'labels'=> array(
				'name'               => _x( 'Üzleti ingatlanok', 'theme-phrases' ),
				'singular_name'      => _x( 'Üzleti ingatlan', 'theme-phrases' ),
				'menu_name'          => _x( 'Üzleti ingatlanok',  'theme-phrases' ),
				'name_admin_bar'     => _x( 'Üzleti ingatlan',  'theme-phrases' ),
				'add_new'            => _x( 'Új üzleti ingatlan',  'theme-phrases' ),
				'add_new_item'       => __( 'Új üzleti ingatlan hozzáadása', 'theme-phrases' ),
				'new_item'           => __( 'Új üzleti ingatlan', 'theme-phrases' ),
				'edit_item'          => __( 'Üzleti ingatlan szerkesztése', 'theme-phrases' ),
				'view_item'          => __( 'Üzleti ingatlan megtekintése', 'theme-phrases' ),
				'all_items'          => __( 'Összes üzleti ingatlan', 'theme-phrases' ),
				'search_items'       => __( 'Üzleti ingatlan keresése', 'theme-phrases' ),
				'parent_item_colon'  => __( 'Parent üzleti ingatlan:', 'theme-phrases' ),
				'not_found'          => __( 'Nincsenek üzleti ingatlanok.', 'theme-phrases' ),
				'not_found_in_trash' => __( 'Nincsenek üzleti ingatlanok a kukában.', 'theme-phrases' )
			),
            'description' => __('Üzleti ingatlanok', 'theme-phrases'),
            'exclude_from_search' => true,
            'publicly_queryable' => true,
            'public' => true,
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
                'create_posts' => 'edit_posts',
                'edit_post' => 'edit_posts',
                'read_post' => 'edit_posts',
                'delete_posts' => 'edit_posts',
                'delete_post' => 'edit_posts',
                'edit_posts' => 'edit_posts',
                'edit_others_posts' => 'edit_posts',
                'publish_posts' => 'edit_posts',
                'read_private_posts' => 'edit_posts',
            ),
            'register_meta_box_cb' => array(&$this, 'add_metabox')               
        ));
    }
    
    public function add_metabox(){
	    add_meta_box('flat-options', __('Üzleti ingatlan adatok'), array(&$this, 'metabox'), 'flat','side');
    }
    
    public function metabox($post){
	   	// Add an nonce field so we can check for it later.
		wp_nonce_field( 'flat-options', 'flat-options_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		$price = get_post_meta( $post->ID, '_price', true );
		$price_m2 = get_post_meta( $post->ID, '_price_m2', true );
		$price_h = get_post_meta( $post->ID, '_price_h', true );
		$plyzbiztkft = get_post_meta( $post->ID, '_plyzbiztkft', true );
		$size = get_post_meta( $post->ID, '_size', true );
		$latlng = get_post_meta( $post->ID, '_latlng', true );
		
		echo '<style>';
		echo '.admin-meta-input{display:block; margin-top: 10px;}';
		echo '</style>';
		
		echo '<label>' . __('Ár:') . '</label>';
		echo '<input type="number" class="admin-meta-input" name="_price" value="'.$price.'" />';
		echo '<br clear="all">';
		
		echo '<label>' . __('Alapterület:') . '</label>';
		echo '<input type="number" class="admin-meta-input" name="_size" value="'.$size.'" />';
		echo '<br clear="all">';
		
		echo '<label>' . __('Nettó bérleti díj minimum m2:') . '</label>';
		echo '<input type="text" class="admin-meta-input" name="_price_m2" value="'.$price_m2.'" />';
		echo '<br clear="all">';
		
		echo '<label>' . __('Nettó bérleti díj minimum:') . '</label>';
		echo '<input type="text" class="admin-meta-input" name="_price_h" value="'.$price_h.'" />';
		echo '<br clear="all">';		
		
		echo '<label>' . __('Pályázati biztosíték:') . '</label>';
		echo '<input type="number" class="admin-meta-input" name="_plyzbiztkft" value="'.$plyzbiztkft.'" />';
		echo '<br clear="all">';
		
		echo '<label>' . __('Koordináták:') . '</label>';
		echo '<input type="text" class="admin-meta-input" name="_latlng" value="'.$latlng.'" />';
		echo '<br clear="all">';				
    }
    
    public function save_metabox($post_id){

		// Check if our nonce is set.
		if ( ! isset( $_POST['flat-options_nonce'] ) )
			return $post_id;

		$nonce = $_POST['flat-options_nonce'];
		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'flat-options' ) )
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

		// Sanitize the user input.
		$price = (int) $_POST['_price'];
		$price_m2 = (int) $_POST['_price_m2'];
		$price_h = (int) $_POST['_price_h'];
		$plyzbiztkft = (int) $_POST['_plyzbiztkft'];
		$size = (int) $_POST['_size'];
		$latlng = $_POST['_latlng'];

		// Update the meta field.
		update_post_meta( $post_id, '_price', $price );
		update_post_meta( $post_id, '_price_m2', $price_m2 );
		update_post_meta( $post_id, '_price_h', $price_h );
		update_post_meta( $post_id, '_plyzbiztkft', $plyzbiztkft );
		update_post_meta( $post_id, '_size', $size );
		update_post_meta( $post_id, '_latlng', $latlng );
	    
    }
    
	// create two taxonomies, genres and writers for the post type "book"
	function create_taxonomies() {
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => __( 'Közművek'),
			'singular_name'     => __( 'Közmű' ),
			'search_items'      => __( 'Közmű keresése' ),
			'all_items'         => __( 'Összes közmű' ),
			'parent_item'       => __( 'Szülő közmű' ),
			'parent_item_colon' => __( 'Szülő közművek:' ),
			'edit_item'         => __( 'Közmű szerkesztése' ),
			'update_item'       => __( 'Közmű frissítése' ),
			'add_new_item'      => __( 'Új közmű hozzáadása' ),
			'new_item_name'     => __( 'Új közmű neve' ),
			'menu_name'         => __( 'Közművek' ),
		);
	
		$args = array(
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'spots' ),
		);
	
		register_taxonomy( 'sources', array( 'flat' ), $args );

		$labels = array(
			'name'              => __( 'Javaslatok'),
			'singular_name'     => __( 'Javaslat' ),
			'search_items'      => __( 'Javaslat keresése' ),
			'all_items'         => __( 'Összes javaslat' ),
			'parent_item'       => __( 'Szülő javaslat' ),
			'parent_item_colon' => __( 'Szülő javaslatok:' ),
			'edit_item'         => __( 'Javaslat szerkesztése' ),
			'update_item'       => __( 'Javaslat frissítése' ),
			'add_new_item'      => __( 'Új javaslat hozzáadása' ),
			'new_item_name'     => __( 'Új javaslat neve' ),
			'menu_name'         => __( 'Javaslatok' ),
		);
	
		$args = array(
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'spots' ),
		);		
		
		register_taxonomy( 'proposals', array( 'flat' ), $args );
	}	    
    
 }
$FlatPostType = new FlatPostType();




?>
