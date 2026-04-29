<?php
/**
 * BUUR Digital — Chargement des assets CSS et JS.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function buur_enqueue_assets() {

    // --- CSS de base (toutes les pages) ---
    wp_enqueue_style( 'buur-main',   BUUR_URI . '/assets/css/main.css',   array(),              BUUR_VERSION );
    wp_enqueue_style( 'buur-footer', BUUR_URI . '/assets/css/footer.css', array( 'buur-main' ), BUUR_VERSION );

    // --- CSS homepage uniquement ---
    if ( is_front_page() ) {
        wp_enqueue_style( 'buur-preloader',    BUUR_URI . '/assets/css/preloader.css',    array( 'buur-main' ), BUUR_VERSION );
        wp_enqueue_style( 'buur-hero',         BUUR_URI . '/assets/css/hero.css',         array( 'buur-main' ), BUUR_VERSION );
        wp_enqueue_style( 'buur-probleme',     BUUR_URI . '/assets/css/probleme.css',     array( 'buur-main' ), BUUR_VERSION );
        wp_enqueue_style( 'buur-services',     BUUR_URI . '/assets/css/services.css',     array( 'buur-main' ), BUUR_VERSION );
        wp_enqueue_style( 'buur-stats',        BUUR_URI . '/assets/css/stats.css',        array( 'buur-main' ), BUUR_VERSION );
        wp_enqueue_style( 'buur-pourquoi',     BUUR_URI . '/assets/css/pourquoi.css',     array( 'buur-main' ), BUUR_VERSION );
        wp_enqueue_style( 'buur-temoignages',  BUUR_URI . '/assets/css/temoignages.css',  array( 'buur-main' ), BUUR_VERSION );
        wp_enqueue_style( 'buur-cta',          BUUR_URI . '/assets/css/cta.css',          array( 'buur-main' ), BUUR_VERSION );
        wp_enqueue_style( 'buur-scroll-frames',BUUR_URI . '/assets/css/scroll-frames.css',array( 'buur-main' ), BUUR_VERSION );
    }

    // --- CSS page Contact ---
    if ( is_page_template( 'page-contact.php' ) ) {
        wp_enqueue_style( 'buur-contact', BUUR_URI . '/assets/css/contact.css', array( 'buur-main' ), BUUR_VERSION );
    }

    // --- CSS page Tarifs ---
    if ( is_page_template( 'page-tarifs.php' ) ) {
        wp_enqueue_style( 'buur-tarifs', BUUR_URI . '/assets/css/tarifs.css', array( 'buur-main' ), BUUR_VERSION );
    }

    // --- JS homepage ---
    if ( is_front_page() ) {

        // GSAP CDN
        wp_enqueue_script( 'gsap',              'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js',           array(),         '3.12.5', true );
        wp_enqueue_script( 'gsap-scrolltrigger','https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js', array( 'gsap' ), '3.12.5', true );
        wp_enqueue_script( 'gsap-splittext',    'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/SplitText.min.js',     array( 'gsap' ), '3.12.5', true );

        // JS internes
        wp_enqueue_script( 'buur-preloader',       BUUR_URI . '/assets/js/preloader.js',       array(),                                         BUUR_VERSION, true );
        wp_enqueue_script( 'buur-gsap-animations', BUUR_URI . '/assets/js/gsap-animations.js', array( 'gsap-scrolltrigger', 'gsap-splittext' ), BUUR_VERSION, true );
        wp_enqueue_script( 'buur-scroll-frames',   BUUR_URI . '/assets/js/scroll-frames.js',   array( 'gsap-scrolltrigger' ),                   BUUR_VERSION, true );
        wp_enqueue_script( 'buur-svc-swiper',      BUUR_URI . '/assets/js/svc-swiper.js',      array( 'buur-scroll-frames' ),                   BUUR_VERSION, true );
        wp_enqueue_script( 'buur-interactions',    BUUR_URI . '/assets/js/interactions.js',    array( 'buur-gsap-animations' ),                 BUUR_VERSION, true );

        // Données chapitres depuis le customizer
        $chapters_data = array();
        $chapter_defaults = array(
            1 => array( 'stat' => '87%',   'label' => 'des acheteurs cherchent en ligne avant tout achat',      'title' => "L'Afrique <em>en ligne.</em>",              'sub' => 'Votre business mérite une présence digitale de classe mondiale.' ),
            2 => array( 'stat' => '3 sec', 'label' => 'pour convaincre un visiteur ou le perdre',               'title' => 'Un site qui <em>vous ressemble.</em>',      'sub' => 'Design premium, conçu pour les entrepreneurs africains.' ),
            3 => array( 'stat' => '100%',  'label' => 'sur mesure — aucun template, aucun compromis',           'title' => 'Construit <em>pour durer.</em>',            'sub' => 'Code propre, rapide, évolutif. Zéro compromis.' ),
            4 => array( 'stat' => '×3',    'label' => 'de trafic organique en moyenne après optimisation',      'title' => 'Premier sur <em>Google.</em>',             'sub' => 'SEO local maîtrisé. Vos clients vous trouvent avant la concurrence.' ),
            5 => array( 'stat' => '24h',   'label' => 'votre boutique ouverte, même quand vous dormez',         'title' => 'Vendez <em>sans limite.</em>',             'sub' => 'E-commerce, Wave, Orange Money. Votre boutique ouverte 24h/24.' ),
            6 => array( 'stat' => '7j',    'label' => 'délai moyen de livraison, chrono en main',               'title' => 'Une équipe <em>à vos côtés.</em>',        'sub' => "Support dédié, formation incluse. Vous n'êtes jamais seul." ),
            7 => array( 'stat' => '+50',   'label' => 'entrepreneurs accompagnés avec succès',                  'title' => 'Des résultats <em>mesurables.</em>',       'sub' => 'Chaque action optimisée. Chaque chiffre suivi.' ),
        );
        for ( $i = 1; $i <= 7; $i++ ) :
            $d = $chapter_defaults[ $i ];
            $chapters_data[] = array(
                'stat'  => get_theme_mod( 'buur_ch' . $i . '_stat',  $d['stat'] ),
                'label' => get_theme_mod( 'buur_ch' . $i . '_label', $d['label'] ),
                'title' => get_theme_mod( 'buur_ch' . $i . '_title', $d['title'] ),
                'sub'   => get_theme_mod( 'buur_ch' . $i . '_sub',   $d['sub'] ),
            );
        endfor;

        wp_localize_script( 'buur-scroll-frames', 'buurTheme', array(
            'url'      => BUUR_URI,
            'chapters' => $chapters_data,
        ) );
    }

    // --- JS principal (toutes les pages) ---
    wp_enqueue_script( 'buur-main', BUUR_URI . '/assets/js/main.js', array(), BUUR_VERSION, true );

    // Données JS globales
    wp_localize_script( 'buur-main', 'buurData', array(
        'ajaxUrl'    => admin_url( 'admin-ajax.php' ),
        'nonce'      => wp_create_nonce( 'buur-nonce' ),
        'themeUri'   => BUUR_URI,
        'whatsappSN' => buur_whatsapp_url( 'sn' ),
        'whatsappFR' => buur_whatsapp_url( 'fr' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'buur_enqueue_assets' );
