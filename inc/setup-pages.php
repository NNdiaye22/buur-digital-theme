<?php
/**
 * BUUR Digital — Creation automatique des pages essentielles
 * S'execute une seule fois apres activation du theme.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function buur_create_essential_pages() {

    // Ne tourne qu'une seule fois (option stockee en base)
    if ( get_option( 'buur_pages_created' ) ) return;

    $pages = array(
        array(
            'title'    => 'Accueil',
            'slug'     => 'accueil',
            'template' => '', // page par defaut -> front-page.php prend le relais
            'set_front' => true,
        ),
        array(
            'title'    => 'Contact',
            'slug'     => 'contact',
            'template' => 'page-contact.php',
            'set_front' => false,
        ),
    );

    foreach ( $pages as $p ) {

        // Verifie si une page avec ce slug existe deja
        $exists = get_page_by_path( $p['slug'] );
        if ( $exists ) {
            // Met a jour le template si besoin
            if ( $p['template'] && get_page_template_slug( $exists->ID ) !== $p['template'] ) {
                update_post_meta( $exists->ID, '_wp_page_template', $p['template'] );
            }
            $page_id = $exists->ID;
        } else {
            $page_id = wp_insert_post( array(
                'post_title'   => $p['title'],
                'post_name'    => $p['slug'],
                'post_status'  => 'publish',
                'post_type'    => 'page',
                'post_content' => '',
            ) );
            if ( $p['template'] && ! is_wp_error( $page_id ) ) {
                update_post_meta( $page_id, '_wp_page_template', $p['template'] );
            }
        }

        // Definit la page statique d'accueil
        if ( $p['set_front'] && ! is_wp_error( $page_id ) ) {
            update_option( 'show_on_front', 'page' );
            update_option( 'page_on_front', $page_id );
        }
    }

    update_option( 'buur_pages_created', true );
}
add_action( 'after_setup_theme', 'buur_create_essential_pages' );
