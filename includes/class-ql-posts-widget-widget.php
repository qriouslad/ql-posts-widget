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
// Reference: https://kinsta.com/blog/create-wordpress-widget/
class Ql_Posts_Widget_Widget extends WP_Widget {

	// Get array of category names and slugs
	public function posts_categories_list() {

		$categories_list = get_categories();
		
		$all_categories_list = array( '' => 'All Categories' );

		foreach( $categories_list as $category ) {

			$all_categories_list[$category->slug] = $category->cat_name;

		}

		return $all_categories_list;

	}

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

		$category = ( isset( $instance['category'] ) ) ? $instance['category'] : 'All Categories' ;

		$count = ( ! empty( $instance['count'] ) ) ? $instance['count'] : 3 ;

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
			/>

		</p>

		<p>

			<label for="<?php esc_attr( $this->get_field_id( 'category' ) ); ?>">
				<?php echo esc_attr( 'Category: ' ); ?>
			</label>

			<select
				class="widefat" 
				id="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>" 
				name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>" 
			>
			<?php

				// Get array of categories
				$categories = $this->posts_categories_list();

				// Placeholder for option
				$option = '<option value="%s"%s>%s</option>';

				foreach( $categories as $key => $value ) {

					if ( $category === $key ) {

						printf( $option, $key, 'selected="selected"', $value );

					} else {

						printf( $option, $key, '', $value );

					}

				}


			?>
			</select>

			<?php 
				// For checking content of categories array and the selected category
				// echo '<pre>';
				// print_r($categories);
				// echo '</pre>';
				// echo $category;
			?>

		</p>

		<p>

			<label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>">
				<?php echo esc_attr( 'Number of posts: ' ); ?>
			</label>

			<input 
				class="widefat" 
				id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" 
				name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" 
				type="text" 
				value="<?php echo esc_attr( $count ); ?>" 
			/>

		</p>

		<?php

	}

	// save options
	public function update( $new_instance, $old_instance ) {

		$instance = array();

		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		$instance['category'] = ( ! empty( $new_instance['category'] ) ) ? strip_tags( $new_instance['category'] ) : '';

		$instance['count'] = ( ! empty( $new_instance['count']) ) ? strip_tags( $new_instance['count'] ) : '';

		return $instance;

	}

	// output the widget content on the front-end
	public function widget( $args, $instance ) {

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {

			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];

		}

		echo $args['after_widget'];

	}

	
}