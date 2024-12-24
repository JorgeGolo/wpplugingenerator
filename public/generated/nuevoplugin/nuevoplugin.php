<?php
/*
Plugin Name: nuevo plugin
Description: descripción del plugin
Version: 1.0
Author: JorgeGL
Author URI: https://mittsforcode.es
Text Domain: nuevoplugin
Domain Path: /languages
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

// Mensaje inicial
// echo "Este es el archivo del plugin nuevo plugin";

// Enlace directo a los ajustes
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'nuevoplugin_add_settings_link' );

function nuevoplugin_add_settings_link( $links ) {
    $settings_link = '<a href="options-general.php?page=nuevoplugin-settings">' . esc_html__( 'Settings', 'nuevo plugin' ) . '</a>';
    array_unshift( $links, $settings_link );
    return $links;
}

// carga de archivos de traducción
add_action( 'plugins_loaded', 'nuevoplugin_load_textdomain' );
function pluginname_load_textdomain() {
    load_plugin_textdomain( 'nuevoplugin', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}