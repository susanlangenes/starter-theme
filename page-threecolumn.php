<?php
/**
* Template Name: Sidebar-Content-Sidebar
 * 
 * The template for displaying Pages with three-column layout.
 *
 * @package Starter Theme
 */

get_header(); ?>
<?php get_sidebar('left'); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>				

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
