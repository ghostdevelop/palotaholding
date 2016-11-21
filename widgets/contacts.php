<?php
/*
Plugin Name: Webcreatives Contact Widget
Plugin URI: http://webcreatives.hu
Description: Company contact information widget
Version: 1.0
Author URI: http://webcreatives.hu
*/
// Block direct requests
if ( !defined('ABSPATH') )
	die();

/**
 * Webcreatives Contact widget.
 */
class WebcreativesContactWidget extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'webcreatives-contact', // Base ID
			__('Elérhetőségek', 'webcreatives'), // Name
			array( 'description' => __( 'Company contact info', 'webcreatives' ), ) // Args
		);
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
	
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Elérhetőségek' );
		$address = ( ! empty( $instance['address'] ) ) ? $instance['address'] : false;
		$phone = ( ! empty( $instance['phone'] ) ) ? $instance['phone'] : false;
		$fax = ( ! empty( $instance['fax'] ) ) ? $instance['fax'] : false;
		$mail = ( ! empty( $instance['mail'] ) ) ? $instance['mail'] : false;

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
?>
		<?php echo $args['before_widget']; ?>
		<?php if ( $title ) echo $args['before_title'] . $title . $args['after_title']; ?>
			<ul class="contact-list">
				<?php if ($address) : ?><li><span class="icon-home"></span><?php echo $address?></li><?php endif;?>
				<?php if ($mail) : ?><li><span class="icon-envelope"></span><a href="mailto:<?php echo $mail?>"><?php echo $mail?></a></li><?php endif;?>
				<?php if ($phone) : ?><li><span class="icon-phone"></span><a href="callto:<?php echo $phone?>"><?php echo $phone?></a></li><?php endif;?>
				<?php if ($fax) : ?><li><span class="icon-print"></span><?php echo $fax?></li><?php endif;?>
			</ul>
		<?php echo $args['after_widget']; ?>
<?php		
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$address     = 	isset( $instance['address'] ) ? esc_attr( $instance['address'] ) : '';
		$phone  	 =	isset( $instance['phone'] ) ? esc_attr( $instance['phone'] ) : '';
		$fax   		 = 	isset( $instance['fax'] ) ? esc_attr( $instance['fax'] ) : '';
		$mail  		 = 	isset( $instance['mail'] ) ? esc_attr( $instance['mail'] ) : '';
?>
		<p>
			<label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php _e( 'Cím:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" type="text" value="<?php echo $address; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'mail' ); ?>"><?php _e( 'Email:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'mail' ); ?>" name="<?php echo $this->get_field_name( 'mail' ); ?>" type="text" value="<?php echo $mail; ?>" size="3" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e( 'Telefon:' ); ?></label>
			<input  class="widefat" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" type="text" value="<?php echo $phone; ?>" size="3" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'fax' ); ?>"><?php _e( 'Fax:' ); ?></label>
			<input  class="widefat" id="<?php echo $this->get_field_id( 'fax' ); ?>" name="<?php echo $this->get_field_name( 'fax' ); ?>" type="text" value="<?php echo $fax; ?>" size="3" />
		</p>
		<?php 
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['address'] = strip_tags($new_instance['address']);
		$instance['phone'] = strip_tags($new_instance['phone']);
		$instance['fax'] = strip_tags($new_instance['fax']);
		$instance['mail'] = strip_tags($new_instance['mail']);		
		
		return $instance;
	}
} // class My_Widget