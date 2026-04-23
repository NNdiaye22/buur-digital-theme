<?php
/**
 * BUUR Digital — Chargement des assets CSS et JS.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function buur_enqueue_assets() {

    // --- CSS de base (toutes les pages) ---
    wp_enqueue_style(
        'buur-main',
        BUUR_URI . '/assets/css/main.css',
        array(),
        BUUR_VERSION
    );
    wp_enqueue_style(
        'buur-footer',
        BUUR_URI . '/assets/css/footer.css',
        array( 'buur-main' ),
        BUUR_VERSION
    );

    // --- CSS homepage uniquement ---
    if ( is_front_page() ) {
        wp_enqueue_style( 'buur-preloader',   BUUR_URI . '/assets/css/preloader.css',   array( 'buur-main' ), BUUR_VERSION );
        wp_enqueue_style( 'buur-hero',        BUUR_URI . '/assets/css/hero.css',        array( 'buur-main' ), BUUR_VERSION );
        wp_enqueue_style( 'buur-probleme',    BUUR_URI . '/assets/css/probleme.css',    array( 'buur-main' ), BUUR_VERSION );
        wp_enqueue_style( 'buur-services',    BUUR_URI . '/assets/css/services.css',    array( 'buur-main' ), BUUR_VERSION );
        wp_enqueue_style( 'buur-stats',       BUUR_URI . '/assets/css/stats.css',       array( 'buur-main' ), BUUR_VERSION );
        wp_enqueue_style( 'buur-pourquoi',    BUUR_URI . '/assets/css/pourquoi.css',    array( 'buur-main' ), BUUR_VERSION );
        wp_enqueue_style( 'buur-temoignages', BUUR_URI . '/assets/css/temoignages.css', array( 'buur-main' ), BUUR_VERSION );
        wp_enqueue_style( 'buur-cta',         BUUR_URI . '/assets/css/cta.css',         array( 'buur-main' ), BUUR_VERSION );
    }

    // --- CSS page Contact ---
    if ( is_page_template( 'page-contact.php' ) ) {
        wp_enqueue_style( 'buur-contact', BUUR_URI . '/assets/css/contact.css', array( 'buur-main' ), BUUR_VERSION );
    }

    // --- JS homepage ---
    if ( is_front_page() ) {

        // GSAP CDN
        wp_enqueue_script( 'gsap',             'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js',            array(),         '3.12.5', true );
        wp_enqueue_script( 'gsap-scrolltrigger','https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js',  array( 'gsap' ), '3.12.5', true );
        wp_enqueue_script( 'gsap-splittext',   'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/SplitText.min.js',      array( 'gsap' ), '3.12.5', true );

        // Three.js CDN
        wp_enqueue_script( 'threejs', 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js', array(), 'r128', true );

        // JS internes — ordre important
        wp_enqueue_script( 'buur-preloader',       BUUR_URI . '/assets/js/preloader.js',       array(),                                              BUUR_VERSION, true );
        wp_enqueue_script( 'buur-video-manager',   BUUR_URI . '/assets/js/video-manager.js',   array(),                                              BUUR_VERSION, true );
        wp_enqueue_script( 'buur-hero-tunnel',     BUUR_URI . '/assets/js/hero-tunnel.js',     array( 'threejs', 'gsap-scrolltrigger' ),              BUUR_VERSION, true );
        wp_enqueue_script( 'buur-gsap-animations', BUUR_URI . '/assets/js/gsap-animations.js', array( 'gsap-scrolltrigger', 'gsap-splittext', 'buur-video-manager' ), BUUR_VERSION, true );
        wp_enqueue_script( 'buur-interactions',    BUUR_URI . '/assets/js/interactions.js',    array( 'buur-gsap-animations' ),                      BUUR_VERSION, true );
    }

    // --- JS principal (toutes les pages) ---
    wp_enqueue_script(
        'buur-main',
        BUUR_URI . '/assets/js/main.js',
        array(),
        BUUR_VERSION,
        true
    );

    wp_localize_script( 'buur-main', 'buurData', array(
        'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
        'nonce'     => wp_create_nonce( 'buur-nonce' ),
        'themeUri'  => BUUR_URI,
        'whatsappSN'=> buur_whatsapp_url( 'sn' ),
        'whatsappFR'=> buur_whatsapp_url( 'fr' ),
        'videosUri' => BUUR_URI . '/assets/videos/',
    ) );
}
add_action( 'wp_enqueue_scripts', 'buur_enqueue_assets' );
