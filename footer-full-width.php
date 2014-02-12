<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Starter Theme
 */
?>

	</div><!-- #content -->
<?php get_sidebar('footer'); ?>
</div><!-- #page -->
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php do_action( 'starter_theme_credits' ); ?>
			<?php echo '<span>&copy; ' . date('Y') . ' The Soap Mobile.' . '</span>'; ?>
			<a href="http://wordpress.org/" rel="generator"><?php printf( __( 'Proudly powered by %s', 'starter-theme' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'starter-theme' ), 'Starter Theme', '<a href="http://collagecreative.net" rel="designer">Susan Langenes</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->


<?php wp_footer(); ?>

</body>
</html>