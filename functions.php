<?php
/**
 * Restaurant Theme – functions.php
 * FSE-Theme: theme.json übernimmt den Großteil des Stylings.
 * Hier steht nur, was theme.json nicht abdecken kann.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Grundausstattung: Übersetzungen, Theme-Supports, Editor-Vorschau.
 * Alles Ein-Zeiler ohne Laufzeit-/Performance-Kosten – Standard-Baseline
 * für jedes WordPress-Theme, unabhängig vom "kein Bloat"-Anspruch.
 */
add_action( 'after_setup_theme', function () {
	// Übersetzbarkeit vorbereiten (Sprachdateien in /languages).
	load_theme_textdomain( 'restaurant-theme', get_template_directory() . '/languages' );

	// Logo-Upload im Site-Editor zuverlässig aktivieren (wp:site-logo Block).
	add_theme_support( 'custom-logo' );

	// Für ein mögliches späteres Blog/News-Pattern (Blog-Beiträge mit Bild).
	add_theme_support( 'post-thumbnails' );

	// Saubere HTML5-Auszeichnung für Formulare/Kommentare/Galerien.
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );

	// Eingebettete Inhalte (z. B. YouTube) responsiv statt fixer Breite.
	add_theme_support( 'responsive-embeds' );

	// Editor-Vorschau nutzt dasselbe Stylesheet wie das Frontend – Redakteure
	// sehen im Block-Editor dieselben Farben/Schriften wie live auf der Seite.
	add_theme_support( 'editor-styles' );
	add_editor_style( 'style.css' );
} );

/**
 * Pattern-Kategorie registrieren.
 */
add_action( 'init', function () {
	register_block_pattern_category(
		'restaurant',
		array( 'label' => __( 'Restaurant', 'restaurant-theme' ) )
	);
} );

/**
 * Menü-Assets (CSS/JS) nur laden, wenn das Menü-Pattern auf der Seite steht.
 * Spart Requests auf allen anderen Seiten (kein Bloat).
 */
add_action( 'wp_enqueue_scripts', function () {
	$theme   = wp_get_theme();
	$version = $theme->get( 'Version' );

	// Theme-eigenes style.css – add_editor_style() lädt es nur im Block-Editor,
	// fürs Frontend braucht es dieses explizite Enqueue.
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
 * Kritische Above-the-Fold-Schriften vorladen (Body-Text + Überschrift).
 * Beide werden auf jeder Seite sofort gebraucht (Header, H1); ohne Preload
 * entdeckt der Browser sie erst nach dem CSS-Parsing, was die Textdarstellung
 * (LCP) unnötig verzögert. Die übrigen drei Schnitte (500, 600, Italic)
 * werden bewusst nicht vorgeladen, um keine unnötige Bandbreite in der
 * kritischen Ladephase zu binden.
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
