<?php
class SaleFlatPostType {

    /**
    * hooks
    */
    static $fields = array();
    
    public static function load() {
        add_action('init', array('SaleFlatPostType', 'register'));
        add_action( 'save_post', array( 'SaleFlatPostType', 'save_metabox' ) );
    }

    /**
    * admin_init action
    */
    public static function get_fields($fieldblock = false) {
    
    
    	/* PARAMETERS */
		
		$fields['parameters']['size'] = array(
			"label" => __('Ingatlan alapterülete:'),
			"type" => "number",
			"class" => "",
			"suffix" => "m<sup>2</sup>"
		);
		
		$fields['parameters']['net_size'] = array(
			"label" => __('Építmény (épület) nettó alapterülete:'),
			"type" => "number",
			"class" => "",
			"suffix" => "m<sup>2</sup>"
		);		
		
		$fields['parameters']['brut_size'] = array(
			"label" => __('Építmény (épület) bruttó alapterülete:'),
			"type" => "number",
			"class" => "",
			"suffix" => "m<sup>2</sup>"
		);		
		
		$fields['parameters']['ov_besor'] = array(
			"label" => __('Övezeti besorolás:'),		
			"type" => "text",
			"class" => ""
		);		
		
		$fields['parameters']['beep_sz'] = array(
			"label" => __('Beépítési százalék:'),		
			"type" => "number",
			"class" => "",
			"suffix" => "%"
		);			
		
		$fields['parameters']['br_szt_mut'] = array(
			"label" => __('Szintterületi mutató:'),		
			"type" => "text",
			"class" => ""
		);		
		
		$fields['parameters']['zf_mut'] = array(
			"label" => __('Zöldfelületi mutató:'),		
			"type" => "text",
			"class" => "",
			"suffix" => "%"
		);			
		
		$fields['parameters']['hom_mag_kis'] = array(
			"label" => __('Legkisebb homlokzatmagasság:'),		
			"type" => "number",
			"class" => "",
			"suffix" => "m"
		);	
				
		$fields['parameters']['hom_mag_nagy'] = array(
			"label" => __('Legnagyobb homlokzatmagasság:'),		
			"type" => "number",
			"class" => "",
			"suffix" => "m"
		);	
		
    	/* INFO */
		
		$fields['info']['elo_jog'] = array(
			"label" => __('Elővásárlási jog:'),		
			"type" => "text",
			"class" => ""
		);					
		
		$fields['info']['szolg_bej'] = array(
			"label" => __('Szolgalmi jog bejegyzés:'),		
			"type" => "text",
			"class" => ""
		);		
		
		$fields['info']['korl'] = array(
			"label" => __('Jelzálog jog:'),		
			"type" => "text",
			"class" => ""
		);			
		
		$fields['info']['haszoneljog'] = array(
			"label" => __('Haszonélvezeti jog:'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['info']['bizvagy'] = array(
			"label" => __('Bizalmi vagyonkezeléssel érintett-e?'),		
			"type" => "text",
			"class" => ""
		);					
		
		$fields['info']['info_egyeb'] = array(
			"label" => __('Egyéb:'),		
			"type" => "text",
			"class" => ""
		);		
		
    	/* SOURCES */		
		
		$fields['sources']['viz'] = array(
			"label" => __('Vezetékes ivóvíz:'),		
			"type" => "text",
			"class" => ""
		);		
		
		$fields['sources']['kut'] = array(
			"label" => __('Kút:'),		
			"type" => "text",
			"class" => ""
		);				
		
		$fields['sources']['sz_viz'] = array(
			"label" => __('Szennyvízelvezetés:'),		
			"type" => "text",
			"class" => ""
		);
		
		$fields['sources']['hazisz_viz'] = array(
			"label" => __('Házi szennyvízkezelő/emésztő:'),		
			"type" => "text",
			"class" => ""
		);				
		
		$fields['sources']['elekt'] = array(
			"label" => __('Elektromosenergia-ellátás:'),		
			"type" => "text",
			"class" => ""
		);			
		
		$fields['sources']['gaz'] = array(
			"label" => __('Vezetékes gáz:'),		
			"type" => "text",
			"class" => ""
		);			
		
		$fields['sources']['tavfut'] = array(
			"label" => __('Távfűtés:'),		
			"type" => "text",
			"class" => ""
		);			
		
		$fields['sources']['kp_futes'] = array(
			"label" => __('Központi fűtés:'),		
			"type" => "text",
			"class" => ""
		);			
		
		$fields['sources']['egyedi_futes'] = array(
			"label" => __('Egyedi fűtés:'),		
			"type" => "text",
			"class" => ""
		);			
		
		$fields['sources']['vez_tel'] = array(
			"label" => __('Vezetékes telefon:'),		
			"type" => "text",
			"class" => ""
		);			
				
		$fields['sources']['adatkabel'] = array(
			"label" => __('Adatátviteli kábel (vezetékes internet/kábeltv):'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['sources']['adatkabel'] = array(
			"label" => __('Adatátviteli kábel (vezetékes internet/kábeltv):'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['sources']['sources_egyeb'] = array(
			"label" => __('Egyéb:'),		
			"type" => "text",
			"class" => ""
		);			
		
		/* Building */		
			
		$fields['building']['alap'] = array(
			"label" => __('Alap:'),		
			"type" => "text",
			"class" => ""
		);		
		
		$fields['building']['alap_anyag'] = array(
			"label" => __('Alap anyaga:'),		
			"type" => "text",
			"class" => ""
		);			
		
		$fields['building']['epul_anyag'] = array(
			"label" => __('Főfalak anyaga:'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['building']['epul_allapot'] = array(
			"label" => __('Főfalak állapota:'),		
			"type" => "text",
			"class" => ""
		);		
		
		$fields['building']['alj_anyag'] = array(
			"label" => __('Aljzat anyaga:'),		
			"type" => "text",
			"class" => ""
		);			
		
		$fields['building']['alj_allapot'] = array(
			"label" => __('Aljzat állapota:'),		
			"type" => "text",
			"class" => ""
		);			
		
		$fields['building']['teto_anyag'] = array(
			"label" => __('Tetőszerkezet anyaga:'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['building']['teto_allapot'] = array(
			"label" => __('Tetőszerkezet állapota:'),		
			"type" => "text",
			"class" => ""
		);			
		
		$fields['building']['teto_hej'] = array(
			"label" => __('Héjalás (tetőfedés) anyaga:'),		
			"type" => "text",
			"class" => ""
		);		
		
		$fields['building']['teto_kial'] = array(
			"label" => __('Tetőtér:'),		
			"type" => "text",
			"class" => ""
		);										
		
		$fields['building']['nyil_zar_anyag'] = array(
			"label" => __('Nyílászárók anyaga:'),		
			"type" => "text",
			"class" => ""
		);			
		
		$fields['building']['nyil_zar_allapot'] = array(
			"label" => __('Nyílászárók állapota:'),		
			"type" => "text",
			"class" => ""
		);			
		
		$fields['building']['vizhal_anyag'] = array(
			"label" => __('Vízhálózat anyaga:'),		
			"type" => "text",
			"class" => ""
		);
					
		$fields['building']['vizhal_allap'] = array(
			"label" => __('Vízhálózat állapota:'),		
			"type" => "text",
			"class" => ""
		);		
		
		$fields['building']['sznyvizhal_anyag'] = array(
			"label" => __('Szennyvízhálózat anyaga:'),		
			"type" => "text",
			"class" => ""
		);
					
		$fields['building']['sznyvizhal_allap'] = array(
			"label" => __('Szennyvízhálózat állapota:'),		
			"type" => "text",
			"class" => ""
		);			
		
		$fields['building']['elektr_anyag'] = array(
			"label" => __('Elektromos vezetékek anyaga:'),		
			"type" => "text",
			"class" => ""
		);			
		
		$fields['building']['elektr_allapot'] = array(
			"label" => __('Elektromos hálózat állapota:'),		
			"type" => "text",
			"class" => ""
		);			
		
		$fields['building']['futes'] = array(
			"label" => __('Fűtési hálózat (radiátoros, padlófűtés):'),		
			"type" => "text",
			"class" => ""
		);		
		
		$fields['building']['futcso_anyag'] = array(
			"label" => __('Fűtéscsövek állapota:'),		
			"type" => "text",
			"class" => ""
		);			
		
		$fields['building']['futcso_allapot'] = array(
			"label" => __('Fűtési hálózat állapota:'),		
			"type" => "text",
			"class" => ""
		);		
		
		$fields['building']['ker_anyag'] = array(
			"label" => __('Kerítés anyaga:'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['building']['ker_allapot'] = array(
			"label" => __('Kerítés állapota:'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['parameters']['kap_anyag'] = array(
			"label" => __('Kapu anyaga:'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['parameters']['kap_allapot'] = array(
			"label" => __('Kapu állapota:'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['parameters']['garazs'] = array(
			"label" => __('Garázs/gépjárműbeálló:'),		
			"type" => "text",
			"class" => ""
		);						
							
		$fields['parameters']['garazs_allapot'] = array(
			"label" => __('Garázs/gépjárműbeálló állapota:'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['parameters']['terasz'] = array(
			"label" => __('Terasz/télikert:'),		
			"type" => "text",
			"class" => ""
		);						
								
		$fields['parameters']['terasz_allapot'] = array(
			"label" => __('Terasz/télikert állapota:'),		
			"type" => "text",
			"class" => ""
		);					
	
		$fields['parameters']['udv_kert_allapot'] = array(
			"label" => __('Udvar/kert állapota:'),		
			"type" => "text",
			"class" => ""
		);	
		
		$fields['parameters']['building_egyeb'] = array(
			"label" => __('Egyéb:'),		
			"type" => "text",
			"class" => ""
		);			
		
		/* LOCATION */
						
		$fields['location']['hr_number'] = array(
			"label" => __('Helyrajzi szám:'),
			"type" => "text",
			"class" => ""
		);
		
		$fields['location']['address'] = array(
			"label" => __('Cím:'),
			"type" => "text",
			"class" => ""
		);	
		
		
		$fields['licit']['price'] = array(
			"label" => __('Kikiáltási ár:'),
			"type" => "number",
			"class" => ""
		);

		$fields['licit']['amount'] = array(
			"label" => __('Licit lépcső:'),
			"type" => "number",
			"class" => ""
		);
		
		$fields['licit']['tax'] = array(
			"label" => __('Áfa %:'),
			"type" => "number",
			"class" => ""
		);		
		
		$fields['licit']['arv_bizt'] = array(
			"label" => __('Árverési biztosíték összege:'),
			"type" => "number",
			"class" => ""
		);	
		
		$fields['licit']['licit_start'] = array(
			"label" => __('Licit kezdete:'),
			"type" => "text",
			"class" => "datepicker"
		);	
		
		$fields['licit']['licit_end'] = array(
			"label" => __('Licit vége:'),
			"type" => "text",
			"class" => "datepicker"
		);									
		
		if ($fieldblock == false) return $fields;		
    
		return $fields[$fieldblock];
    }

    /**
    * register Custom Post Type
    */
    static function register() {
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
            'register_meta_box_cb' => array('SaleFlatPostType', 'add_metabox')               
        ));
    }
    
    static function add_metabox(){
	    add_meta_box('flat-options', __('Eladó ingatlan adatok'), array('SaleFlatPostType', 'metabox'), 'sale-flat','normal');
    }
    
    static function metabox($post){
	   	// Add an nonce field so we can check for it later.
		wp_nonce_field( 'flat-options', 'flat-options_nonce' );
																																									
		echo '<style>';
		echo '.admin-meta-input{display:block; margin-top: 10px;}';
		echo 'div.field-holder{display: block;float: left; margin: 10px 20px; height: 80px;}';
		echo '.field-block{display: inline-block;clear: both;float: none;}';
		echo '.postbox .inside .field-block h2{padding: 8px 12px;font-weight: 600;font-size: 18px;margin: 0;line-height: 1.4}';
		echo '</style>';
					
		$fieldblocks = self::get_fields();
		
		echo '<div class="field-block">';
		echo '<h2>Licitálással kapcsolatos adatok</h2>';
		foreach ($fieldblocks['licit'] as $key => $field){		
			echo '<div class="field-holder">';
			echo '<label>' .$field['label']. '</label>';
			echo '<input type="' .$field['type']. '" class="admin-meta-input ' .$field['class']. '" name="' .$key. '" value="' .get_post_meta( $post->ID, $key, true ). '" />';			
			echo "</div>";
		}
		echo '</div>';
		
		echo '<div class="field-block">';
		echo '<h2>Hely adatok</h2>';
		foreach ($fieldblocks['location'] as $key => $field){		
			echo '<div class="field-holder">';
			echo '<label>' .$field['label']. '</label>';
			echo '<input type="' .$field['type']. '" class="admin-meta-input ' .$field['class']. '" name="' .$key. '" value="' .get_post_meta( $post->ID, $key, true ). '" />';			
			echo "</div>";
		}
		echo '</div>';
		
		echo '<div class="field-block">';
		echo '<h2>Ingatlan adatok és településrendezési előírások</h2>';
		foreach ($fieldblocks['parameters'] as $key => $field){		
			echo '<div class="field-holder">';
			echo '<label>' .$field['label']. '</label>';
			echo '<input type="' .$field['type']. '" class="admin-meta-input ' .$field['class']. '" name="' .$key. '" value="' .get_post_meta( $post->ID, $key, true ). '" />';			
			echo "</div>";
		}
		echo '</div>';
		
		echo '<div class="field-block">';
		echo '<h2>Ingatlanjogi jellemzők</h2>';
		foreach ($fieldblocks['info'] as $key => $field){		
			echo '<div class="field-holder">';
			echo '<label>' .$field['label']. '</label>';
			echo '<input type="' .$field['type']. '" class="admin-meta-input ' .$field['class']. '" name="' .$key. '" value="' .get_post_meta( $post->ID, $key, true ). '" />';			
			echo "</div>";
		}
		echo '</div>';	
		
		echo '<div class="field-block">';
		echo '<h2>Közművek, energiaellátás, telekommunikáció</h2>';
		foreach ($fieldblocks['sources'] as $key => $field){		
			echo '<div class="field-holder">';
			echo '<label>' .$field['label']. '</label>';
			echo '<input type="' .$field['type']. '" class="admin-meta-input ' .$field['class']. '" name="' .$key. '" value="' .get_post_meta( $post->ID, $key, true ). '" />';			
			echo "</div>";
		}
		echo '</div>';			
					
		echo '<div class="field-block">';
		echo '<h2>Építmény (épület) jellemzői</h2>';
		foreach ($fieldblocks['building'] as $key => $field){		
			echo '<div class="field-holder">';
			echo '<label>' .$field['label']. '</label>';
			echo '<input type="' .$field['type']. '" class="admin-meta-input ' .$field['class']. '" name="' .$key. '" value="' .get_post_meta( $post->ID, $key, true ). '" />';			
			echo "</div>";
		}
		echo '</div>';						
							
		echo "
			<script>
				jQuery(document).ready(function(){
					jQuery('.datepicker').datepicker();	
				});	
			</script>	
		";
		
		echo '<br clear="all">';
		
    }
    
    static function save_metabox($post_id){
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
		
		$fieldblocks = self::get_fields();
		
		foreach ($fieldblocks as $key => $fields){
			foreach ($fields as $key => $field){			
				if ($field['type'] == "text") $value = sanitize_text_field($_POST[$key]);
				if ($field['type'] == "number") $value = (int) $_POST[$key];
				
				update_post_meta( $post_id, $key, $value );
			}
		}	
	    
    }  
    
 }
 
SaleFlatPostType::load();