<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Title:      Contact & directions
 * Slug:       restaurant/contact
 * Categories: restaurant
 *
 * Standalone contact pattern: plain text information
 * (phone, address, opening hours), nothing clickable.
 * For a combined layout with "About us", see
 * patterns/about-contact.php.
 */
?>

<!-- wp:group {"align":"full","anchor":"contact","className":"section-cream","style":{"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull section-cream" id="contact" style="padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl);">

	<!-- wp:group {"layout":{"type":"constrained","contentSize":"640px"},"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|m"}}}} -->
	<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--m);">

		<!-- wp:paragraph {"className":"eyebrow","style":{"typography":{"textAlign":"center"}}} -->
		<p class="eyebrow" style="text-align:center;">Kontakt & Anfahrt</p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":2,"textAlign":"center","style":{"spacing":{"margin":{"top":"0.5rem"}}}} -->
		<h2 class="wp-block-heading has-text-align-center" style="margin-top:0.5rem;">Besuchen Sie uns</h2>
		<!-- /wp:heading -->

	</div>
	<!-- /wp:group -->

	<!-- wp:group {"layout":{"type":"constrained","contentSize":"480px"}} -->
	<div class="wp-block-group">

		<!-- wp:html -->
		<div class="info-panel">
			<div class="info-row">
				<span class="info-row__label">Mo &ndash; Sa</span>
				<span class="info-row__value">11:00 &ndash; 20:00 Uhr</span>
			</div>
			<div class="info-row">
				<span class="info-row__label">Mittagsangebot</span>
				<span class="info-row__value">Mo &ndash; Fr, 11:00 &ndash; 14:30 Uhr</span>
			</div>
			<div class="info-row">
				<span class="info-row__label">Sonntag</span>
				<span class="info-row__value">Geschlossen</span>
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
	<!-- /wp:group -->

</div>
<!-- /wp:group -->
