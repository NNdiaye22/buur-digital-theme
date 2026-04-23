<?php
/**
 * BUUR Digital — Customizer WordPress.
 * Permet de modifier les numéros WhatsApp, textes CTA et couleurs depuis l'admin.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function buur_customizer_register( $wp_customize ) {

    // -------------------------------------------------------
    // SECTION — Coordonnées WhatsApp
    // -------------------------------------------------------
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

    // -------------------------------------------------------
    // SECTION — Textes Hero
    // -------------------------------------------------------
    $wp_customize->add_section( 'buur_hero', array(
        'title'    => __( 'Hero — Textes', 'buur-digital' ),
        'priority' => 31,
    ) );

    $wp_customize->add_setting( 'buur_hero_title', array(
        'default'           => "L'AGENCE WEB\nDES ROIS DU DIGITAL",
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'buur_hero_title', array(
        'label'   => __( 'Titre principal Hero', 'buur-digital' ),
        'section' => 'buur_hero',
        'type'    => 'textarea',
    ) );

    $wp_customize->add_setting( 'buur_hero_tagline', array(
        'default'           => "L'excellence web, accessible à tous.",
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'buur_hero_tagline', array(
        'label'   => __( 'Tagline Hero', 'buur-digital' ),
        'section' => 'buur_hero',
        'type'    => 'text',
    ) );

    // -------------------------------------------------------
    // SECTION — Couleurs
    // -------------------------------------------------------
    $wp_customize->add_section( 'buur_colors', array(
        'title'    => __( 'Couleurs BUUR', 'buur-digital' ),
        'priority' => 32,
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
