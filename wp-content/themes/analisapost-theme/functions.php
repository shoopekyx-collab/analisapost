<?php
/**
 * AnalisaPost Functions & Definitions
 * Dioptimalkan untuk PHP 8.3 & WordPress 6.x
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// 1. SETUP TEMA DASAR
function analisapost_theme_setup(): void {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
    add_theme_support( 'responsive-embeds' );

    // Ukuran Gambar Editorial Modern (WebP / Responsive ready)
    add_image_size( 'editorial-hero', 800, 450, true ); // 16:9 Aspect Ratio
    add_image_size( 'editorial-grid', 600, 340, true );
    add_image_size( 'editorial-list', 320, 220, true );
    add_image_size( 'editorial-thumb', 160, 160, true );

    // Registrasi Menu Navigasi
    register_nav_menus( array(
        'primary-menu' => __( 'Menu Utama (Navbar)', 'analisapost' ),
        'top-menu'     => __( 'Menu Bar Atas (Trending/Info)', 'analisapost' ),
        'footer-menu'  => __( 'Menu Footer', 'analisapost' ),
    ) );
}
add_action( 'after_setup_theme', 'analisapost_theme_setup' );

// 2. ENQUEUE STYLES & SCRIPTS
function analisapost_enqueue_scripts(): void {
    // Google Fonts Plus Jakarta Sans
    wp_enqueue_style( 'analisapost-fonts', 'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap', array(), null );

    // Tailwind CSS via CDN (Ringan & Cepat untuk Frontend Berita)
    wp_enqueue_script( 'tailwind-cdn', 'https://cdn.tailwindcss.com', array(), null, false );

    // Main Theme Style
    wp_enqueue_style( 'analisapost-style', get_stylesheet_uri(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'analisapost_enqueue_scripts' );

// 3. CUSTOM POST TYPE: IKLAN BARIS
function analisapost_register_iklan_baris(): void {
    $labels = array(
        'name'               => 'Iklan Baris',
        'singular_name'      => 'Iklan Baris',
        'menu_name'          => 'Iklan Baris',
        'add_new'            => 'Tambah Iklan Baris',
        'add_new_item'       => 'Tambah Iklan Baris Baru',
        'edit_item'          => 'Edit Iklan Baris',
        'all_items'          => 'Semua Iklan Baris',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'menu_icon'          => 'dashicons-megaphone',
        'supports'           => array( 'title', 'editor' ),
        'show_in_rest'       => true,
    );
    register_post_type( 'iklan_baris', $args );

    // Taksonomi Kategori Iklan Baris (Properti, Lowongan, Jasa)
    register_taxonomy( 'kategori_iklan', 'iklan_baris', array(
        'hierarchical'      => true,
        'labels'            => array(
            'name'          => 'Kategori Iklan',
            'singular_name' => 'Kategori Iklan',
        ),
        'show_ui'           => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'kategori-iklan' ),
    ) );
}
add_action( 'init', 'analisapost_register_iklan_baris' );

// Meta Box untuk Iklan Baris (Harga, No WA, Lokasi)
function analisapost_iklan_meta_boxes(): void {
    add_meta_box( 'iklan_details', 'Detail Iklan Baris', 'analisapost_iklan_details_callback', 'iklan_baris', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'analisapost_iklan_meta_boxes' );

function analisapost_iklan_details_callback( \WP_Post $post ): void {
    $harga = (string) get_post_meta( $post->ID, '_iklan_harga', true );
    $whatsapp = (string) get_post_meta( $post->ID, '_iklan_wa', true );
    $lokasi = (string) get_post_meta( $post->ID, '_iklan_lokasi', true );
    wp_nonce_field( 'analisapost_save_iklan_meta', 'analisapost_iklan_nonce' );
    ?>
    <table style="width: 100%; border-spacing: 10px;">
        <tr>
            <td style="width: 150px;"><label for="iklan_harga"><strong>Harga / Tarif:</strong></label></td>
            <td><input type="text" id="iklan_harga" name="iklan_harga" value="<?php echo esc_attr( $harga ); ?>" placeholder="Contoh: Rp 1,8 M (Nego)" style="width: 100%; padding: 6px;" /></td>
        </tr>
        <tr>
            <td><label for="iklan_wa"><strong>Nomor WhatsApp:</strong></label></td>
            <td><input type="text" id="iklan_wa" name="iklan_wa" value="<?php echo esc_attr( $whatsapp ); ?>" placeholder="Contoh: 081234567890 (Gunakan awalan 08 atau 62)" style="width: 100%; padding: 6px;" /></td>
        </tr>
        <tr>
            <td><label for="iklan_lokasi"><strong>Lokasi / Wilayah:</strong></label></td>
            <td><input type="text" id="iklan_lokasi" name="iklan_lokasi" value="<?php echo esc_attr( $lokasi ); ?>" placeholder="Contoh: Surabaya Barat, Sidoarjo, dll" style="width: 100%; padding: 6px;" /></td>
        </tr>
    </table>
    <?php
}

function analisapost_save_iklan_meta( int $post_id ): void {
    if ( ! isset( $_POST['analisapost_iklan_nonce'] ) || ! wp_verify_nonce( (string) $_POST['analisapost_iklan_nonce'], 'analisapost_save_iklan_meta' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( isset( $_POST['iklan_harga'] ) ) {
        update_post_meta( $post_id, '_iklan_harga', sanitize_text_field( (string) $_POST['iklan_harga'] ) );
    }
    if ( isset( $_POST['iklan_wa'] ) ) {
        update_post_meta( $post_id, '_iklan_wa', sanitize_text_field( (string) $_POST['iklan_wa'] ) );
    }
    if ( isset( $_POST['iklan_lokasi'] ) ) {
        update_post_meta( $post_id, '_iklan_lokasi', sanitize_text_field( (string) $_POST['iklan_lokasi'] ) );
    }
}
add_action( 'save_post_iklan_baris', 'analisapost_save_iklan_meta' );

// 4. HITUNG VIEW ARTIKEL (UNTUK WIDGET TERPOPULER)
function analisapost_track_post_views( int $post_id = 0 ): void {
    if ( ! is_single() ) return;
    if ( empty( $post_id ) ) {
        $post = get_post();
        $post_id = $post ? (int) $post->ID : 0;
    }
    if ( ! $post_id ) return;

    $views = (int) get_post_meta( $post_id, 'analisapost_views', true );
    $views = ( $views <= 0 ) ? 1 : $views + 1;
    update_post_meta( $post_id, 'analisapost_views', $views );
}
add_action( 'wp_head', function(): void {
    if ( is_single() ) {
        analisapost_track_post_views( (int) get_the_ID() );
    }
});

function analisapost_get_post_views( int $post_id ): string {
    $views = (int) get_post_meta( $post_id, 'analisapost_views', true );
    return ( $views <= 0 ) ? '0' : number_format_i18n( $views );
}

// 5. ESTIMASI WAKTU MEMBACA (PHP 8.3 Null-safe)
function analisapost_reading_time(): int {
    $post_id = (int) get_the_ID();
    $content = (string) get_post_field( 'post_content', $post_id );
    if ( empty( $content ) ) {
        return 1;
    }
    $word_count = str_word_count( strip_tags( $content ) );
    $reading_time = (int) ceil( $word_count / 200 );
    return max( 1, $reading_time );
}
