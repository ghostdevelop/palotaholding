<html>
	<head>
	    <title><?php wp_title()?></title>
		<?php wp_head();?>	
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
		<script>
			jQuery(document).ready(function($){
				$('#left-sidebar .widget-title i').click(function(){
					$(this).parent().next().children().slideToggle()
				})
				
				$('.btn.hidder-button').click(function(){
					$(this).prev().slideToggle();
					$(this).next().slideToggle();
				})
			})			
		</script>
	</head>
	<body>
		<div id="wrapper" class="container">
			<div class="row">
				<header id="header-section">
					<div class="header-with-bg">
						<div class="header-line">
							<div class="logo-holder"><img src="<?php bloginfo('template_url')?>/images/logo.png"/></div>
							<div class="header-buttons">
								<?php if (!is_user_logged_in()):?>						
									<a href="<?php echo get_the_permalink(get_option('page-login'))?>" class="btn btn-default"><?php _e('Bejelentkezés')?></a>
									<a href="<?php echo get_the_permalink(get_option('page-register'))?>" class="btn btn-default"><?php _e('Regisztráció')?></a>
								<?php else:?>
									<a href="<?php echo get_the_permalink(get_option('page-login'))?>" class="btn btn-default"><?php _e('Profilom')?></a>
									<a href="<?php echo wp_logout_url(home_url())?>" class="btn btn-default"><?php _e('Kijelentkezés')?></a>
								<?php endif;?>
							</div>
						</div>
						<nav class="navbar navbar-default">
						    <!-- Brand and toggle get grouped for better mobile display -->
						    <div class="navbar-header">
						      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar" aria-expanded="false">
						        <span class="sr-only"><?php __('Menu', 'palotaholding')?></span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						      </button>
						    </div>
						    <!-- Collect the nav links, forms, and other content for toggling -->
						    <div class="collapse navbar-collapse" id="header-navbar">
					        <?php
					            wp_nav_menu( array(
					                'theme_location'    => 'top-menu',
					                'depth'             => 2,
					                'container'         => '',
					                'menu_class'        => 'nav navbar-nav',
					                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
					                'walker'            => new wp_bootstrap_navwalker()
					                )
					            );
					        ?>	      
						      <form class="navbar-form navbar-right searchform">
						        <div class="form-group">
						          <input type="text" name="s" class="form-control" placeholder="<?php _e('Keresés', 'palotaholding')?>">
						        </div>
						        <a class="btn btn-default hidder-button"><i class="fa fa-search" aria-hidden="true"></i></a>
						        <button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i><span><?php _e('Keresés', 'palotaholding')?></span></button>
						      </form>
						    </div><!-- /.navbar-collapse -->
						</nav>
					</div>	
				</header>
				<main id="main-section">
	
