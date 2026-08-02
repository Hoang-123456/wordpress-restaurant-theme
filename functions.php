<?php
/**
 * Restaurant Theme – functions.php
 * FSE theme: theme.json handles most of the styling.
 * This file only contains what theme.json cannot cover.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Basic setup: translations, theme supports, editor preview.
 * Everything is a one-liner with no runtime/performance cost – standard baseline
 * for any WordPress theme, regardless of the "no bloat" goal.
 */
add_action( 'after_setup_theme', function () {
	// Prepare translatability (language files in /languages).
	load_theme_textdomain( 'restaurant-theme', get_template_directory() . '/languages' );

	// Enable logo upload in the site editor reliably (wp:site-logo block).
	add_theme_support( 'custom-logo' );

	// For a possible future blog/news pattern (blog posts with image).
	add_theme_support( 'post-thumbnails' );

	// Clean HTML5 markup for forms/comments/galleries.
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );

	// Responsive embedded content (e.g. YouTube) instead of fixed width.
	add_theme_support( 'responsive-embeds' );

	// The editor preview uses the same stylesheet as the frontend – editors
	// see the same colors/fonts in the block editor as on the live site.
	add_theme_support( 'editor-styles' );
	add_editor_style( 'style.css' );
} );

/**
 * Register pattern category.
 */
add_action( 'init', function () {
	register_block_pattern_category(
		'restaurant',
		array( 'label' => __( 'Restaurant', 'restaurant-theme' ) )
	);
} );

/**
 * Load menu assets (CSS/JS) only when the menu pattern is present on the page.
 * This saves requests on all other pages (no bloat).
 */
add_action( 'wp_enqueue_scripts', function () {
	$theme   = wp_get_theme();
	$version = $theme->get( 'Version' );

	// Theme stylesheet – add_editor_style() only loads it in the block editor,
	// for the frontend this explicit enqueue is required.
	wp_enqueue_style( 'restaurant-theme-style', get_stylesheet_uri(), array(), $version );

	if ( ! is_singular() ) {
		return;
	}

	$post = get_post();
	if ( ! $post || strpos( $post->post_content, 'id="menu-app"' ) === false ) {
		return;
	}

	$uri = get_template_directory_uri();

	wp_enqueue_script(
		'restaurant-menu',
		$uri . '/assets/js/menu.js',
		array(),
		$version,
		true
	);
} );

/**
 * Preload critical above-the-fold fonts (body text + heading).
 * Both are needed on every page immediately (header, H1); without preloading
 * the browser discovers them only after CSS parsing, which unnecessarily delays
 * text rendering (LCP). The remaining three weights (500, 600, Italic)
 * are intentionally not preloaded to avoid wasting bandwidth in the critical load phase.
 */
add_action( 'wp_head', function () {
	$uri = get_template_directory_uri();
	printf(
		'<link rel="preload" as="font" type="font/woff2" href="%s" crossorigin>' . "\n",
		esc_url( $uri . '/assets/fonts/figtree-400.woff2' )
	);
	printf(
		'<link rel="preload" as="font" type="font/woff2" href="%s" crossorigin>' . "\n",
		esc_url( $uri . '/assets/fonts/fraunces-600.woff2' )
	);
}, 1 );
