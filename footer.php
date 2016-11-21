	
				</main>
				<footer>
					<div class="footer-distributed">
						<?php dynamic_sidebar('footer-sidebar')?>			
					</div>
					<div class="footer-bottom">
						<span><?php _e('Palota Holding Zrt © 2016 |', 'palotaholding')?></span><a href="#"> Adatvédelmi nyilatkozat</a>
						<div class="footer-right">
							<div class="footer-icons">
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>				
							</div>
						</div>
					</div>
					<?php if (1 == 2): ?>				
						<map>
							<div id="map"></div>
						</map>
					<?php endif;?>
				</footer>
			</div>
		</div>
	</body>	
	<?php wp_footer(); ?>
</html>