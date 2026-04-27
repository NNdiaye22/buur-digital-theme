<?php
/**
 * BUUR Digital — Customizer WordPress.
 * Couvre toutes les sections de la page d'accueil.
 * Hero & CTA : choix vidéo OU photo de fond.
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
        'label'   => __( 'Numéro WhatsApp Sénégal (avec +221)', 'buur-digital' ),
        'section' => 'buur_whatsapp',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'buur_whatsapp_fr', array(
        'default'           => '+33000000000',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'buur_whatsapp_fr', array(
        'label'   => __( 'Numéro WhatsApp France (avec +33)', 'buur-digital' ),
        'section' => 'buur_whatsapp',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'buur_whatsapp_msg', array(
        'default'           => 'Bonjour, je souhaite démarrer un projet web avec BUUR Digital.',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'buur_whatsapp_msg', array(
        'label'   => __( 'Message WhatsApp pré-rempli', 'buur-digital' ),
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
            'image' => __( 'Photo personnalisée', 'buur-digital' ),
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
        'default'           => 'Dakar, Sénégal — Agence Web Premium',
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
        'default'           => 'WhatsApp Sénégal',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'buur_hero_btn_sn', array(
        'label'   => __( 'Label bouton WhatsApp Sénégal', 'buur-digital' ),
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
    // SECTION 3 — Services
    // ============================================================
    $wp_customize->add_section( 'buur_services', array(
        'title'    => __( 'Services', 'buur-digital' ),
        'priority' => 32,
    ) );

    $wp_customize->add_setting( 'buur_services_eyebrow', array(
        'default'           => 'CE QUE NOUS FAISONS',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'buur_services_eyebrow', array(
        'label'   => __( 'Surtitre (eyebrow)', 'buur-digital' ),
        'section' => 'buur_services',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'buur_services_title', array(
        'default'           => 'Nos services',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'buur_services_title', array(
        'label'   => __( 'Titre de la section', 'buur-digital' ),
        'section' => 'buur_services',
        'type'    => 'text',
    ) );

    // ============================================================
    // SECTION 4 — Notre ADN (Pourquoi)
    // ============================================================
    $wp_customize->add_section( 'buur_adn', array(
        'title'    => __( 'Notre ADN — Pourquoi BUUR ?', 'buur-digital' ),
        'priority' => 33,
    ) );

    $wp_customize->add_setting( 'buur_adn_eyebrow', array(
        'default'           => 'NOTRE ADN',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'buur_adn_eyebrow', array(
        'label'   => __( 'Surtitre', 'buur-digital' ),
        'section' => 'buur_adn',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'buur_adn_title', array(
        'default'           => 'Pourquoi choisir BUUR ?',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'buur_adn_title', array(
        'label'   => __( 'Titre', 'buur-digital' ),
        'section' => 'buur_adn',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'buur_adn_card1_title', array(
        'default'           => 'Excellence',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'buur_adn_card1_title', array(
        'label'   => __( 'Carte 1 — Titre', 'buur-digital' ),
        'section' => 'buur_adn',
        'type'    => 'text',
    ) );
    $wp_customize->add_setting( 'buur_adn_card1_desc', array(
        'default'           => 'Des sites qui rivalisent avec les meilleures agences internationales.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'buur_adn_card1_desc', array(
        'label'   => __( 'Carte 1 — Description', 'buur-digital' ),
        'section' => 'buur_adn',
        'type'    => 'textarea',
    ) );

    $wp_customize->add_setting( 'buur_adn_card2_title', array(
        'default'           => 'Accessibilité',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'buur_adn_card2_title', array(
        'label'   => __( 'Carte 2 — Titre (mise en avant)', 'buur-digital' ),
        'section' => 'buur_adn',
        'type'    => 'text',
    ) );
    $wp_customize->add_setting( 'buur_adn_card2_desc', array(
        'default'           => 'Prix transparents et honnêtes. Le luxe web pour tous les budgets.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'buur_adn_card2_desc', array(
        'label'   => __( 'Carte 2 — Description', 'buur-digital' ),
        'section' => 'buur_adn',
        'type'    => 'textarea',
    ) );

    $wp_customize->add_setting( 'buur_adn_card3_title', array(
        'default'           => 'Innovation',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'buur_adn_card3_title', array(
        'label'   => __( 'Carte 3 — Titre', 'buur-digital' ),
        'section' => 'buur_adn',
        'type'    => 'text',
    ) );
    $wp_customize->add_setting( 'buur_adn_card3_desc', array(
        'default'           => 'Technologies de pointe : IA, animations 3D, vidéos génératives.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'buur_adn_card3_desc', array(
        'label'   => __( 'Carte 3 — Description', 'buur-digital' ),
        'section' => 'buur_adn',
        'type'    => 'textarea',
    ) );

    // ============================================================
    // SECTION 5 — Stats
    // ============================================================
    $wp_customize->add_section( 'buur_stats', array(
        'title'    => __( 'Statistiques', 'buur-digital' ),
        'priority' => 34,
    ) );

    $stats = array(
        array( 'key' => 'buur_stat1', 'label_val' => 'Stat 1 - Valeur', 'label_txt' => 'Stat 1 - Libelle', 'def_val' => '50+',    'def_txt' => 'Sites livres' ),
        array( 'key' => 'buur_stat2', 'label_val' => 'Stat 2 - Valeur', 'label_txt' => 'Stat 2 - Libelle', 'def_val' => '3 ans',  'def_txt' => "D'experience" ),
        array( 'key' => 'buur_stat3', 'label_val' => 'Stat 3 - Valeur', 'label_txt' => 'Stat 3 - Libelle', 'def_val' => '98%',    'def_txt' => 'Clients satisfaits' ),
        array( 'key' => 'buur_stat4', 'label_val' => 'Stat 4 - Valeur', 'label_txt' => 'Stat 4 - Libelle', 'def_val' => '2 pays', 'def_txt' => 'Senegal & France' ),
    );
    foreach ( $stats as $s ) {
        $wp_customize->add_setting( $s['key'] . '_value', array( 'default' => $s['def_val'], 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
        $wp_customize->add_control( $s['key'] . '_value', array( 'label' => $s['label_val'], 'section' => 'buur_stats', 'type' => 'text' ) );
        $wp_customize->add_setting( $s['key'] . '_label', array( 'default' => $s['def_txt'], 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
        $wp_customize->add_control( $s['key'] . '_label', array( 'label' => $s['label_txt'], 'section' => 'buur_stats', 'type' => 'text' ) );
    }

    // ============================================================
    // SECTION 6 — Témoignages
    // ============================================================
    $wp_customize->add_section( 'buur_temoignages', array(
        'title'    => __( 'Témoignages', 'buur-digital' ),
        'priority' => 35,
    ) );

    $wp_customize->add_setting( 'buur_temoignages_eyebrow', array(
        'default'           => 'ILS NOUS FONT CONFIANCE',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'buur_temoignages_eyebrow', array(
        'label'   => __( 'Surtitre', 'buur-digital' ),
        'section' => 'buur_temoignages',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'buur_temoignages_title', array(
        'default'           => 'Ce que disent nos clients',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'buur_temoignages_title', array(
        'label'   => __( 'Titre', 'buur-digital' ),
        'section' => 'buur_temoignages',
        'type'    => 'text',
    ) );

    // ============================================================
    // SECTION 7 — CTA Final
    // ============================================================
    $wp_customize->add_section( 'buur_cta', array(
        'title'    => __( 'CTA Final — Fond & Textes', 'buur-digital' ),
        'priority' => 36,
    ) );

    $wp_customize->add_setting( 'buur_cta_bg_type', array(
        'default'           => 'video',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'buur_cta_bg_type', array(
        'label'   => __( 'Type de fond', 'buur-digital' ),
        'section' => 'buur_cta',
        'type'    => 'select',
        'choices' => array(
            'video' => __( 'Video (cta-portal.mp4)', 'buur-digital' ),
            'image' => __( 'Photo personnalisée', 'buur-digital' ),
        ),
    ) );

    $wp_customize->add_setting( 'buur_cta_bg_image', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'buur_cta_bg_image', array(
        'label'     => __( 'Photo de fond CTA', 'buur-digital' ),
        'section'   => 'buur_cta',
        'mime_type' => 'image',
    ) ) );

    $wp_customize->add_setting( 'buur_cta_eyebrow', array(
        'default'           => 'REJOINS LE ROYAUME',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'buur_cta_eyebrow', array(
        'label'   => __( 'Surtitre (eyebrow)', 'buur-digital' ),
        'section' => 'buur_cta',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'buur_cta_title', array(
        'default'           => "Demarrons votre projet aujourd'hui.",
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'buur_cta_title', array(
        'label'   => __( 'Titre principal', 'buur-digital' ),
        'section' => 'buur_cta',
        'type'    => 'textarea',
    ) );

    $wp_customize->add_setting( 'buur_cta_sub', array(
        'default'           => 'Un message WhatsApp suffit. Reponse garantie en moins de 24h.',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'buur_cta_sub', array(
        'label'   => __( 'Sous-texte', 'buur-digital' ),
        'section' => 'buur_cta',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'buur_cta_btn_sn', array(
        'default'           => 'WhatsApp Sénégal',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'buur_cta_btn_sn', array(
        'label'   => __( 'Label bouton WhatsApp Sénégal', 'buur-digital' ),
        'section' => 'buur_cta',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'buur_cta_btn_fr', array(
        'default'           => 'WhatsApp France',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'buur_cta_btn_fr', array(
        'label'   => __( 'Label bouton WhatsApp France', 'buur-digital' ),
        'section' => 'buur_cta',
        'type'    => 'text',
    ) );

    // ============================================================
    // SECTION 8 — Couleurs
    // ============================================================
    $wp_customize->add_section( 'buur_colors', array(
        'title'    => __( 'Couleurs BUUR', 'buur-digital' ),
        'priority' => 37,
    ) );

    $wp_customize->add_setting( 'buur_color_orange', array(
        'default'           => '#ea5b13',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'buur_color_orange', array(
        'label'   => __( 'Couleur Orange BUUR', 'buur-digital' ),
        'section' => 'buur_colors',
    ) ) );

    $wp_customize->add_setting( 'buur_color_blue', array(
        'default'           => '#243a85',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'buur_color_blue', array(
        'label'   => __( 'Couleur Bleue BUUR', 'buur-digital' ),
        'section' => 'buur_colors',
    ) ) );
}
add_action( 'customize_register', 'buur_customizer_register' );
