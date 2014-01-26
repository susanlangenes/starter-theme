<?php
/**
 * The Sidebar containing the footer widget areas.
 *
 * @package Starter Theme
 */

if ( ! is_active_sidebar( 'footer-sidebar' ) && ! is_active_sidebar( 'footer-sidebar-2' ) && ! is_active_sidebar( 'footer-sidebar-3' ) && ! is_active_sidebar( 'footer-sidebar-4' ) )
	return;

// If we get this far, we have widgets. Let do this.
?>
<div id="tertiary" class="footer-widget-area" role="complementary">
	<?php if ( is_active_sidebar( 'footer-sidebar' ) ) : ?>
	<div class="first footer-widgets">
		<?php dynamic_sidebar( 'footer-sidebar' ); ?>
	</div><!-- .first -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'footer-sidebar-2' ) ) : ?>
	<div class="second footer-widgets">
		<?php dynamic_sidebar( 'footer-sidebar-2' ); ?>
	</div><!-- .second -->
	<?php endif; ?>
	
	<?php if ( is_active_sidebar( 'footer-sidebar-3' ) ) : ?>
	<div class="third footer-widgets">
		<?php dynamic_sidebar( 'footer-sidebar-3' ); ?>
	</div><!-- .third -->
	<?php endif; ?>
	
	<?php if ( is_active_sidebar( 'footer-sidebar-4' ) ) : ?>
	<div class="fourth footer-widgets">
		<?php dynamic_sidebar( 'footer-sidebar-4' ); ?>
	</div><!-- .fourth -->
	<?php endif; ?>
	
</div><!-- #tertiary -->
