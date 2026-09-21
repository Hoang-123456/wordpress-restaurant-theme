<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Title:      Hero
 * Slug:       restaurant/hero
 * Categories: restaurant
 */
?>

<!-- wp:group {"align":"full","className":"hero","style":{"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull hero" style="padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl);">

	<!-- wp:html -->
	<div class="hero__bg" aria-hidden="true"></div>
	<!-- /wp:html -->

	<!-- wp:group {"layout":{"type":"constrained","contentSize":"720px"}} -->
	<div class="wp-block-group">

		<!-- wp:paragraph {"className":"eyebrow","style":{"color":{"text":"var:preset|color|highlight"}}} -->
		<p class="eyebrow" style="color:var(--wp--preset--color--highlight);">Asiatische Spezialitäten · Erding</p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":1,"textColor":"white","style":{"spacing":{"margin":{"top":"1rem"}}}} -->
		<h1 class="wp-block-heading has-white-color has-text-color" style="margin-top:1rem;">Immer frisch <em>zubereitet</em>, immer gut.</h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"textColor":"white","style":{"typography":{"fontSize":"var:preset|font-size|md"},"spacing":{"margin":{"top":"1.5rem"}},"color":{"text":"rgba(255,255,255,0.85)"}}} -->
		<p class="has-text-color" style="color:rgba(255,255,255,0.85);font-size:var(--wp--preset--font-size--md);margin-top:1.5rem;">Vietnamesische und thailändische Küche, Sushi und mehr – frisch für Sie zubereitet. Zum Mitnehmen, Abholen oder gemütlich bei uns vor Ort.</p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"2.5rem"}},"blockGap":{"left":"1rem"}}} -->
		<div class="wp-block-buttons" style="margin-top:2.5rem;">

			<!-- wp:button -->
			<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#menu">Menü ansehen</a></div>
			<!-- /wp:button -->

			<!-- wp:button {"className":"is-style-outline","textColor":"white","borderColor":"white","style":{"color":{"background":"transparent"},"border":{"width":"1.5px"}}} -->
			<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-white-color has-white-border-color has-text-color has-border-color wp-element-button" href="#contact" style="background:transparent;border-width:1.5px;">Kontakt & Anfahrt</a></div>
			<!-- /wp:button -->

		</div>
		<!-- /wp:buttons -->

	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->
