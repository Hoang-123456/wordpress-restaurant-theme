<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Title:      Complete homepage
 * Slug:       restaurant/front-page
 * Categories: restaurant
 * Block Types: core/post-content
 *
 * Inserts all sections in the correct order:
 * Hero → Menu → About us → Contact & directions.
 */
?>

<!-- wp:pattern {"slug":"restaurant/hero"} /-->
<!-- wp:pattern {"slug":"restaurant/menu"} /-->
<!-- wp:pattern {"slug":"restaurant/about"} /-->
<!-- wp:pattern {"slug":"restaurant/contact"} /-->
