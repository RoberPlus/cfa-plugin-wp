<?php

function CFA_Pluguin_Init()
{
    // Obtenemos variables de la db.
    global $wpdb;
    $tabla_mensajes = $wpdb->prefix . 'mensaje';
    $charset_collate = $wpdb->get_charset_collate();

    // Preparar consulta para crear la tabla
    $query = "CREATE TABLE IF NOT EXISTS $tabla_mensajes (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        nombre varchar(40) NOT NULL,
        apellido varchar (40) NOT NULL,
        correo varchar(100) NOT NULL,
        celular varchar(15),
        provincia varchar(19) NOT NULL,
        localidad varchar(40) NOT NULL,
        perfil varchar(30) NOT NULL,
        sector varchar(7),
        compania varchar(100),
        servicio varchar(28) NOT NULL,
        mensaje text NOT NULL,
        created_at datetime NOT NULL,
        UNIQUE (id)
    ) $charset_collate";

    // Ejecutando la consulta si wp esta upgrade
    include_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($query);
}
