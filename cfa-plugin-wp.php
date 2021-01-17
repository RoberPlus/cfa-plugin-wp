<?php
/*
Plugin Name: Contact Form Alpha
Plugin URI: https://github.com/RoberPlus/cfa-plugin-wp
Description: Pluguin para crear un formulario personalizado.
Author: Rober Cardenas
Author URI: https://github.com/RoberPlus
Version: 0.0.1
*/

// Evitando intrusos
defined('ABSPATH') or die("Bye bye");

// Constantes
define('CFA_RUTA',plugin_dir_path(__FILE__));

// Crear tabla
include(CFA_RUTA . 'includes/create-table.php');

// Verificacion, saneamiento, mostrar el form e insercion de datos
include(CFA_RUTA . 'includes/insert-data.php');

// Tabla de mensajes en menu admin
include(CFA_RUTA . 'includes/admin-menu.php');

// Hoja de estilo para el formulario
// wp_enqueue_style('css_form_alpha', plugins_url('includes/css/style.css', __FILE__));

// Hook al activar el plugin, create-table.php
register_activation_hook(__FILE__, 'CFA_Pluguin_Init' );

// Shortcode para la insercion del Form, insert-data.php
add_shortcode( 'cfa_plugin_form', 'CFA_Pluguin_Form' );

// Agregar tabla con mensajes recibos en menu, admin-menu.php
add_action( 'admin_menu', 'CFA_Mensajes_Menu');