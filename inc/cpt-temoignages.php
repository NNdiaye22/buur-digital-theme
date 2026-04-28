<?php
/**
 * BUUR Digital — Custom Post Type : Témoignages
 * Gère l'enregistrement du CPT, les méta-champs et la meta box.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/* ==========================================================
   1. ENREGISTREMENT DU CPT
   ========================================================== */

function buur_register_cpt_temoignage() {
    $labels = array(
        'name'               => 'Témoignages',
        'singular_name'      => 'Témoignage',
        'add_new'            => 'Ajouter un avis',
        'add_new_item'       => 'Ajouter un témoignage',
        'edit_item'          => 'Modifier le témoignage',
        'new_item'           => 'Nouveau témoignage',
        'view_item'          => 'Voir le témoignage',
        'search_items'       => 'Chercher',
        'not_found'          => 'Aucun témoignage trouvé.',
        'not_found_in_trash' => 'Aucun témoignage dans la corbeille.',
        'menu_name'          => 'Témoignages',
        'all_items'          => 'Tous les avis',
    );

    register_post_type( 'temoignage', array(
        'labels'        => $labels,
        'public'        => false,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'menu_icon'     => 'dashicons-format-quote',
        'supports'      => array( 'title' ),   // le titre = texte de l'avis
        'rewrite'       => false,
        'has_archive'   => false,
        'menu_position' => 25,
    ) );
}
add_action( 'init', 'buur_register_cpt_temoignage' );

/* ==========================================================
   2. META BOX (champs Auteur, Entreprise, Ville, Service, Note)
   ========================================================== */

function buur_temoignage_meta_box() {
    add_meta_box(
        'buur_temoignage_infos',
        'Informations sur le client',
        'buur_temoignage_meta_box_html',
        'temoignage',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'buur_temoignage_meta_box' );

function buur_temoignage_meta_box_html( $post ) {
    wp_nonce_field( 'buur_temoignage_save', 'buur_temoignage_nonce' );

    $name    = get_post_meta( $post->ID, '_temo_name',    true );
    $company = get_post_meta( $post->ID, '_temo_company', true );
    $city    = get_post_meta( $post->ID, '_temo_city',    true );
    $service = get_post_meta( $post->ID, '_temo_service', true );
    $rating  = get_post_meta( $post->ID, '_temo_rating',  true ) ?: '5';
    ?>
    <style>
      .buur-meta-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px 20px; margin-top: 8px; }
      .buur-meta-grid label { display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #1d2327; }
      .buur-meta-grid input,
      .buur-meta-grid select { width: 100%; padding: 6px 8px; border: 1px solid #c3c4c7; border-radius: 4px; font-size: 13px; }
      .buur-meta-note { margin-top: 16px; padding: 10px 14px; background: #f0f6fc; border-left: 3px solid #ea5b13; border-radius: 4px; font-size: 12px; color: #555; }
    </style>
    <div class="buur-meta-grid">
      <div>
        <label for="_temo_name">Prénom et nom *</label>
        <input type="text" id="_temo_name" name="_temo_name" value="<?php echo esc_attr( $name ); ?>" placeholder="Ex : Aminata D." required>
      </div>
      <div>
        <label for="_temo_company">Entreprise / Activité</label>
        <input type="text" id="_temo_company" name="_temo_company" value="<?php echo esc_attr( $company ); ?>" placeholder="Ex : Restaurant Le Baobab">
      </div>
      <div>
        <label for="_temo_city">Ville</label>
        <input type="text" id="_temo_city" name="_temo_city" value="<?php echo esc_attr( $city ); ?>" placeholder="Ex : Dakar">
      </div>
      <div>
        <label for="_temo_service">Service réalisé</label>
        <input type="text" id="_temo_service" name="_temo_service" value="<?php echo esc_attr( $service ); ?>" placeholder="Ex : Site Vitrine">
      </div>
      <div>
        <label for="_temo_rating">Note (1 à 5 étoiles)</label>
        <select id="_temo_rating" name="_temo_rating">
          <?php for ( $i = 5; $i >= 1; $i-- ) : ?>
          <option value="<?php echo $i; ?>" <?php selected( $rating, (string) $i ); ?>><?php echo $i; ?> ★</option>
          <?php endfor; ?>
        </select>
      </div>
    </div>
    <p class="buur-meta-note">Le <strong>titre du post</strong> (champ en haut) = le texte de l’avis visible sur le site.</p>
    <?php
}

/* ==========================================================
   3. SAUVEGARDE DES MÉTA
   ========================================================== */

function buur_temoignage_save_meta( $post_id ) {
    if ( ! isset( $_POST['buur_temoignage_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['buur_temoignage_nonce'], 'buur_temoignage_save' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $fields = array( '_temo_name', '_temo_company', '_temo_city', '_temo_service', '_temo_rating' );
    foreach ( $fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            update_post_meta( $post_id, $field, sanitize_text_field( $_POST[ $field ] ) );
        }
    }
}
add_action( 'save_post_temoignage', 'buur_temoignage_save_meta' );

/* ==========================================================
   4. COLONNES PERSONNALISÉES DANS LA LISTE ADMIN
   ========================================================== */

function buur_temoignage_columns( $cols ) {
    return array(
        'cb'            => '<input type="checkbox">',
        'title'         => 'Texte de l’avis',
        'temo_name'     => 'Client',
        'temo_company'  => 'Entreprise',
        'temo_city'     => 'Ville',
        'temo_service'  => 'Service',
        'temo_rating'   => 'Note',
        'date'          => 'Date',
    );
}
add_filter( 'manage_temoignage_posts_columns', 'buur_temoignage_columns' );

function buur_temoignage_column_content( $col, $post_id ) {
    switch ( $col ) {
        case 'temo_name':    echo esc_html( get_post_meta( $post_id, '_temo_name',    true ) ); break;
        case 'temo_company': echo esc_html( get_post_meta( $post_id, '_temo_company', true ) ); break;
        case 'temo_city':    echo esc_html( get_post_meta( $post_id, '_temo_city',    true ) ); break;
        case 'temo_service': echo esc_html( get_post_meta( $post_id, '_temo_service', true ) ); break;
        case 'temo_rating':
            $r = (int) get_post_meta( $post_id, '_temo_rating', true ) ?: 5;
            echo str_repeat( '★', $r ) . str_repeat( '☆', 5 - $r );
            break;
    }
}
add_action( 'manage_temoignage_posts_custom_column', 'buur_temoignage_column_content', 10, 2 );
