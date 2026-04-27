<?php
/**
 * BUUR Digital — Customizer WordPress.
 * Couvre toutes les sections de la page d'accueil.
 * Hero & CTA & Services : choix video OU photo de fond.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function buur_customizer_register( $wp_customize ) {

    // ============================================================
    // SECTION 1 — WhatsApp & Contacts
    // ============================================================
    $wp_customize->add_section( 'buur_whatsapp', array(
        'title'    => __( 'WhatsApp — Contacts', 'buur-digital' ),
        'priority' => 30,
    ) );

    $wp_customize->add_setting( 'buur_whatsapp_sn', array(
        'default'           => '+221000000000',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'buur_whatsapp_sn', array(
        'label'   => __( 'Numero WhatsApp Senegal (avec +221)', 'buur-digital' ),
        'section' => 'buur_whatsapp',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'buur_whatsapp_fr', array(
        'default'           => '+33000000000',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'buur_whatsapp_fr', array(
        'label'   => __( 'Numero WhatsApp France (avec +33)', 'buur-digital' ),
        'section' => 'buur_whatsapp',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'buur_whatsapp_msg', array(
        'default'           => 'Bonjour, je souhaite demarrer un projet web avec BUUR Digital.',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'buur_whatsapp_msg', array(
        'label'   => __( 'Message WhatsApp pre-rempli', 'buur-digital' ),
        'section' => 'buur_whatsapp',
        'type'    => 'textarea',
    ) );

    // ============================================================
    // SECTION 2 — Hero
    // ============================================================
    $wp_customize->add_section( 'buur_hero', array(
        'title'    => __( 'Hero — Fond & Textes', 'buur-digital' ),
        'priority' => 31,
    ) );

    $wp_customize->add_setting( 'buur_hero_bg_type', array(
        'default'           => 'video',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'buur_hero_bg_type', array(
        'label'   => __( 'Type de fond', 'buur-digital' ),
        'section' => 'buur_hero',
        'type'    => 'select',
        'choices' => array(
            'video' => __( 'Video (hero-loop.mp4)', 'buur-digital' ),
            'image' => __( 'Photo personnalisee', 'buur-digital' ),
        ),
    ) );

    $wp_customize->add_setting( 'buur_hero_bg_image', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'buur_hero_bg_image', array(
        'label'     => __( 'Photo de fond Hero', 'buur-digital' ),
        'section'   => 'buur_hero',
        'mime_type' => 'image',
    ) ) );

    $wp_customize->add_setting( 'buur_hero_badge', array(
        'default'           => 'Dakar, Senegal — Agence Web Premium',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'buur_hero_badge', array(
        'label'   => __( 'Texte du badge', 'buur-digital' ),
        'section' => 'buur_hero',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'buur_hero_title', array(
        'default'           => "L'agence web des rois du digital",
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'buur_hero_title', array(
        'label'   => __( 'Titre principal', 'buur-digital' ),
        'section' => 'buur_hero',
        'type'    => 'textarea',
    ) );

    $wp_customize->add_setting( 'buur_hero_tagline', array(
        'default'           => "Des sites de classe mondiale, au prix de l'Afrique.",
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'buur_hero_tagline', array(
        'label'   => __( 'Tagline (sous-titre)', 'buur-digital' ),
        'section' => 'buur_hero',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'buur_hero_btn_sn', array(
        'default'           => 'WhatsApp Senegal',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'buur_hero_btn_sn', array(
        'label'   => __( 'Label bouton WhatsApp Senegal', 'buur-digital' ),
        'section' => 'buur_hero',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'buur_hero_btn_fr', array(
        'default'           => 'WhatsApp France',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'buur_hero_btn_fr', array(
        'label'   => __( 'Label bouton WhatsApp France', 'buur-digital' ),
        'section' => 'buur_hero',
        'type'    => 'text',
    ) );

    // ============================================================
    // SECTION 3 — Services (3 cartes entieres + choix fond)
    // ============================================================
    $wp_customize->add_section( 'buur_services', array(
        'title'    => __( 'Services — Cartes & Fonds', 'buur-digital' ),
        'priority' => 32,
    ) );

    $wp_customize->add_setting( 'buur_services_eyebrow', array(
        'default'           => 'NOS SERVICES',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'buur_services_eyebrow', array(
        'label'   => __( 'Surtitre', 'buur-digital' ),
        'section' => 'buur_services',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'buur_services_title', array(
        'default'           => 'Choisissez votre univers digital',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'buur_services_title', array(
        'label'   => __( 'Titre de la section', 'buur-digital' ),
        'section' => 'buur_services',
        'type'    => 'text',
    ) );

    // --- 3 cartes ---
    $service_defaults = array(
        1 => array( 'title' => 'Site Vitrine',   'desc' => 'Une presence professionnelle en ligne qui inspire confiance.', 'price' => '150 000 FCFA', 'f1' => 'Design premium sur mesure', 'f2' => 'Optimise mobile & desktop', 'f3' => 'SEO local inclus', 'f4' => 'Livraison en 7 jours' ),
        2 => array( 'title' => 'Site E-commerce', 'desc' => 'Vendez vos produits partout au Senegal et en Afrique.',         'price' => '250 000 FCFA', 'f1' => 'Boutique WooCommerce',     'f2' => 'Wave & Orange Money',    'f3' => 'Gestion des commandes', 'f4' => 'Formation incluse' ),
        3 => array( 'title' => 'Campagnes Meta',  'desc' => 'Publicites Facebook & Instagram ciblees, garanties.',          'price' => 'Sur devis',    'f1' => 'Ciblage hyper-local',    'f2' => 'Creation des visuels',   'f3' => 'Suivi en temps reel',   'f4' => 'Rapport mensuel' ),
    );

    for ( $i = 1; $i <= 3; $i++ ) :
        $d = $service_defaults[ $i ];
        $prefix = 'buur_service' . $i;
        $num    = 'Carte ' . $i . ' — ';

        // Titre
        $wp_customize->add_setting( "{$prefix}_title", array( 'default' => $d['title'], 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
        $wp_customize->add_control( "{$prefix}_title", array( 'label' => __( $num . 'Titre', 'buur-digital' ), 'section' => 'buur_services', 'type' => 'text' ) );

        // Description
        $wp_customize->add_setting( "{$prefix}_desc", array( 'default' => $d['desc'], 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage' ) );
        $wp_customize->add_control( "{$prefix}_desc", array( 'label' => __( $num . 'Description', 'buur-digital' ), 'section' => 'buur_services', 'type' => 'textarea' ) );

        // Prix
        $wp_customize->add_setting( "{$prefix}_price", array( 'default' => $d['price'], 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
        $wp_customize->add_control( "{$prefix}_price", array( 'label' => __( $num . 'Prix', 'buur-digital' ), 'section' => 'buur_services', 'type' => 'text' ) );

        // Features 1-4
        foreach ( array( 1, 2, 3, 4 ) as $f ) :
            $wp_customize->add_setting( "{$prefix}_feat{$f}", array( 'default' => $d[ 'f' . $f ], 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
            $wp_customize->add_control( "{$prefix}_feat{$f}", array( 'label' => __( $num . 'Feature ' . $f, 'buur-digital' ), 'section' => 'buur_services', 'type' => 'text' ) );
        endforeach;

        // Type de fond
        $wp_customize->add_setting( "{$prefix}_bg_type", array( 'default' => 'video', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
        $wp_customize->add_control( "{$prefix}_bg_type", array(
            'label'   => __( $num . 'Type de fond', 'buur-digital' ),
            'section' => 'buur_services',
            'type'    => 'select',
            'choices' => array(
                'video' => __( 'Video', 'buur-digital' ),
                'image' => __( 'Photo personnalisee', 'buur-digital' ),
            ),
        ) );

        // Photo de fond
        $wp_customize->add_setting( "{$prefix}_bg_image", array( 'default' => '', 'sanitize_callback' => 'absint', 'transport' => 'refresh' ) );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, "{$prefix}_bg_image", array(
            'label'     => __( $num . 'Photo de fond', 'buur-digital' ),
            'section'   => 'buur_services',
            'mime_type' => 'image',
        ) ) );

    endfor;

    // ============================================================
    // SECTION 4 — Notre ADN
    // ============================================================
    $wp_customize->add_section( 'buur_adn', array(
        'title'    => __( 'Notre ADN — Pourquoi BUUR ?', 'buur-digital' ),
        'priority' => 33,
    ) );

    $wp_customize->add_setting( 'buur_adn_eyebrow', array( 'default' => 'NOTRE ADN', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'buur_adn_eyebrow', array( 'label' => __( 'Surtitre', 'buur-digital' ), 'section' => 'buur_adn', 'type' => 'text' ) );

    $wp_customize->add_setting( 'buur_adn_title', array( 'default' => 'Pourquoi choisir BUUR ?', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'buur_adn_title', array( 'label' => __( 'Titre', 'buur-digital' ), 'section' => 'buur_adn', 'type' => 'text' ) );

    $adn_cards = array(
        1 => array( 'title' => 'Excellence',    'desc' => 'Des sites qui rivalisent avec les meilleures agences internationales.' ),
        2 => array( 'title' => 'Accessibilite', 'desc' => 'Prix transparents et honnetes. Le luxe web pour tous les budgets.' ),
        3 => array( 'title' => 'Innovation',    'desc' => 'Technologies de pointe : IA, animations 3D, videos generatives.' ),
    );
    foreach ( $adn_cards as $n => $c ) :
        $wp_customize->add_setting( "buur_adn_card{$n}_title", array( 'default' => $c['title'], 'sanitize_callback' => 'sanitize_text_field',     'transport' => 'postMessage' ) );
        $wp_customize->add_control( "buur_adn_card{$n}_title", array( 'label' => __( 'Carte ' . $n . ' — Titre', 'buur-digital' ),       'section' => 'buur_adn', 'type' => 'text' ) );
        $wp_customize->add_setting( "buur_adn_card{$n}_desc",  array( 'default' => $c['desc'],  'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage' ) );
        $wp_customize->add_control( "buur_adn_card{$n}_desc",  array( 'label' => __( 'Carte ' . $n . ' — Description', 'buur-digital' ), 'section' => 'buur_adn', 'type' => 'textarea' ) );
    endforeach;

    // ============================================================
    // SECTION 5 — Stats
    // ============================================================
    $wp_customize->add_section( 'buur_stats', array(
        'title'    => __( 'Statistiques', 'buur-digital' ),
        'priority' => 34,
    ) );

    $stats = array(
        array( 'key' => 'buur_stat1', 'lv' => 'Stat 1 - Valeur', 'lt' => 'Stat 1 - Libelle', 'dv' => '50+',    'dt' => 'Sites livres' ),
        array( 'key' => 'buur_stat2', 'lv' => 'Stat 2 - Valeur', 'lt' => 'Stat 2 - Libelle', 'dv' => '3 ans',  'dt' => "D'experience" ),
        array( 'key' => 'buur_stat3', 'lv' => 'Stat 3 - Valeur', 'lt' => 'Stat 3 - Libelle', 'dv' => '98%',    'dt' => 'Clients satisfaits' ),
        array( 'key' => 'buur_stat4', 'lv' => 'Stat 4 - Valeur', 'lt' => 'Stat 4 - Libelle', 'dv' => '2 pays', 'dt' => 'Senegal & France' ),
    );
    foreach ( $stats as $s ) :
        $wp_customize->add_setting( $s['key'] . '_value', array( 'default' => $s['dv'], 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
        $wp_customize->add_control( $s['key'] . '_value', array( 'label' => $s['lv'], 'section' => 'buur_stats', 'type' => 'text' ) );
        $wp_customize->add_setting( $s['key'] . '_label', array( 'default' => $s['dt'], 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
        $wp_customize->add_control( $s['key'] . '_label', array( 'label' => $s['lt'], 'section' => 'buur_stats', 'type' => 'text' ) );
    endforeach;

    // ============================================================
    // SECTION 6 — Temoignages
    // ============================================================
    $wp_customize->add_section( 'buur_temoignages', array(
        'title'    => __( 'Temoignages', 'buur-digital' ),
        'priority' => 35,
    ) );

    $wp_customize->add_setting( 'buur_temoignages_eyebrow', array( 'default' => 'ILS NOUS FONT CONFIANCE', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'buur_temoignages_eyebrow', array( 'label' => __( 'Surtitre', 'buur-digital' ), 'section' => 'buur_temoignages', 'type' => 'text' ) );

    $wp_customize->add_setting( 'buur_temoignages_title', array( 'default' => 'Ce que disent nos clients', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'buur_temoignages_title', array( 'label' => __( 'Titre', 'buur-digital' ), 'section' => 'buur_temoignages', 'type' => 'text' ) );

    // ============================================================
    // SECTION 7 — CTA Final
    // ============================================================
    $wp_customize->add_section( 'buur_cta', array(
        'title'    => __( 'CTA Final — Fond & Textes', 'buur-digital' ),
        'priority' => 36,
    ) );

    $wp_customize->add_setting( 'buur_cta_bg_type', array( 'default' => 'video', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
    $wp_customize->add_control( 'buur_cta_bg_type', array(
        'label'   => __( 'Type de fond', 'buur-digital' ),
        'section' => 'buur_cta',
        'type'    => 'select',
        'choices' => array(
            'video' => __( 'Video (cta-portal.mp4)', 'buur-digital' ),
            'image' => __( 'Photo personnalisee', 'buur-digital' ),
        ),
    ) );

    $wp_customize->add_setting( 'buur_cta_bg_image', array( 'default' => '', 'sanitize_callback' => 'absint', 'transport' => 'refresh' ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'buur_cta_bg_image', array(
        'label'     => __( 'Photo de fond CTA', 'buur-digital' ),
        'section'   => 'buur_cta',
        'mime_type' => 'image',
    ) ) );

    $wp_customize->add_setting( 'buur_cta_eyebrow', array( 'default' => 'REJOINS LE ROYAUME', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'buur_cta_eyebrow', array( 'label' => __( 'Surtitre', 'buur-digital' ), 'section' => 'buur_cta', 'type' => 'text' ) );

    $wp_customize->add_setting( 'buur_cta_title', array( 'default' => "Demarrons votre projet aujourd'hui.", 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'buur_cta_title', array( 'label' => __( 'Titre principal', 'buur-digital' ), 'section' => 'buur_cta', 'type' => 'textarea' ) );

    $wp_customize->add_setting( 'buur_cta_sub', array( 'default' => 'Un message WhatsApp suffit. Reponse garantie en moins de 24h.', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'buur_cta_sub', array( 'label' => __( 'Sous-texte', 'buur-digital' ), 'section' => 'buur_cta', 'type' => 'text' ) );

    $wp_customize->add_setting( 'buur_cta_btn_sn', array( 'default' => 'WhatsApp Senegal', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'buur_cta_btn_sn', array( 'label' => __( 'Label bouton WhatsApp Senegal', 'buur-digital' ), 'section' => 'buur_cta', 'type' => 'text' ) );

    $wp_customize->add_setting( 'buur_cta_btn_fr', array( 'default' => 'WhatsApp France', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'buur_cta_btn_fr', array( 'label' => __( 'Label bouton WhatsApp France', 'buur-digital' ), 'section' => 'buur_cta', 'type' => 'text' ) );

    // ============================================================
    // SECTION 8 — Couleurs
    // ============================================================
    $wp_customize->add_section( 'buur_colors', array(
        'title'    => __( 'Couleurs BUUR', 'buur-digital' ),
        'priority' => 37,
    ) );

    $wp_customize->add_setting( 'buur_color_orange', array( 'default' => '#ea5b13', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'buur_color_orange', array( 'label' => __( 'Couleur Orange BUUR', 'buur-digital' ), 'section' => 'buur_colors' ) ) );

    $wp_customize->add_setting( 'buur_color_blue', array( 'default' => '#243a85', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'buur_color_blue', array( 'label' => __( 'Couleur Bleue BUUR', 'buur-digital' ), 'section' => 'buur_colors' ) ) );
}
add_action( 'customize_register', 'buur_customizer_register' );
