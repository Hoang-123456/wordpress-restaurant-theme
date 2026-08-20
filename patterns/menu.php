<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Title:      Menu
 * Slug:       restaurant/menu
 * Categories: restaurant
 *
 * The menu is managed centrally in assets/data/menu.json.
 * This pattern only provides the accessible shell; assets/js/menu.js
 * loads the data and renders cards, filters, and search client-side.
 */
$menu_src = esc_url( get_template_directory_uri() . '/assets/data/menu.json' );
?>

<!-- wp:group {"align":"full","anchor":"menu","className":"section-cream","style":{"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull section-cream" id="menu" style="padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl);">

	<!-- wp:group {"layout":{"type":"constrained"}} -->
	<div class="wp-block-group">

		<!-- wp:group {"layout":{"type":"constrained","contentSize":"760px"},"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|m"}}}} -->
		<div class="wp-block-group">
			<!-- wp:paragraph {"className":"eyebrow"} -->
			<p class="eyebrow">Unsere Karte</p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":2,"style":{"spacing":{"margin":{"top":"0.5rem"}}}} -->
			<h2 class="wp-block-heading" style="margin-top:0.5rem;">Menü</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"style":{"color":{"text":"var:preset|color|muted"}}} -->
			<p class="has-text-color" style="color:var(--wp--preset--color--muted);">Filtern Sie nach Kategorie oder suchen Sie gezielt nach einem Gericht.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:html -->
		<div id="menu-app" class="menu-app" data-src="<?php echo $menu_src; ?>">

			<div class="menu-controls">
				<div class="menu-filters" role="group" aria-label="Filter by category">
					<!-- Category buttons are inserted by JS -->
				</div>

				<div class="menu-tools">
					<div class="menu-search">
						<span class="menu-search-icon" aria-hidden="true">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
						</span>
						<label for="menu-search" class="screen-reader-text">Gericht suchen</label>
						<input type="search" id="menu-search" class="menu-search-input" placeholder="Gericht suchen …" autocomplete="off">
					</div>

					<label class="menu-veg">
						<input type="checkbox" class="menu-veg-toggle">
						Nur vegetarisch
					</label>
				</div>
			</div>

			<p class="menu-status screen-reader-text" role="status" aria-live="polite"></p>

			<div class="menu-list">
				<p class="menu-empty">Speisekarte wird geladen …</p>
			</div>

			<p class="menu-note" style="margin-top:2rem;font-size:0.875rem;color:var(--wp--preset--color--muted);"></p>
		</div>
		<!-- /wp:html -->

	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->
