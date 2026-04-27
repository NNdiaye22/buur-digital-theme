<?php
/**
 * BUUR Digital — Customizer WordPress.
 * Hero & CTA & Services : choix video (upload) OU photo de fond.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function buur_customizer_register( $wp_customize ) {

    // ============================================================
    // SECTION 1 — WhatsApp & Contacts
    // ============================================================
    $wp_customize->add_section( 'buur_whatsapp', array(
        'title' => __( 'WhatsApp — Contacts', 'buur-digital' ), 'priority' => 30,
    ) );
    foreach ( array(
        array( 'buur_whatsapp_sn',  'Numero WhatsApp Senegal (avec +221)', '+221000000000', 'text' ),
        array( 'buur_whatsapp_fr',  'Numero WhatsApp France (avec +33)',   '+33000000000',  'text' ),
        array( 'buur_whatsapp_msg', 'Message WhatsApp pre-rempli', 'Bonjour, je souhaite demarrer un projet avec BUUR Digital.', 'textarea' ),
    ) as $s ) :
        $wp_customize->add_setting( $s[0], array( 'default' => $s[2], 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
        $wp_customize->add_control( $s[0], array( 'label' => __( $s[1], 'buur-digital' ), 'section' => 'buur_whatsapp', 'type' => $s[3] ) );
    endforeach;

    // ============================================================
    // SECTION 2 — Hero
    // ============================================================
    $wp_customize->add_section( 'buur_hero', array(
        'title' => __( 'Hero — Fond & Textes', 'buur-digital' ), 'priority' => 31,
    ) );

    // Type fond
    $wp_customize->add_setting( 'buur_hero_bg_type', array( 'default' => 'video', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
    $wp_customize->add_control( 'buur_hero_bg_type', array(
        'label' => __( 'Type de fond', 'buur-digital' ), 'section' => 'buur_hero', 'type' => 'select',
        'choices' => array( 'video' => __( 'Video', 'buur-digital' ), 'image' => __( 'Photo', 'buur-digital' ) ),
    ) );
    // Upload video
    $wp_customize->add_setting( 'buur_hero_bg_video', array( 'default' => '', 'sanitize_callback' => 'absint', 'transport' => 'refresh' ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'buur_hero_bg_video', array(
        'label' => __( 'Video de fond Hero (si type = Video)', 'buur-digital' ),
        'section' => 'buur_hero', 'mime_type' => 'video',
    ) ) );
    // Upload photo
    $wp_customize->add_setting( 'buur_hero_bg_image', array( 'default' => '', 'sanitize_callback' => 'absint', 'transport' => 'refresh' ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'buur_hero_bg_image', array(
        'label' => __( 'Photo de fond Hero (si type = Photo)', 'buur-digital' ),
        'section' => 'buur_hero', 'mime_type' => 'image',
    ) ) );
    // Textes hero
    foreach ( array(
        array( 'buur_hero_badge',   'Texte du badge',              'Dakar, Senegal — Agence Web Premium', 'text' ),
        array( 'buur_hero_title',   'Titre principal',             "L'agence web des rois du digital",    'textarea' ),
        array( 'buur_hero_tagline', 'Tagline (sous-titre)',        "Des sites de classe mondiale, au prix de l'Afrique.", 'text' ),
        array( 'buur_hero_btn_sn',  'Label bouton WhatsApp Senegal', 'WhatsApp Senegal', 'text' ),
        array( 'buur_hero_btn_fr',  'Label bouton WhatsApp France',  'WhatsApp France',  'text' ),
    ) as $s ) :
        $wp_customize->add_setting( $s[0], array( 'default' => $s[2], 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage' ) );
        $wp_customize->add_control( $s[0], array( 'label' => __( $s[1], 'buur-digital' ), 'section' => 'buur_hero', 'type' => $s[3] ) );
    endforeach;

    // ============================================================
    // SECTION 3 — Services
    // ============================================================
    $wp_customize->add_section( 'buur_services', array(
        'title' => __( 'Services — Cartes & Fonds', 'buur-digital' ), 'priority' => 32,
    ) );

    $wp_customize->add_setting( 'buur_services_eyebrow', array( 'default' => 'NOS SERVICES', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'buur_services_eyebrow', array( 'label' => __( 'Surtitre', 'buur-digital' ), 'section' => 'buur_services', 'type' => 'text' ) );
    $wp_customize->add_setting( 'buur_services_title', array( 'default' => 'Choisissez votre univers digital', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'buur_services_title', array( 'label' => __( 'Titre de la section', 'buur-digital' ), 'section' => 'buur_services', 'type' => 'text' ) );

    $sdefs = array(
        1 => array( 'title' => 'Site Vitrine',    'desc' => 'Une presence professionnelle en ligne qui inspire confiance.', 'price' => '150 000 FCFA', 'f1' => 'Design premium sur mesure',  'f2' => 'Optimise mobile & desktop', 'f3' => 'SEO local inclus',       'f4' => 'Livraison en 7 jours' ),
        2 => array( 'title' => 'Site E-commerce', 'desc' => 'Vendez vos produits partout au Senegal et en Afrique.',        'price' => '250 000 FCFA', 'f1' => 'Boutique WooCommerce',      'f2' => 'Wave & Orange Money',      'f3' => 'Gestion des commandes', 'f4' => 'Formation incluse' ),
        3 => array( 'title' => 'Campagnes Meta',  'desc' => 'Publicites Facebook & Instagram ciblees, garanties.',         'price' => 'Sur devis',    'f1' => 'Ciblage hyper-local',      'f2' => 'Creation des visuels',     'f3' => 'Suivi en temps reel',   'f4' => 'Rapport mensuel' ),
    );

    for ( $i = 1; $i <= 3; $i++ ) :
        $d  = $sdefs[ $i ];
        $p  = 'buur_service' . $i;
        $lp = 'Carte ' . $i . ' — ';

        // Titre, description, prix
        $wp_customize->add_setting( "{$p}_title", array( 'default' => $d['title'], 'sanitize_callback' => 'sanitize_text_field',     'transport' => 'postMessage' ) );
        $wp_customize->add_control( "{$p}_title", array( 'label' => __( $lp . 'Titre',       'buur-digital' ), 'section' => 'buur_services', 'type' => 'text' ) );
        $wp_customize->add_setting( "{$p}_desc",  array( 'default' => $d['desc'],  'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage' ) );
        $wp_customize->add_control( "{$p}_desc",  array( 'label' => __( $lp . 'Description', 'buur-digital' ), 'section' => 'buur_services', 'type' => 'textarea' ) );
        $wp_customize->add_setting( "{$p}_price", array( 'default' => $d['price'], 'sanitize_callback' => 'sanitize_text_field',     'transport' => 'postMessage' ) );
        $wp_customize->add_control( "{$p}_price", array( 'label' => __( $lp . 'Prix',        'buur-digital' ), 'section' => 'buur_services', 'type' => 'text' ) );

        // Features 1-4
        for ( $f = 1; $f <= 4; $f++ ) :
            $wp_customize->add_setting( "{$p}_feat{$f}", array( 'default' => $d[ 'f' . $f ], 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
            $wp_customize->add_control( "{$p}_feat{$f}", array( 'label' => __( $lp . 'Feature ' . $f, 'buur-digital' ), 'section' => 'buur_services', 'type' => 'text' ) );
        endfor;

        // Type de fond
        $wp_customize->add_setting( "{$p}_bg_type", array( 'default' => 'video', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
        $wp_customize->add_control( "{$p}_bg_type", array(
            'label'   => __( $lp . 'Type de fond', 'buur-digital' ),
            'section' => 'buur_services', 'type' => 'select',
            'choices' => array(
                'video' => __( 'Video', 'buur-digital' ),
                'image' => __( 'Photo', 'buur-digital' ),
            ),
        ) );

        // Upload VIDEO de fond
        $wp_customize->add_setting( "{$p}_bg_video", array( 'default' => '', 'sanitize_callback' => 'absint', 'transport' => 'refresh' ) );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, "{$p}_bg_video", array(
            'label'     => __( $lp . 'Video de fond (si type = Video)', 'buur-digital' ),
            'section'   => 'buur_services',
            'mime_type' => 'video',
        ) ) );

        // Upload PHOTO de fond
        $wp_customize->add_setting( "{$p}_bg_image", array( 'default' => '', 'sanitize_callback' => 'absint', 'transport' => 'refresh' ) );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, "{$p}_bg_image", array(
            'label'     => __( $lp . 'Photo de fond (si type = Photo)', 'buur-digital' ),
            'section'   => 'buur_services',
            'mime_type' => 'image',
        ) ) );

    endfor;

    // ============================================================
    // SECTION 4 — Notre ADN
    // ============================================================
    $wp_customize->add_section( 'buur_adn', array( 'title' => __( 'Notre ADN — Pourquoi BUUR ?', 'buur-digital' ), 'priority' => 33 ) );
    $wp_customize->add_setting( 'buur_adn_eyebrow', array( 'default' => 'NOTRE ADN',            'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'buur_adn_eyebrow', array( 'label' => __( 'Surtitre', 'buur-digital' ), 'section' => 'buur_adn', 'type' => 'text' ) );
    $wp_customize->add_setting( 'buur_adn_title',   array( 'default' => 'Pourquoi choisir BUUR ?', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'buur_adn_title',   array( 'label' => __( 'Titre',    'buur-digital' ), 'section' => 'buur_adn', 'type' => 'text' ) );
    foreach ( array(
        1 => array( 'Excellence',    'Des sites qui rivalisent avec les meilleures agences internationales.' ),
        2 => array( 'Accessibilite', 'Prix transparents et honnetes. Le luxe web pour tous les budgets.' ),
        3 => array( 'Innovation',    'Technologies de pointe : IA, animations 3D, videos generatives.' ),
    ) as $n => $c ) :
        $wp_customize->add_setting( "buur_adn_card{$n}_title", array( 'default' => $c[0], 'sanitize_callback' => 'sanitize_text_field',     'transport' => 'postMessage' ) );
        $wp_customize->add_control( "buur_adn_card{$n}_title", array( 'label' => __( 'Carte ' . $n . ' — Titre',       'buur-digital' ), 'section' => 'buur_adn', 'type' => 'text' ) );
        $wp_customize->add_setting( "buur_adn_card{$n}_desc",  array( 'default' => $c[1], 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage' ) );
        $wp_customize->add_control( "buur_adn_card{$n}_desc",  array( 'label' => __( 'Carte ' . $n . ' — Description', 'buur-digital' ), 'section' => 'buur_adn', 'type' => 'textarea' ) );
    endforeach;

    // ============================================================
    // SECTION 5 — Stats
    // ============================================================
    $wp_customize->add_section( 'buur_stats', array( 'title' => __( 'Statistiques', 'buur-digital' ), 'priority' => 34 ) );
    foreach ( array(
        array( 'buur_stat1', '50+',    'Sites livres' ),
        array( 'buur_stat2', '3 ans',  "D'experience" ),
        array( 'buur_stat3', '98%',    'Clients satisfaits' ),
        array( 'buur_stat4', '2 pays', 'Senegal & France' ),
    ) as $k => $s ) :
        $n = $k + 1;
        $wp_customize->add_setting( $s[0] . '_value', array( 'default' => $s[1], 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
        $wp_customize->add_control( $s[0] . '_value', array( 'label' => __( 'Stat ' . $n . ' - Valeur',  'buur-digital' ), 'section' => 'buur_stats', 'type' => 'text' ) );
        $wp_customize->add_setting( $s[0] . '_label', array( 'default' => $s[2], 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
        $wp_customize->add_control( $s[0] . '_label', array( 'label' => __( 'Stat ' . $n . ' - Libelle', 'buur-digital' ), 'section' => 'buur_stats', 'type' => 'text' ) );
    endforeach;

    // ============================================================
    // SECTION 6 — Temoignages
    // ============================================================
    $wp_customize->add_section( 'buur_temoignages', array( 'title' => __( 'Temoignages', 'buur-digital' ), 'priority' => 35 ) );
    $wp_customize->add_setting( 'buur_temoignages_eyebrow', array( 'default' => 'ILS NOUS FONT CONFIANCE', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'buur_temoignages_eyebrow', array( 'label' => __( 'Surtitre', 'buur-digital' ), 'section' => 'buur_temoignages', 'type' => 'text' ) );
    $wp_customize->add_setting( 'buur_temoignages_title', array( 'default' => 'Ce que disent nos clients', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'buur_temoignages_title', array( 'label' => __( 'Titre', 'buur-digital' ), 'section' => 'buur_temoignages', 'type' => 'text' ) );

    // ============================================================
    // SECTION 7 — CTA Final
    // ============================================================
    $wp_customize->add_section( 'buur_cta', array( 'title' => __( 'CTA Final — Fond & Textes', 'buur-digital' ), 'priority' => 36 ) );

    $wp_customize->add_setting( 'buur_cta_bg_type', array( 'default' => 'video', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
    $wp_customize->add_control( 'buur_cta_bg_type', array(
        'label' => __( 'Type de fond', 'buur-digital' ), 'section' => 'buur_cta', 'type' => 'select',
        'choices' => array( 'video' => __( 'Video', 'buur-digital' ), 'image' => __( 'Photo', 'buur-digital' ) ),
    ) );
    $wp_customize->add_setting( 'buur_cta_bg_video', array( 'default' => '', 'sanitize_callback' => 'absint', 'transport' => 'refresh' ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'buur_cta_bg_video', array(
        'label' => __( 'Video de fond CTA (si type = Video)', 'buur-digital' ), 'section' => 'buur_cta', 'mime_type' => 'video',
    ) ) );
    $wp_customize->add_setting( 'buur_cta_bg_image', array( 'default' => '', 'sanitize_callback' => 'absint', 'transport' => 'refresh' ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'buur_cta_bg_image', array(
        'label' => __( 'Photo de fond CTA (si type = Photo)', 'buur-digital' ), 'section' => 'buur_cta', 'mime_type' => 'image',
    ) ) );
    foreach ( array(
        array( 'buur_cta_eyebrow', 'Surtitre',       'REJOINS LE ROYAUME',                                     'text' ),
        array( 'buur_cta_title',   'Titre principal', "Demarrons votre projet aujourd'hui.",                    'textarea' ),
        array( 'buur_cta_sub',     'Sous-texte',      'Un message WhatsApp suffit. Reponse garantie en 24h.',  'text' ),
        array( 'buur_cta_btn_sn',  'Bouton Senegal',  'WhatsApp Senegal',                                       'text' ),
        array( 'buur_cta_btn_fr',  'Bouton France',   'WhatsApp France',                                        'text' ),
    ) as $s ) :
        $wp_customize->add_setting( $s[0], array( 'default' => $s[2], 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage' ) );
        $wp_customize->add_control( $s[0], array( 'label' => __( $s[1], 'buur-digital' ), 'section' => 'buur_cta', 'type' => $s[3] ) );
    endforeach;

    // ============================================================
    // SECTION 8 — Couleurs
    // ============================================================
    $wp_customize->add_section( 'buur_colors', array( 'title' => __( 'Couleurs BUUR', 'buur-digital' ), 'priority' => 37 ) );
    $wp_customize->add_setting( 'buur_color_orange', array( 'default' => '#ea5b13', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'buur_color_orange', array( 'label' => __( 'Orange BUUR', 'buur-digital' ), 'section' => 'buur_colors' ) ) );
    $wp_customize->add_setting( 'buur_color_blue', array( 'default' => '#243a85', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'buur_color_blue', array( 'label' => __( 'Bleu BUUR', 'buur-digital' ), 'section' => 'buur_colors' ) ) );
}
add_action( 'customize_register', 'buur_customizer_register' );
