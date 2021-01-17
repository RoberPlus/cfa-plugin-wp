<?php
// Aseguramos que wordpress esta ejecutando la accion.
if (!defined('WP_UNINSTALL_PLUGIN')) exit;

// Definir table y eliminarla.
global $wpdb;
$table_name = $wpdb->prefix .'mensaje';
$wpdb->query("DROP TABLE IF EXISTS {$table_name}");