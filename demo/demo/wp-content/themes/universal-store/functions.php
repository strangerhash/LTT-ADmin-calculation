<?php

/**
 * Function describe for universal-store 
 * 
 * @package universal-store
 */
include_once( trailingslashit(get_stylesheet_directory()) . 'lib/universal-store-metaboxes.php' );
include_once( trailingslashit(get_stylesheet_directory()) . 'lib/custom-config.php' );

/**
 * Register custom fonts.
 */
function universal_store_fonts_url() {
    $fonts_url = '';

    /*
     * Translators: If there are characters in your language that are not
     * supported by Oswald, translate this to 'off'. Do not translate
     * into your own language.
     */
    $oswald = _x('on', 'Oswald font: on or off', 'universal-store');

    if ('off' !== $oswald) {
        $font_families = array();

        $font_families[] = 'Oswald:300,300i,400,400i,600,600i,800,800i';

        $query_args = array(
            'family' => urlencode(implode('|', $font_families)),
            'subset' => urlencode('latin,latin-ext'),
        );

        $fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
    }

    return esc_url_raw($fonts_url);
}

/**
 * Add preconnect for Google Fonts.
 *
 */
function universal_store_resource_hints($urls, $relation_type) {
    if (wp_style_is('universal-store-fonts', 'queue') && 'preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }

    return $urls;
}

add_filter('wp_resource_hints', 'universal_store_resource_hints', 10, 2);

add_action('wp_enqueue_scripts', 'universal_store_enqueue_styles');

function universal_store_enqueue_styles() {

    /* maxstore-stylesheet <- Handle in parent theme */
    wp_enqueue_style('maxstore-stylesheet', get_template_directory_uri() . '/style.css', array('bootstrap'));
    wp_enqueue_style('universal-store-style', get_stylesheet_uri(), array('maxstore-stylesheet'));
    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style('universal-store-fonts', universal_store_fonts_url(), array(), null);
}

function universal_store_theme_setup() {

    load_child_theme_textdomain('universal-store', get_stylesheet_directory() . '/languages');

    add_image_size('maxstore-slider', 1140, 488, true);
}

add_action('after_setup_theme', 'universal_store_theme_setup');

// remove unused theme options
function universal_store_custom_remove($wp_customize) {

    $wp_customize->remove_control('infobox-text-right');
}

add_action('customize_register', 'universal_store_custom_remove', 100);

// remove parent theme homepage style
function universal_store_remove_page_templates($templates) {
    unset($templates['template-home.php']);
    return $templates;
}

add_filter('theme_page_templates', 'universal_store_remove_page_templates');

// Load theme info page.
if (is_admin()) {
    include_once(trailingslashit(get_template_directory()) . 'lib/welcome/welcome-screen.php');
} 
