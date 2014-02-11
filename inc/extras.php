<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Starter Theme
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function starter_theme_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'starter_theme_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function starter_theme_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'starter_theme_body_classes' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function starter_theme_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() ) {
		return $title;
	}

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'starter-theme' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'starter_theme_wp_title', 10, 2 );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function starter_theme_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'starter_theme_setup_author' );

// Adds Quote_Widget widget.  

class Quote_Widget extends WP_Widget {
	
	// Register widget with WordPress.	
	function __construct() {
		parent::__construct(
			'quote_widget', // Base ID
			__('Quote Widget', 'text_domain'), // Name
			array( 'description' => __( 'Shows a styled quote or testimonial', 'text_domain' ), ) // Args
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
		$title = apply_filters( 'widget_title', $instance['title'] );
		$quotes = apply_filters( 'quote', $instance['quote'] );
		$quoteAuthor = apply_filters( 'quote_author', $instance['quote_author'] );
		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
		
		if (!empty($quotes)) {	
				echo "<p class=\"widget-quote\">";
					echo $quotes;					
				echo "</p>\n";
			}
		if (!empty($quoteAuthor)) {	
				echo "<p class=\"widget-quote-author\">";
					echo $quoteAuthor;					
				echo "</p>\n";
			}
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
			$quote = $instance[ 'quote' ];
			$quoteAuthor = $instance[ 'quote_author' ];
		}
		
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title (optional; can be left blank):' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'quote' ); ?>"><?php _e( 'Enter quote here without quotation marks' ); ?></label> 
		<textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id( 'quote' ); ?>" name="<?php echo $this->get_field_name( 'quote' ); ?>"><?php echo $quote; ?></textarea>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'quote_author' ); ?>"><?php _e( 'Author:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'quote_author' ); ?>" name="<?php echo $this->get_field_name( 'quote_author' ); ?>" type="text" value="<?php echo esc_attr( $quoteAuthor ); ?>" />
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
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['quote'] = ( ! empty( $new_instance['quote'] ) ) ? strip_tags( $new_instance['quote'] ) : '';
		$instance['quote_author'] = ( ! empty( $new_instance['quote_author'] ) ) ? strip_tags( $new_instance['quote_author'] ) : '';

		return $instance;
	}

} // class Quote_Widget

// register Quote_Widget widget
function register_quote_widget() {
    register_widget( 'Quote_Widget' );
}
add_action( 'widgets_init', 'register_quote_widget' );
