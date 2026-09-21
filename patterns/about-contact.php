<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Title:      About us & contact (combined)
 * Slug:       restaurant/about-contact
 * Categories: restaurant
 *
 * Alternative to the separate "about" and "contact" patterns:
 * a two-column section – left the story of the house,
 * right opening hours/address/phone as plain text information
 * (nothing clickable). Use only one of the two variants per project,
 * not both at the same time.
 */
?>

<!-- wp:group {"align":"full","anchor":"about","className":"section-surface","style":{"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull section-surface" id="about" style="padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl);">

	<!-- wp:columns {"verticalAlignment":"top","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|l"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-top">

		<!-- wp:column {"verticalAlignment":"top","width":"55%"} -->
		<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:55%;">

			<!-- wp:heading {"level":2} -->
			<h2 class="wp-block-heading">Von unserer Familie, für Erding</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Unsere Rezepte kommen aus Vietnam, unser Zuhause ist Erding. Gekocht wird bei uns wie in der Familie: frisch, ehrlich und ohne Schnickschnack. <em>(Platzhalter-Text)</em></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"textColor":"primary","fontFamily":"display","style":{"typography":{"fontStyle":"italic"}}} -->
			<p class="has-primary-color has-text-color has-display-font-family" style="font-style:italic;">Guten Appetit!</p>
			<!-- /wp:paragraph -->

		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"top","width":"45%"} -->
		<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:45%;">

			<!-- wp:html -->
			<div class="info-panel">
				<h2>Öffnungszeiten & Kontakt</h2>
				<div class="info-row">
					<span class="info-row__label">Mo &ndash; Sa</span>
					<span class="info-row__value">11:00 &ndash; 20:00 Uhr</span>
				</div>
				<div class="info-row">
					<span class="info-row__label">Adresse</span>
					<span class="info-row__value">Freisinger Str. 12, 85435 Erding</span>
				</div>
				<div class="info-row">
					<span class="info-row__label">Telefon</span>
					<span class="info-row__value info-row__value--phone">08122 &ndash; 22 895 22</span>
				</div>
			</div>
			<!-- /wp:html -->

		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

</div>
<!-- /wp:group -->
