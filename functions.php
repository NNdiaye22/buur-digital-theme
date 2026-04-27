<?php
/**
 * BUUR Digital — functions.php
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'BUUR_VERSION', '1.3.1' );
define( 'BUUR_DIR',     get_template_directory() );
define( 'BUUR_URI',     get_template_directory_uri() );

// -------------------------------------------------------
// Chargement des modules
// -------------------------------------------------------
require_once BUUR_DIR . '/inc/enqueue.php';
require_once BUUR_DIR . '/inc/customizer.php';
require_once BUUR_DIR . '/inc/setup-pages.php';

// -------------------------------------------------------
// Support du theme
// -------------------------------------------------------
function buur_theme_setup() {
    load_theme_textdomain( 'buur-digital', BUUR_DIR . '/languages' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', array(
        'height'      => 80,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list',
        'gallery', 'caption', 'style', 'script',
    ) );
    register_nav_menus( array(
        'primary' => __( 'Menu Principal', 'buur-digital' ),
        'footer'  => __( 'Menu Footer',    'buur-digital' ),
    ) );
    add_image_size( 'buur-hero',    1920, 1080, true );
    add_image_size( 'buur-card',     800,  600, true );
    add_image_size( 'buur-thumb',    400,  300, true );
}
add_action( 'after_setup_theme', 'buur_theme_setup' );

// -------------------------------------------------------
// Helpers globaux
// -------------------------------------------------------
function buur_the_logo( $return = false ) {
    $logo_id = get_theme_mod( 'custom_logo' );
    if ( $logo_id ) {
        $url    = wp_get_attachment_image_url( $logo_id, 'full' );
        $output = '<img src="' . esc_url( $url ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" class="site-logo-img">';
    } else {
        $output = '<span class="site-logo-text"><span class="logo-buur">BUUR</span><span class="logo-digital">DIGITAL</span></span>';
    }
    if ( $return ) return $output;
    echo $output;
}

function buur_whatsapp_url( $country = 'sn' ) {
    $sn = get_theme_mod( 'buur_whatsapp_sn', '+221000000000' );
    $fr = get_theme_mod( 'buur_whatsapp_fr', '+33000000000' );
    $number = ( $country === 'fr' ) ? $fr : $sn;
    $number = preg_replace( '/[^0-9]/', '', $number );
    $msg    = rawurlencode( get_theme_mod( 'buur_whatsapp_msg', 'Bonjour, je souhaite demarrer un projet web avec BUUR Digital.' ) );
    return 'https://wa.me/' . $number . '?text=' . $msg;
}

function buur_option( $key, $default = '' ) {
    return get_theme_mod( $key, $default );
}
