<?php
/**
 * Recent posts widget
 *
 * @copyright Copyright (c) 2017, hugw.io
 * @author Hugo W - me@hugw.io
 * @license GPLv2
 */

/**
 * Widget
 */
class Bloom_Widget_Recent_Posts extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'bloom_recent_posts',
			__( 'Bloom Recent Posts', 'bloom' ),
			array( 'description' => __( 'Display your recent posts with thumbnails', 'bloom' ) )
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $before_widget;
		if ( ! empty( $title ) ) echo $before_title . $title . $after_title;

		$posts = Timber::get_posts( [
			'posts_per_page' => $instance['count'],
			'no_found_rows' => true,
			'post_status' => 'publish',
			'ignore_sticky_posts' => true,
			'meta_query' => [
				[ 'key' => '_thumbnail_id' ]
			]
		]);

		Timber::render( 'partials/recent-posts.twig', [ 'posts' => $posts ] );

		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['count'] = $new_instance['count'];

		return $instance;
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ];
		else $title = __( 'New title', 'bloom' );

		if ( isset( $instance[ 'count' ] ) ) $count = $instance[ 'count' ];
		else $count = 5;

		$i = 1;
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ) ?>"><?php _e( 'Title:', 'bloom' ) ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ) ?>" name="<?php echo $this->get_field_name( 'title' ) ?>" type="text" value="<?php echo esc_attr( $title ) ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'count' ) ?>"><?php _e( 'Count:', 'bloom' ) ?></label>
			<select id="<?php echo $this->get_field_id( 'count' ) ?>" name="<?php echo $this->get_field_name( 'count' ) ?>">
				<?php while ( $i < 11 ): ?>
					<option value="<?php echo $i ?>" <?php selected( $count, $i ) ?>><?php echo $i ?></option>
				<?php $i++; endwhile; ?>
			</select>
		</p>
		<?php
	}
}

add_action( 'widgets_init', function() {
	register_widget( 'Bloom_Widget_Recent_Posts' );
});
