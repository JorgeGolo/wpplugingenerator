<?php
/*
Plugin Name: plugin de prueba
Description: plugin de prueba desc
Version: 1.0
Author: JorgeGL
Author URI: https://mittsforcode.es
Text Domain: plugindeprueba
Domain Path: /languages
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

// Enlace directo a los ajustes
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'plugindeprueba_add_settings_link' );

function plugindeprueba_add_settings_link( $links ) {
    $settings_link = '<a href="options-general.php?page=plugindeprueba-settings">' . esc_html__( 'Settings', 'plugin de prueba' ) . '</a>';
    array_unshift( $links, $settings_link );
    return $links;
}

// carga de archivos de traducción
add_action( 'plugins_loaded', 'plugindeprueba_load_textdomain' );
function pluginname_load_textdomain() {
    load_plugin_textdomain( 'plugindeprueba', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

// Añadir un menú en el panel de administración
add_action( 'admin_menu', 'plugindeprueba_add_admin_menu' );
function plugindeprueba_add_admin_menu() {
    add_options_page(
        __( 'Plugin Settings', 'plugindeprueba' ), // Título de la página
        __( 'Plugin Name', 'plugindeprueba' ),    // Nombre del menú
        'manage_options',                     // Permiso necesario
        'plugindeprueba-settings',                // Slug único
        'plugindeprueba_settings_page'            // Función para mostrar la página
    );
}

// Página de ajustes del plugin
function plugindeprueba_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Plugin Settings', 'plugindeprueba' ); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields( 'plugindeprueba_settings_group' );
            do_settings_sections( 'plugindeprueba-settings' );
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Carga de archivos JS y CSS
add_action( 'admin_enqueue_scripts', 'plugindeprueba_enqueue_admin_scripts' );
function plugindeprueba_enqueue_admin_scripts( $hook ) {
    if ( $hook !== 'settings_page_plugindeprueba-settings' ) {
        return;
    }
    wp_enqueue_script( 'plugindeprueba-script', plugin_dir_url( __FILE__ ) . 'assets/js/script.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_style( 'plugindeprueba-style', plugin_dir_url( __FILE__ ) . 'assets/css/style.css', array(), '1.0' );
}
