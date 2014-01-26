<?php
/**
 * 
 * Template Name: Off-Canvas Nav Demo
 * The template for displaying the page with off-canvas navigation.
 *
 * @package Starter Theme
 */

get_header('off-canvas'); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>				

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
	
<?php get_sidebar(); ?>
<script type="text/javascript">
jQuery(document).ready(function() {
	
	window.scrollTo(0, 1);
	
	jQuery('.page-template-page-off-canvas-php .menu-toggle').click(function (e) {
		jQuery('body').toggleClass('active');
		e.preventDefault();
    });
    
    
});
</script>
<?php get_footer(); ?>

