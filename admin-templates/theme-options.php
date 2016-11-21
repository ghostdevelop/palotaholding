<?php 
// Check that the user is allowed to update options
if (!current_user_can('manage_options')) {
    wp_die('You do not have sufficient permissions to access this page.');
}
?>
<div class="wrap">
	<h2><?php  echo wp_get_theme();?> beállítások</h2>
	<form method="post" action="options.php">
		<?php @settings_fields('theme-group'); ?>
		<?php @do_settings_fields('theme-group'); ?>
		<table class="webcon_admin_table widefat">
			<tr>
				<th>Oldalak</th>
			</tr>
			<tr valign="top">
				<td>
					<label for="login">Login</label>				
					<?php     wp_dropdown_pages(
				        array(
				             'name' => 'page-login',
				             'echo' => 1,
				             'show_option_none' => __( '&mdash; Select &mdash;' ),
				             'option_none_value' => '0',
				             'selected' => get_option('page-login')
				        )
				    );?>
				</td>		
				<td>
					<label for="register">Regisztráció</label>				
					<?php     wp_dropdown_pages(
				        array(
				             'name' => 'page-register',
				             'echo' => 1,
				             'show_option_none' => __( '&mdash; Select &mdash;' ),
				             'option_none_value' => '0',
				             'selected' => get_option('page-register')
				        )
				    );?>
				</td>			
			</tr>
		</table> 			
		<table class="webcon_admin_table widefat">
			<tr>
				<th>Közösségi média</th>
			</tr>
			<tr valign="top">
				<td>
					<label for="twitter">Twitter</label>
					<input type="text" name="twitter" value="<?php echo get_option('twitter');?>"/>
				</td>	
				<td>
					<label for="facebook">Facebook</label>
					<input type="text" name="facebook" value="<?php echo get_option('facebook');?>"/>
				</td>	
				<td>
					<label for="gplus">G+</label>
					<input type="text" name="gplus" value="<?php echo get_option('gplus');?>"/>
				</td>			
			</tr>
		</table> 
		<table class="webcon_admin_table widefat">
			<tr>
				<th>Statikus tartalom</th>
			</tr>
			<tr valign="top">
				<td>
					<label for="open_text_1">Fejrész</label>
					<input type="text" name="open_text_1" value="<?php echo get_option('open_text_1');?> " />
				</td>				
				<td>
					<label for="open_text_2">Fejrész szöveg</label>
					<textarea name="open_text_2"><?php echo get_option('open_text_2');?></textarea>
				</td>				
				<td>
					<label for="header_welcome">Fejléc üdvözöljük szöveg</label>
					<textarea name="header_welcome"><?php echo get_option('header_welcome');?></textarea>
				</td>				
			</tr>
		</table> 				
		<?php @submit_button(); ?>
	</form>
</div>