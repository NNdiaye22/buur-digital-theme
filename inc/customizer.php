<?php
/**
 * BUUR Digital — Customizer WordPress.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function buur_customizer_register( $wp_customize ) {

    // ============================================================
    // SECTION 1 — WhatsApp
    // ============================================================
    $wp_customize->add_section( 'buur_whatsapp', array(
        'title' => __( 'WhatsApp — Contact', 'buur-digital' ), 'priority' => 30,
    ) );
    foreach ( array(
        array( 'buur_whatsapp_fr',  'Numéro WhatsApp (avec +33)', '+33000000000', 'text' ),
        array( 'buur_whatsapp_msg', 'Message pré-rempli', 'Bonjour, je souhaite démarrer un projet avec BUUR Digital.', 'textarea' ),
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
    $wp_customize->add_setting( 'buur_hero_bg_image', array( 'default' => '', 'sanitize_callback' => 'absint', 'transport' => 'refresh' ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'buur_hero_bg_image', array(
        'label' => __( 'Photo de fond du Hero', 'buur-digital' ), 'section' => 'buur_hero', 'mime_type' => 'image',
    ) ) );
    foreach ( array(
        array( 'buur_hero_badge',   'Texte du badge',      'Dakar, Sénégal — Agence Web Premium',          'text' ),
        array( 'buur_hero_title',   'Titre principal',     "L'agence web des rois du digital",             'textarea' ),
        array( 'buur_hero_tagline', 'Tagline',             "Des sites de classe mondiale, au prix de l'Afrique.", 'text' ),
        array( 'buur_hero_btn_fr',  'Label bouton contact', 'Nous contacter',                               'text' ),
    ) as $s ) :
        $wp_customize->add_setting( $s[0], array( 'default' => $s[2], 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage' ) );
        $wp_customize->add_control( $s[0], array( 'label' => __( $s[1], 'buur-digital' ), 'section' => 'buur_hero', 'type' => $s[3] ) );
    endforeach;

    // ============================================================
    // SECTION 3 — Services (4 cartes)
    // ============================================================
    $wp_customize->add_section( 'buur_services', array(
        'title' => __( 'Services — Cartes & Photos', 'buur-digital' ), 'priority' => 32,
    ) );
    $wp_customize->add_setting( 'buur_services_eyebrow', array( 'default' => 'NOS SERVICES', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'buur_services_eyebrow', array( 'label' => __( 'Surtitre', 'buur-digital' ), 'section' => 'buur_services', 'type' => 'text' ) );
    $wp_customize->add_setting( 'buur_services_title', array( 'default' => 'Choisissez votre univers digital', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'buur_services_title', array( 'label' => __( 'Titre', 'buur-digital' ), 'section' => 'buur_services', 'type' => 'text' ) );

    $sdefs = array(
        1 => array( 'title' => 'Site Vitrine',    'desc' => 'Une présence professionnelle en ligne qui inspire confiance.', 'price' => '150 000 FCFA', 'f1' => 'Design premium sur mesure',  'f2' => 'Optimisé mobile & desktop', 'f3' => 'SEO local inclus',       'f4' => 'Livraison en 7 jours' ),
        2 => array( 'title' => 'Site E-commerce', 'desc' => 'Vendez vos produits partout au Sénégal et en Afrique.',        'price' => '250 000 FCFA', 'f1' => 'Boutique WooCommerce',      'f2' => 'Wave & Orange Money',      'f3' => 'Gestion des commandes', 'f4' => 'Formation incluse' ),
        3 => array( 'title' => 'Campagnes Meta',  'desc' => 'Publicités Facebook & Instagram ciblées, garanties.',         'price' => 'Sur devis',    'f1' => 'Ciblage hyper-local',      'f2' => 'Création des visuels',     'f3' => 'Suivi en temps réel',   'f4' => 'Rapport mensuel' ),
        4 => array( 'title' => 'BUUR Site',       'desc' => 'Votre site pro sans effort. On crée, on héberge, vous grandissez.', 'price' => '15 000 FCFA/mois', 'f1' => 'Zéro compétence requise', 'f2' => 'Hébergement inclus', 'f3' => 'Modifications sur demande', 'f4' => 'Support WhatsApp' ),
    );
    for ( $i = 1; $i <= 4; $i++ ) :
        $d = $sdefs[ $i ]; $p = 'buur_service' . $i; $lp = 'Carte ' . $i . ' — ';
        $wp_customize->add_setting( "{$p}_title", array( 'default' => $d['title'], 'sanitize_callback' => 'sanitize_text_field',     'transport' => 'postMessage' ) );
        $wp_customize->add_control( "{$p}_title", array( 'label' => __( $lp . 'Titre',       'buur-digital' ), 'section' => 'buur_services', 'type' => 'text' ) );
        $wp_customize->add_setting( "{$p}_desc",  array( 'default' => $d['desc'],  'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage' ) );
        $wp_customize->add_control( "{$p}_desc",  array( 'label' => __( $lp . 'Description', 'buur-digital' ), 'section' => 'buur_services', 'type' => 'textarea' ) );
        $wp_customize->add_setting( "{$p}_price", array( 'default' => $d['price'], 'sanitize_callback' => 'sanitize_text_field',     'transport' => 'postMessage' ) );
        $wp_customize->add_control( "{$p}_price", array( 'label' => __( $lp . 'Prix',        'buur-digital' ), 'section' => 'buur_services', 'type' => 'text' ) );
        for ( $f = 1; $f <= 4; $f++ ) :
            $wp_customize->add_setting( "{$p}_feat{$f}", array( 'default' => $d[ 'f' . $f ], 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
            $wp_customize->add_control( "{$p}_feat{$f}", array( 'label' => __( $lp . 'Feature ' . $f, 'buur-digital' ), 'section' => 'buur_services', 'type' => 'text' ) );
        endfor;
        $wp_customize->add_setting( "{$p}_bg_image", array( 'default' => '', 'sanitize_callback' => 'absint', 'transport' => 'refresh' ) );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, "{$p}_bg_image", array(
            'label' => __( $lp . 'Photo de fond', 'buur-digital' ), 'section' => 'buur_services', 'mime_type' => 'image',
        ) ) );
    endfor;

    // ============================================================
    // SECTION 4 — Notre ADN
    // ============================================================
    $wp_customize->add_section( 'buur_adn', array( 'title' => __( 'Notre ADN', 'buur-digital' ), 'priority' => 33 ) );
    $wp_customize->add_setting( 'buur_adn_eyebrow', array( 'default' => 'NOTRE ADN',             'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'buur_adn_eyebrow', array( 'label' => __( 'Surtitre', 'buur-digital' ), 'section' => 'buur_adn', 'type' => 'text' ) );
    $wp_customize->add_setting( 'buur_adn_title',   array( 'default' => 'Pourquoi choisir BUUR ?', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'buur_adn_title',   array( 'label' => __( 'Titre', 'buur-digital' ), 'section' => 'buur_adn', 'type' => 'text' ) );
    foreach ( array(
        1 => array( 'Excellence',     'Des sites qui rivalisent avec les meilleures agences internationales.' ),
        2 => array( 'Accessibilité',  'Prix transparents et honnêtes. Le luxe web pour tous les budgets.' ),
        3 => array( 'Innovation',     'Technologies de pointe : IA, animations 3D, visuels génératifs.' ),
    ) as $n => $c ) :
        $wp_customize->add_setting( "buur_adn_card{$n}_title", array( 'default' => $c[0], 'sanitize_callback' => 'sanitize_text_field',     'transport' => 'postMessage' ) );
        $wp_customize->add_control( "buur_adn_card{$n}_title", array( 'label' => __( 'Carte ' . $n . ' — Titre', 'buur-digital' ), 'section' => 'buur_adn', 'type' => 'text' ) );
        $wp_customize->add_setting( "buur_adn_card{$n}_desc",  array( 'default' => $c[1], 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage' ) );
        $wp_customize->add_control( "buur_adn_card{$n}_desc",  array( 'label' => __( 'Carte ' . $n . ' — Description', 'buur-digital' ), 'section' => 'buur_adn', 'type' => 'textarea' ) );
    endforeach;

    // ============================================================
    // SECTION 5 — Stats
    // ============================================================
    $wp_customize->add_section( 'buur_stats', array( 'title' => __( 'Statistiques', 'buur-digital' ), 'priority' => 34 ) );
    foreach ( array(
        array( 'buur_stat1', '50+',    'Sites livrés' ),
        array( 'buur_stat2', '3 ans',  "D'expérience" ),
        array( 'buur_stat3', '98%',    'Clients satisfaits' ),
        array( 'buur_stat4', '2 pays', 'Sénégal & France' ),
    ) as $k => $s ) :
        $n = $k + 1;
        $wp_customize->add_setting( $s[0] . '_value', array( 'default' => $s[1], 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
        $wp_customize->add_control( $s[0] . '_value', array( 'label' => __( 'Stat ' . $n . ' — Valeur',   'buur-digital' ), 'section' => 'buur_stats', 'type' => 'text' ) );
        $wp_customize->add_setting( $s[0] . '_label', array( 'default' => $s[2], 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
        $wp_customize->add_control( $s[0] . '_label', array( 'label' => __( 'Stat ' . $n . ' — Libellé', 'buur-digital' ), 'section' => 'buur_stats', 'type' => 'text' ) );
    endforeach;

    // ============================================================
    // SECTION 6 — Témoignages
    // ============================================================
    $wp_customize->add_section( 'buur_temoignages', array( 'title' => __( 'Témoignages', 'buur-digital' ), 'priority' => 35 ) );
    $wp_customize->add_setting( 'buur_temoignages_eyebrow', array( 'default' => 'ILS NOUS FONT CONFIANCE', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'buur_temoignages_eyebrow', array( 'label' => __( 'Surtitre', 'buur-digital' ), 'section' => 'buur_temoignages', 'type' => 'text' ) );
    $wp_customize->add_setting( 'buur_temoignages_title', array( 'default' => 'Ce que disent nos clients', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'buur_temoignages_title', array( 'label' => __( 'Titre', 'buur-digital' ), 'section' => 'buur_temoignages', 'type' => 'text' ) );

    // ============================================================
    // SECTION 7 — CTA Final
    // ============================================================
    $wp_customize->add_section( 'buur_cta', array( 'title' => __( 'CTA Final', 'buur-digital' ), 'priority' => 36 ) );
    $wp_customize->add_setting( 'buur_cta_bg_image', array( 'default' => '', 'sanitize_callback' => 'absint', 'transport' => 'refresh' ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'buur_cta_bg_image', array(
        'label' => __( 'Photo de fond du CTA', 'buur-digital' ), 'section' => 'buur_cta', 'mime_type' => 'image',
    ) ) );
    foreach ( array(
        array( 'buur_cta_eyebrow', 'Surtitre',        'REJOINS LE ROYAUME',                                    'text' ),
        array( 'buur_cta_title',   'Titre principal',  "Démarrons votre projet aujourd'hui.",                   'textarea' ),
        array( 'buur_cta_sub',     'Sous-texte',       'Un message WhatsApp suffit. Réponse garantie en 24h.', 'text' ),
        array( 'buur_cta_btn_fr',  'Label bouton',     'Nous contacter',                                        'text' ),
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

    // ============================================================
    // SECTION 9 — Chapitres scroll (stats centrales)
    // ============================================================
    $wp_customize->add_section( 'buur_chapters', array(
        'title'       => __( 'Chapitres — Stats centrales', 'buur-digital' ),
        'description' => __( 'Modifiez le chiffre et le texte affichés au centre de chaque chapitre du scroll.', 'buur-digital' ),
        'priority'    => 38,
    ) );

    $chapter_defaults = array(
        1 => array( 'stat' => '87%',   'label' => 'des acheteurs cherchent en ligne avant tout achat',      'title' => "L'Afrique en ligne",          'sub' => 'Votre business mérite une présence digitale de classe mondiale.' ),
        2 => array( 'stat' => '3 sec', 'label' => 'pour convaincre un visiteur ou le perdre',               'title' => 'Un site qui vous ressemble',   'sub' => 'Design premium, conçu pour les entrepreneurs africains.' ),
        3 => array( 'stat' => '100%',  'label' => 'sur mesure — aucun template, aucun compromis',           'title' => 'Construit pour durer',         'sub' => 'Code propre, rapide, évolutif. Zéro compromis.' ),
        4 => array( 'stat' => '×3',    'label' => 'de trafic organique en moyenne après optimisation',      'title' => 'Premier sur Google',           'sub' => 'SEO local maîtrisé. Vos clients vous trouvent avant la concurrence.' ),
        5 => array( 'stat' => '24h',   'label' => 'votre boutique ouverte, même quand vous dormez',         'title' => 'Vendez sans limite',           'sub' => 'E-commerce, Wave, Orange Money. Votre boutique ouverte 24h/24.' ),
        6 => array( 'stat' => '7j',    'label' => 'délai moyen de livraison, chrono en main',               'title' => 'Une équipe à vos côtés',      'sub' => "Support dédié, formation incluse. Vous n'êtes jamais seul." ),
        7 => array( 'stat' => '+50',   'label' => 'entrepreneurs accompagnés avec succès',                  'title' => 'Des résultats mesurables',     'sub' => 'Chaque action optimisée. Chaque chiffre suivi.' ),
    );

    for ( $i = 1; $i <= 7; $i++ ) :
        $d  = $chapter_defaults[ $i ];
        $p  = 'buur_ch' . $i;
        $lp = 'Chapitre ' . $i . ' — ';

        $wp_customize->add_setting( "{$p}_stat",  array( 'default' => $d['stat'],  'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
        $wp_customize->add_control( "{$p}_stat",  array( 'label' => __( $lp . 'Chiffre clé',  'buur-digital' ), 'section' => 'buur_chapters', 'type' => 'text' ) );

        $wp_customize->add_setting( "{$p}_label", array( 'default' => $d['label'], 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
        $wp_customize->add_control( "{$p}_label", array( 'label' => __( $lp . 'Label stat',   'buur-digital' ), 'section' => 'buur_chapters', 'type' => 'text' ) );

        $wp_customize->add_setting( "{$p}_title", array( 'default' => $d['title'], 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
        $wp_customize->add_control( "{$p}_title", array( 'label' => __( $lp . 'Titre',        'buur-digital' ), 'section' => 'buur_chapters', 'type' => 'text' ) );

        $wp_customize->add_setting( "{$p}_sub",   array( 'default' => $d['sub'],   'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'refresh' ) );
        $wp_customize->add_control( "{$p}_sub",   array( 'label' => __( $lp . 'Sous-titre',   'buur-digital' ), 'section' => 'buur_chapters', 'type' => 'textarea' ) );
    endfor;
}
add_action( 'customize_register', 'buur_customizer_register' );
