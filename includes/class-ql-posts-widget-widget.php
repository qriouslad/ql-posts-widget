<?php
/**
 * The widget functionality of the plugin.
 *
 * @link 		https://bowo.io
 * @since 		0.3.0
 *
 * @package 	Ql_Posts_Widget
 * @subpackage 	Ql_Posts_Widget/includes
 */

/**
 * The widget functionality of the plugin.
 *
 * @package 	Ql_Posts_Widget
 * @subpackage 	Ql_Posts_Widget/includes
 * @author 		Bowo <hello@bowo.io>
 */
class Ql_Posts_Widget_Widget extends WP_Widget {

	// class constructor which outputs widget block with name and description in the Widgets list
	public function __construct() {

		$widget_ops = array(
			'classname' => 'ql_posts_widget',
			'description' => 'A plugin to display posts with thumbnails',
		);

		parent::__construct( 'ql_posts_widget', 'Posts with Thumbnails', $widget_ops );

	}

	// output the option form field in admin Widgets screen
	public function form( $instance ) {

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : 'Recent Posts';

		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php echo esc_attr( 'Title: ' ); ?>
			</label>

			<input 
				class="widefat" 
				id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
				type="text"
				value="<?php echo esc_attr( $title ); ?>"
			>

		</p>

		<?php

	}

	// save options
	public function update( $new_instance, $old_instance ) {

		$instance = array();

		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;

	}

	// output the widget content on the front-end
	public function widget( $args, $instance ) {

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {

			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];

		}

		echo 'Widget content here.';

		echo $args['after_widget'];

	}

	
}