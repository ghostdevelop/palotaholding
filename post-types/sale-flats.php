<?php
class SaleFlatPostType {

    /**
    * hooks
    */
    static $fields = array();
    
    public function __construct() {
        add_action('init', array($this, 'register'));
        add_action( 'save_post', array( $this, 'save_metabox' ) );
        add_action( 'init', array(&$this, 'create_taxonomies'), 0 );         
        //add_action('save_post', array(&$this, 'save_metabox'), 1, 2); // save the custom fields
		$this->init();
    }

    /**
    * admin_init action
    */
    public static function init() {
		$fields['hr_number'] = array(
			"label" => __('Helyrajzi szám:'),
			"type" => "text",
			"class" => ""
		);
		
		$fields['address'] = array(
			"label" => __('Cím:'),
			"type" => "text",
			"class" => ""
		);	
		
		$fields['size'] = array(
			"label" => __('Alapterület:'),
			"type" => "number",
			"class" => ""
		);				
		
		$fields['price'] = array(
			"label" => __('Kikiáltási ár:'),
			"type" => "number",
			"class" => ""
		);
		
		$fields['tax'] = array(
			"label" => __('Áfa %:'),
			"type" => "number",
			"class" => ""
		);		
		
		$fields['arv_bizt'] = array(
			"label" => __('Árverési biztosíték összege:'),
			"type" => "number",
			"class" => ""
		);	
		
		$fields['licit_start'] = array(
			"label" => __('Licit kezdete:'),
			"type" => "text",
			"class" => "datepicker"
		);	
		
		$fields['licit_end'] = array(
			"label" => __('Licit vége:'),
			"type" => "text",
			"class" => "datepicker"
		);									
		
		$fields['ov_besor'] = array(
			"label" => __('Övezeti besorolás:'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['beep_sz'] = array(
			"label" => __('Beépítési százalék:'),		
			"type" => "number",
			"class" => ""
		);	
		
		$fields['zf_mut'] = array(
			"label" => __('Zöldfelületi mutató:'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['br_szt_mut'] = array(
			"label" => __('Bruttó szintterületi mutató:'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['hom_mag_kis'] = array(
			"label" => __('Legkisebb homlokzatmagasság:'),		
			"type" => "number",
			"class" => ""
		);	
		
		$fields['hom_mag_nagy'] = array(
			"label" => __('Legnagyobb homlokzatmagasság:'),		
			"type" => "number",
			"class" => ""
		);		
		
		$fields['szolg_bej'] = array(
			"label" => __('Szolgalmi jog bejegyzés:'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['korl'] = array(
			"label" => __('Korlátozás:'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['elo_jog'] = array(
			"label" => __('Elővásárlási jog:'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['br_szt_mut'] = array(
			"label" => __('Bruttó szintterületi mutató:'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['viz'] = array(
			"label" => __('Vízbekötés:'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['sz_viz'] = array(
			"label" => __('Szennyvízelvezetés:'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['elekt'] = array(
			"label" => __('Elektromos energia:'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['tavfut'] = array(
			"label" => __('Távfűtés:'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['gaz'] = array(
			"label" => __('Gázcsatlakozás:'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['ker_anyag'] = array(
			"label" => __('Kerítés anyaga:'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['ker_allapot'] = array(
			"label" => __('Kerítés állapota:'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['kap_anyag'] = array(
			"label" => __('Kapu anyaga:'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['kap_allapot'] = array(
			"label" => __('Kapu állapota:'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['epul_anyag'] = array(
			"label" => __('Épület főfalainak anyaga:'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['epul_allapot'] = array(
			"label" => __('Épület főfalainak állapota:'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['teto_kial'] = array(
			"label" => __('Tetőszerkezet kialakítása:'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['teto_anyag'] = array(
			"label" => __('Tetőszerkezet anyaga:'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['teto_allapot'] = array(
			"label" => __('Tetőszerkezet állapota:'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['nyil_zar_anyag'] = array(
			"label" => __('Nyílászárók anyaga:'),		
			"type" => "text",
			"class" => ""
		);			
		
		$fields['nyil_zar_allapot'] = array(
			"label" => __('Nyílászárók állapota:'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['alj_anyag'] = array(
			"label" => __('Aljzat anyaga:'),		
			"type" => "text",
			"class" => ""
		);			
		
		$fields['alj_allapot'] = array(
			"label" => __('Aljzat állapota:'),		
			"type" => "text",
			"class" => ""
		);		
		
		$fields['futes'] = array(
			"label" => __('Fűtés:'),		
			"type" => "text",
			"class" => ""
		);			
		
		$fields['futo_berend'] = array(
			"label" => __('fűtőberendezés:'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['futcso_anyag'] = array(
			"label" => __('Fűtéscsövek anyaga:'),		
			"type" => "text",
			"class" => ""
		);			
		
		$fields['futcso_allapot'] = array(
			"label" => __('Fűtéscsövek állapota:'),		
			"type" => "text",
			"class" => ""
		);																															
																																		
		$fields['elektr_anyag'] = array(
			"label" => __('Elektromos vezetékek anyaga:'),		
			"type" => "text",
			"class" => ""
		);			
		
		$fields['elektr_allapot'] = array(
			"label" => __('Elektromos vezetékek állapota:'),		
			"type" => "text",
			"class" => ""
		);		
				
		$fields['udv_kert_allapot'] = array(
			"label" => __('Udvar/kert állapota:'),		
			"type" => "text",
			"class" => ""
		);		
						
		$fields['garazs_allapot'] = array(
			"label" => __('Garázs/gépjárműbeálló állapota:'),		
			"type" => "text",
			"class" => ""
		);			
								
		$fields['terasz_allapot'] = array(
			"label" => __('Terasz/télikert állapota:'),		
			"type" => "text",
			"class" => ""
		);	
		
		self::$fields = $fields;		
    }

    /**
    * register Custom Post Type
    */
    public function register() {
        // register the post type
        register_post_type('sale-flat', array(
		
			'labels'=> array(
				'name'               => _x( 'Eladó ingatlanok', 'theme-phrases' ),
				'singular_name'      => _x( 'Eladó ingatlan', 'theme-phrases' ),
				'menu_name'          => _x( 'Eladó ingatlanok',  'theme-phrases' ),
				'name_admin_bar'     => _x( 'Eladó ingatlan',  'theme-phrases' ),
				'add_new'            => _x( 'Új eladó ingatlan',  'theme-phrases' ),
				'add_new_item'       => __( 'Új eladó ingatlan hozzáadása', 'theme-phrases' ),
				'new_item'           => __( 'Új eladó ingatlan', 'theme-phrases' ),
				'edit_item'          => __( 'Eladó ingatlan szerkesztése', 'theme-phrases' ),
				'view_item'          => __( 'Eladó ingatlan megtekintése', 'theme-phrases' ),
				'all_items'          => __( 'Összes eladó ingatlan', 'theme-phrases' ),
				'search_items'       => __( 'Eladó ingatlan keresése', 'theme-phrases' ),
				'parent_item_colon'  => __( 'Parent eladó ingatlan:', 'theme-phrases' ),
				'not_found'          => __( 'Nincsenek eladó ingatlanok.', 'theme-phrases' ),
				'not_found_in_trash' => __( 'Nincsenek eladó ingatlanok a kukában.', 'theme-phrases' )
			),
            'description' => __('Eladó ingatlanok', 'theme-phrases'),
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
	    add_meta_box('flat-options', __('Eladó ingatlan adatok'), array(&$this, 'metabox'), 'sale-flat','normal');
    }
    
    public function metabox($post){
	   	// Add an nonce field so we can check for it later.
		wp_nonce_field( 'flat-options', 'flat-options_nonce' );
																																									
		echo '<style>';
		echo '.admin-meta-input{display:block; margin-top: 10px;}';
		echo 'div.field-holder{display: block;float: left; margin: 10px 20px; height: 80px;}';
		echo '</style>';
					
		$fields = self::$fields;
		
		foreach ($fields as $key => $field){
			echo '<div class="field-holder">';
			echo '<label>' .$field['label']. '</label>';
			echo '<input type="' .$field['type']. '" class="admin-meta-input ' .$field['class']. '" name="' .$key. '" value="' .get_post_meta( $post->ID, $key, true ). '" />';			
			echo "</div>";
		}
				
		echo "
			<script>
				jQuery(document).ready(function(){
					jQuery('.datepicker').datepicker();	
				});	
			</script>	
		";
		
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

		/* OK, its safe for us to save the data now. */
		
		$fields = $this->fields;
		
		foreach ($fields as $key => $field){
			if ($field['type'] == "text") $value = sanitize_text_field($_POST[$key]);
			if ($field['type'] == "number") $value = (int) $_POST[$key];
			
			update_post_meta( $post_id, $key, $value );
		}	
	    
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
 
global $SaleFlatPostType;

$SaleFlatPostType = new SaleFlatPostType();




?>
