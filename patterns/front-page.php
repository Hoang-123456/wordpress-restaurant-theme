<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Title:      Startseite (komplett)
 * Slug:       restaurant/front-page
 * Categories: restaurant
 * Block Types: core/post-content
 *
 * Fügt alle Sektionen in der richtigen Reihenfolge ein:
 * Hero → Menü → Über uns → Kontakt & Anfahrt.
 */
?>

<!-- wp:pattern {"slug":"restaurant/hero"} /-->
<!-- wp:pattern {"slug":"restaurant/menu"} /-->
<!-- wp:pattern {"slug":"restaurant/about"} /-->
<!-- wp:pattern {"slug":"restaurant/contact"} /-->
