<?php /* Template Name: Profil */ ?>
<?php 
	if (isset($_POST['submit-profile-data'])){
		global $flats_notificaiton;
		if ( 
		    ! isset( $_POST['edit_user_profile_nonce'] ) 
		    || ! wp_verify_nonce( $_POST['edit_user_profile_nonce'], 'edit_user_profile' ) 
		) {
		
		   print 'Sorry, your nonce did not verify.';
		   exit;
		
		} else {
			if (isset($_POST['last_name'])){ $lastname = sanitize_text_field($_POST['last_name']); $arr['last_name'] = $lastname; }
			if (isset($_POST['first_name'])){ $lastname = sanitize_text_field($_POST['first_name']); $arr['first_name'] = $lastname; }
			if (isset($_POST['email'])){ $lastname = sanitize_text_field($_POST['email']); $arr['user_email'] = $lastname; }
			$arr['display_name'] = $lastname . " " . $first_name;
			if ($company = sanitize_text_field($_POST['company'])){update_user_meta($current_user->ID, 'company', $company);}
			if ($phone = sanitize_text_field($_POST['phone'])){ update_user_meta($current_user->ID, 'phone', $phone);}
			$arr['ID'] = $current_user->ID;
			$user_id = wp_update_user( $arr );
			
			if ( is_wp_error( $user_id ) ) {
				// There was an error, probably that user doesn't exist.
				$flats_notificaiton = __('Hiba az adatok frissítése közben', 'palotaholding');
			} else {	
				$flats_notificaiton = __('Adatok sikeressen frissültek', 'palotaholding');
			}			

		}		
	}
	
	if (isset($_POST['reg_submit'])){
		global $flats_notificaiton;
		session_start();
		// check if $_SESSION['qaptcha_key'] created with AJAX exists
		if(isset($_SESSION['qaptcha_key']) && !empty($_SESSION['qaptcha_key'])){
			$myVar = $_SESSION['qaptcha_key'];
			// check if the random input created exists and is empty
			if(isset($_POST[''.$myVar.'']) && empty($_POST[''.$myVar.''])){
				unset($_SESSION['qaptcha_key']);
			} else{
				$flats_notificaiton = __('Azonosítási hiba, próbáld újra.', 'palotaholding');
			}
		} else {
			$flats_notificaiton = __('Azonosítási hiba, próbáld újra.', 'palotaholding');
		}			
		
		if (isset($_POST['pwd'])) $pwd = sanitize_text_field($_POST['pwd']);
		if (isset($_POST['last_name'])){ $lastname = sanitize_text_field($_POST['last_name']); $arr['last_name'] = $lastname; }
		if (isset($_POST['first_name'])){ $first_name = sanitize_text_field($_POST['first_name']); $arr['first_name'] = $first_name; }
		if (isset($_POST['email'])){ $email = sanitize_text_field($_POST['email']); $arr['user_email'] = $email; }
		$arr['display_name'] = $first_name . " " . $lastname;	
		
		if (email_exists($email) == false ) {
			$user_id = wp_create_user( $email, $pwd, $email );
			if ($company = sanitize_text_field($_POST['company'])){update_user_meta($user_id, 'company', $company);}
			if ($phone = sanitize_text_field($_POST['phone'])){ update_user_meta($user_id, 'phone', $phone);}
			$arr['ID'] = $user_id;
			$user_id = wp_update_user( $arr );		
		} else {
			echo "asd";
			$flats_notificaiton = __('Ezt az emailcímet már regisztrálták a rendszerbe. Használj másik email címet vagy ha te regisztráltál korábban kérj új jelszót.', 'palotaholding');			
		}	
	}
?>
<?php get_header()?>
	<div class="container content">
		<div class="row">
			<?php get_sidebar()?>
			<div class="col-md-9" id="content-wrap">
				<div class="wrapper">
					<?php if (have_posts()): the_post()?>
						<?php if (is_user_logged_in()):?>
							<div class="title-wrapper">
								<h1><?php _e('Profilom', 'palotaholding')?></h1>
								<hr />
							</div>
							<div class="notification"><?php global $flats_notificaiton; if (isset($flats_notificaiton)):?><?php  echo $flats_notificaiton;?><?php endif;?></div>
							<div class="entry-content">
								<?php the_content() ?>
							</div>
							<div class="user-profile">
								<h3 class="user-profile-block-title"><?php _e('Adataim', 'palotaholding')?></h3>
								<form id="user-profile-form" method="post" accept="">
									<fieldset>
										<label>Vezetéknév</label>
										<input type="text" name="last_name" value="<?php echo $current_user->last_name ?>"/>
									</fieldset>
									<fieldset>
										<label>Keresztnév</label>
										<input type="text" name="first_name" value="<?php echo $current_user->first_name ?>"/>
									</fieldset>
									<fieldset>
										<label>Megjelenítendő név</label>
										<input type="text" name="display_name" value="<?php echo $current_user->display_name ?>"/>
									</fieldset>									
									<fieldset>
										<label>Cégnév</label>
										<input type="text" name="company" value="<?php echo get_user_meta($current_user->ID, 'company', true) ?>"/>
									</fieldset>
									<fieldset>
										<label>Email</label>
										<input type="email" name="email" value="<?php echo $current_user->user_email ?>"/>
									</fieldset>
									<fieldset>
										<label>Telefonszám</label>
										<input type="phone" name="phone" value="<?php echo get_user_meta($current_user->ID, 'phone', true) ?>"/>
									</fieldset>																
									<fieldset>
										<?php wp_nonce_field( 'edit_user_profile', 'edit_user_profile_nonce'); ?>
										<input type="submit" name="submit-profile-data" class="btn btn-default" value="Módosít"/>
									</fieldset>																																
								</form>
								<br clear="all">
								<h3 class="user-profile-block-title"><?php _e('Licitelt lakásaim', 'palotaholding')?></h3>	
								<?php $flats = $wpdb->get_results("SELECT * FROM licits WHERE user_ID = $current_user->ID AND amount > 0");?>
								<?php foreach ($flats as $flat):?>
									<div class="flat">
										<div class="row">
											<div class="flat-thumbnail col-md-2 col-xs-12">
												<?php echo get_the_post_thumbnail($flat->flat_ID, 'thumbnail')?>
											</div>
											<div class="flat-data col-md-10 col-xs-12">
												<h4><a href="<?php echo get_the_permalink($flat->flat_ID)?>"><?php echo get_the_title($flat->flat_ID)?></a></h4>
												<span><?php echo $flat->amount?></span>
											</div>
										</div>
									</div>	
								<?php endforeach;?>	
								
								<h3 class="user-profile-block-title"><?php _e('Függő licitálási kérelmeim', 'palotaholding')?></h3>	
								<?php $flats = $wpdb->get_results("SELECT * FROM licits WHERE user_ID = $current_user->ID AND active = 0");?>
								<?php foreach ($flats as $flat):?>
									<div class="flat">
										<div class="row">
											<div class="flat-thumbnail col-md-2 col-xs-12">
												<?php echo get_the_post_thumbnail($flat->flat_ID, 'thumbnail')?>
											</div>
											<div class="flat-data col-md-10 col-xs-12">
												<h4><a href="<?php echo get_the_permalink($flat->flat_ID)?>"><?php echo get_the_title($flat->flat_ID)?></a></h4>
												<span><?php echo $flat->amount?></span>
											</div>
										</div>
									</div>	
								<?php endforeach;?>												
							</div>
						<?php else:?>
							<div class="title-wrapper">
								<h1><?php the_title()?></h1>
								<hr />
							</div>
							<div class="notification"><?php if (isset($flats_notificaiton)):?><?php  echo $flats_notificaiton;?><?php endif;?></div>
							<div class="entry-content">
								<?php the_content() ?>
							</div>						
							<div class="login-forms-holder">
								<div class="form-holder login-form">
									<h3><?php _e('Bejelentkezés', 'palotaholding')?></h3>
									<form action="<?php bloginfo('wpurl') ?>/wp-login.php" method="post" name="login" id="form-login">
						                <div class="form-group">
						                    <input name="log" type="text" class="form-control login-field"
						                           value="<?php echo esc_attr(stripslashes($user_login), 1) ?>"
						                           placeholder="<?php _e('Felhasználónév', 'palotaholding')?>" id="log" required/>
						                </div>		
						                <div class="form-group">
						                    <input name="pwd" type="password" class="form-control login-field"
						                           placeholder="<?php _e('Jelszó', 'palotaholding')?>" id="log" required/>
						                </div>							                							
						                <div class="form-group">
											<label for="rememberme"><?php echo 'Emlékezz rám' ?></label>
											<input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" />
						                </div>
							            <input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" value="<?php _e('Bejelentkezés', 'palotaholding')?>"/>
										<div class="QapTcha user-profile-login"></div>
										<input type="hidden" name="redirect_to" value="<?php echo get_the_permalink(get_option('login-page')); ?>"/>
									</form>		
									<script>
										jQuery(document).ready(function($){
											$(".user-profile-login").QapTcha({txtLock : "Csúsztasd el a bejelentkezéshez", txtUnlock : "Feloldva", disabledSubmit: true, autoSubmit: true});
											$(".user-profile-register").QapTcha({txtLock : "Csúsztasd el a regisztrációhoz", txtUnlock : "Feloldva", disabledSubmit: true, autoSubmit: true});
										});					
									</script>																										
								</div>
								<div class="form-holder registration-form">
									<h3><?php _e('Regisztráció', 'palotaholding')?></h3>								
							        <form method="post" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>">
						                <div class="form-group">
						                    <input name="last_name" type="text" class="form-control login-field"
						                           value="<?php echo(isset($_POST['last_name']) ? $_POST['last_name'] : null); ?>"
						                           placeholder="<?php _e('Vezetéknév', 'palotaholding')?>" id="last_name"/>
						                </div>
						
						                <div class="form-group">
						                    <input name="first_name" type="text" class="form-control login-field"
						                           value="<?php echo(isset($_POST['first_name']) ? $_POST['first_name'] : null); ?>"
						                           placeholder="<?php _e('Keresztnév', 'palotaholding')?>" id="first_name"/>
						                </div>				
						
						                <div class="form-group">
						                    <input name="email" type="email" class="form-control login-field"
						                           value="<?php echo(isset($_POST['email']) ? $_POST['email'] : null); ?>"
						                           placeholder="<?php _e('Email', 'palotaholding')?>" id="email" required/>
						                </div>
						
						                <div class="form-group">
						                    <input name="pwd" type="password" class="form-control login-field"
						                           value="<?php echo(isset($_POST['pwd']) ? $_POST['pwd'] : null); ?>"
						                           placeholder="<?php _e('Jelszó', 'palotaholding')?>" id="pwd" required/>
						                </div>
						
						                <div class="form-group">
						                    <input name="company" type="text" class="form-control login-field"
						                           value="<?php echo(isset($_POST['company']) ? $_POST['company'] : null); ?>"
						                           placeholder="<?php _e('Cégnév', 'palotaholding')?>" id="company"/>
						                </div>
						
						                <div class="form-group">
						                    <input name="phone" type="text" class="form-control login-field"
						                           value="<?php echo(isset($_POST['phone']) ? $_POST['phone'] : null); ?>"
						                           placeholder="<?php _e('Telefonszám', 'palotaholding')?>" id="phone"/>
						                </div>
										<div class="QapTcha user-profile-register"></div>						
										<input type="hidden" name="redirect_to" value="<?php echo get_the_permalink(get_option('login-page')); ?>"/>
						                <input class="btn btn-primary btn-lg btn-block" type="submit" name="reg_submit" value="<?php _e('Regisztráció', 'palotaholding')?>"/>
									</form>									
								</div>
							</div>
						<?php endif;?>
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
<?php get_footer()?>