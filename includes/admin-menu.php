<?php

function CFA_Mensajes_Menu()
{
    add_menu_page( 'Mensajes Recibidos', 'Mensajes', 'manage_options', 'cfa_mensajes_menu', 'CFA_Mensajes_Admin', 'dashicons-feedback', 75 );
}

function CFA_Mensajes_Admin()
{
    global $wpdb;
    $tabla_mensajes = $wpdb->prefix . 'mensaje';
    $mensajes = $wpdb->get_results("SELECT * FROM $tabla_mensajes");
    ob_start();
    ?>
    <div class="wrap"><h1>Lista de mensajes</h1>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Celular</th>
                    <th>Provincia</th
                    ><th>Localidad</th>
                    <th>Perfil</th>
                    <th>Sector</th>
                    <th>Compania</th>
                    <th>Servicio</th>
                    <th>Mensaje</th>
                    <th>Recibido</th>
                </tr>
            </thead>
            <tbody id="the-list">
            <?php  
                foreach ($mensajes as $mensaje) {
                    $nombre = esc_textarea($mensaje->nombre);
                    $apellido = esc_textarea($mensaje->apellido);
                    $correo = esc_textarea($mensaje->correo);
                    $celular = esc_textarea($mensaje->celular);
                    $provincia = esc_textarea($mensaje->provincia);
                    $localidad = esc_textarea($mensaje->localidad);
                    $perfil = esc_textarea($mensaje->perfil);
                    $sector = esc_textarea($mensaje->sector);
                    $compania = esc_textarea($mensaje->compania);
                    $servicio = esc_textarea($mensaje->servicio);
                    $msj = esc_textarea($mensaje->mensaje);
                    $recibido = esc_textarea($mensaje->created_at);

                    echo "<tr><td>$mensaje->nombre</td>";
                    echo "<td>$mensaje->apellido</td>";
                    echo "<td>$mensaje->correo</td>";
                    echo "<td>$mensaje->celular</td>";
                    echo "<td>$mensaje->provincia</td>";
                    echo "<td>$mensaje->localidad</td>";
                    echo "<td>$mensaje->perfil</td>";
                    echo "<td>$mensaje->sector</td>";
                    echo "<td>$mensaje->compania</td>";
                    echo "<td>$mensaje->servicio</td>";
                    echo "<td>$mensaje->mensaje</td>";
                    echo "<td>$mensaje->created_at</td></tr>";
                }
            ?>
        </tbody></table></div>
    <?php
    echo ob_get_clean();
}