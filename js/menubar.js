function of_superfish() {
	jQuery('.nav-menu').superfish({
		delay:       200,                             // 0.2 second delay on mouseout
		animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation
		speed:       'fast',                          // faster animation speed
		autoArrows:  false,                           // disable generation of arrow mark-up
		dropShadows: false                            // disable drop shadows
	});
}
jQuery(document).ready(function() {
	jQuery.noConflict();
	of_superfish();
});
