<?php

// Constante
define('CFA_RUTA',plugin_dir_path(__FILE__));

// Vista del form
include(CFA_RUTA . './views/form.php');

function CFA_Pluguin_Form()
{
    global $wpdb;

    // Validando datos.
    if (!empty($_POST) 
        AND $_POST['nombre'] != ''
        AND $_POST['apellido'] != ''
        AND is_email( $_POST['correo'])
        AND $_POST['provincia'] != ''
        AND $_POST['localidad'] != ''
        AND $_POST['perfil'] != ''
        AND $_POST['servicio'] != ''
        AND $_POST['mensaje'] != '' 
    )   {
        // Indicamos la tabla.
        $tabla_mensajes = $wpdb->prefix . 'mensaje';

        // Saneando campos.
        $nombre = sanitize_text_field( $_POST['nombre'] );
        $correo = sanitize_email( $_POST['correo'] );
        $celular = sanitize_text_field( $_POST['celular'] );
        $apellido = sanitize_text_field( $_POST['apellido'] );
        $provincia = sanitize_text_field( $_POST['provincia'] );
        $localidad = sanitize_text_field( $_POST['localidad'] );
        $perfil = sanitize_text_field( $_POST['perfil'] );
        $servicio = sanitize_text_field( $_POST['servicio'] );
        $mensaje = sanitize_text_field( $_POST['mensaje'] );
        $created_at = date('Y-m-d H:i:s'); 

        // Si el perfil es operador y completo los campos sector y compania.
        if ($_POST['perfil'] == 'Operador de telecomunicaciones' 
            AND $_POST['sector'] != '' 
            AND $_POST['compania'] != ''
            ) {
            $sector = sanitize_text_field( $_POST['sector'] );
            $compania = sanitize_text_field( $_POST['compania'] );
        }

        // Insertanado los datos saneados.
        $wpdb->insert($tabla_mensajes, [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'correo' => $correo,
            'celular' => $celular ? $celular : '',
            'provincia' =>$provincia,  
            'localidad' =>$localidad, 
            'perfil' =>$perfil,  
            'sector' => $sector ? $sector : '',  
            'compania' => $compania ? $compania : '', 
            'servicio' => $servicio, 
            'mensaje' => $mensaje,
            'created_at' => $created_at,
        ]);
    }

    // Form que se insertara con el shortcode
    return display_form();
}