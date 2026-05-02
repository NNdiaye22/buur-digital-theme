<?php
/**
 * BUUR Digital — contact-handler.php
 * Handler AJAX pour le formulaire de contact natif.
 * L'adresse de réception est configurable via Apparence → Personnaliser → Contact.
 *
 * v1.2 : email de réception mis à jour → contact@buurdigital.com
 * v1.1 FIX : lecture de $_POST['sujet'] (was 'service') — alignement HTML réel.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/* -------------------------------------------------------
   Customizer — section Contact
------------------------------------------------------- */
add_action( 'customize_register', function ( $wp_customize ) {

    $wp_customize->add_section( 'buur_contact_section', array(
        'title'    => 'Contact',
        'panel'    => 'buur_panel',
        'priority' => 90,
    ) );

    // Email de réception
    $wp_customize->add_setting( 'buur_contact_email', array(
        'default'           => 'contact@buurdigital.com',
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'buur_contact_email', array(
        'label'       => 'Adresse email de réception',
        'description' => 'Les messages du formulaire de contact seront envoyés à cette adresse.',
        'section'     => 'buur_contact_section',
        'type'        => 'email',
    ) );

    // Objet de l'email
    $wp_customize->add_setting( 'buur_contact_subject', array(
        'default'           => '[BUUR Digital] Nouvelle demande de contact',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'buur_contact_subject', array(
        'label'   => 'Objet de l\'email reçu',
        'section' => 'buur_contact_section',
        'type'    => 'text',
    ) );

} );

/* -------------------------------------------------------
   Localisation JS — passe l'URL AJAX + nonce au script
------------------------------------------------------- */
add_action( 'wp_enqueue_scripts', function () {
    if ( ! is_page_template( 'page-contact.php' ) ) return;
    wp_localize_script( 'buur-contact-form', 'buurAjax', array(
        'url'   => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'buur_contact_nonce' ),
    ) );
}, 20 );

/* -------------------------------------------------------
   Handler AJAX (utilisateurs connectés et non connectés)
------------------------------------------------------- */
add_action( 'wp_ajax_buur_contact',        'buur_handle_contact_form' );
add_action( 'wp_ajax_nopriv_buur_contact', 'buur_handle_contact_form' );

function buur_handle_contact_form() {

    // 1. Vérification nonce
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'buur_contact_nonce' ) ) {
        wp_send_json_error( 'Requête invalide. Veuillez recharger la page et réessayer.' );
    }

    // 2. Sanitization des champs
    $nom     = isset( $_POST['nom'] )      ? sanitize_text_field( wp_unslash( $_POST['nom'] ) )      : '';
    $email   = isset( $_POST['email'] )    ? sanitize_email( wp_unslash( $_POST['email'] ) )          : '';
    $sujet   = isset( $_POST['sujet'] )    ? sanitize_text_field( wp_unslash( $_POST['sujet'] ) )    : '';
    $message = isset( $_POST['message'] )  ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

    // 3. Validation minimale
    if ( empty( $nom ) || empty( $email ) || empty( $message ) ) {
        wp_send_json_error( 'Veuillez remplir tous les champs obligatoires.' );
    }
    if ( ! is_email( $email ) ) {
        wp_send_json_error( 'Adresse e-mail invalide.' );
    }

    // 4. Construction de l'email
    $to      = get_theme_mod( 'buur_contact_email', 'contact@buurdigital.com' );
    $subject = get_theme_mod( 'buur_contact_subject', '[BUUR Digital] Nouvelle demande de contact' );

    $body  = "Nouvelle demande reçue via le formulaire de contact BUUR Digital.\n\n";
    $body .= "Nom     : {$nom}\n";
    $body .= "Email   : {$email}\n";
    if ( $sujet ) {
        $body .= "Sujet   : {$sujet}\n";
    }
    $body .= "\nMessage :\n{$message}\n";
    $body .= "\n---\nEnvoyé depuis " . get_site_url();

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'Reply-To: ' . $nom . ' <' . $email . '>',
    );

    // 5. Envoi
    $sent = wp_mail( $to, $subject, $body, $headers );

    if ( $sent ) {
        wp_send_json_success( 'Message envoyé ! On vous répond sous 48h.' );
    } else {
        wp_send_json_error( 'L\'envoi a échoué. Veuillez nous contacter directement sur WhatsApp.' );
    }
}
