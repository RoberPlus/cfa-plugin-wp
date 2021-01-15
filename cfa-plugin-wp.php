<?php
/*
Plugin Name: Contact Form Alpha
Plugin URI: https://github.com/RoberPlus/cfa-plugin-wp
Description: Pluguin para crear un formulario personalizado.
Author: Rober Cardenas
Author URI: https://github.com/RoberPlus
Version: 0.0.1
*/

// Hook al activar el plugin
register_activation_hook(__FILE__, 'CFA_Pluguin_Init' );

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

// Shortcode para la insercion del Form.
add_shortcode( 'cfa_plugin_form', 'CFA_Pluguin_Form' );

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

        // Insertado datos.
        if ($_POST['perfil'] == 'Operador de telecomunicaciones' 
            AND $_POST['sector'] != '' 
            AND $_POST['compania'] != ''
            ) {
            $sector = sanitize_text_field( $_POST['sector'] );
            $compania = sanitize_text_field( $_POST['compania'] );
        }

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
    ob_start();
    ?>
        <!-- Contact Form Alpha -->
        <form method="POST" action="<?php get_the_permalink(); ?>" class="form-alpha">
            <div class="form-input">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" required>
            </div>
            <div class="form-input">
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" id="apellido" required>
            </div>
            <div class="form-input">
                <label for="correo">Email</label>
                <input type="email" name="correo" id="correo" required>
            </div>
            <div class="form-input">
                <label for="celular">Celular</label>
                <input type="text" name="celular" id="celular">
            </div>
            <div class="form-input">
                <label for="provincia">Provincia</label>
                <select name="provincia" id="provincia" required>
                    <option value="" selected>-- Seleccione --</option>
                    <option value="Buenos Aires">Buenos Aires</option>
                    <option value="Catamarca">Catamarca</option>
                    <option value="Chaco">Chaco</option>
                    <option value="Chubut">Chubut</option>
                    <option value="Córdoba">Córdoba</option>
                    <option value="Corrientes">Corrientes</option>
                    <option value="Entre Ríos">Entre Ríos</option>
                    <option value="Formosa">Formosa</option>
                    <option value="Jujuy">Jujuy</option>
                    <option value="La Pampa">La Pampa</option>
                    <option value="La Rioja">La Rioja</option>
                    <option value="Mendoza">Mendoza</option>
                    <option value="Misiones">Misiones</option>
                    <option value="Neuquén">Neuquén</option>
                    <option value="Río Negro">Río Negro</option>
                    <option value="Salta">Salta</option>
                    <option value="San Juan">San Juan</option>
                    <option value="Santa Cruz">Santa Cruz</option>
                    <option value="Santa Fe">Santa Fe</option>
                    <option value="Santiago del Estero">Santiago del Estero</option>
                    <option value="Tierra del Fuego">Tierra del Fuego</option>
                    <option value="Tucumán">Tucumán</option> 
                </select>
            </div>
            <div class="form-input">
                <label for="localidad">Localidad</label>
                <input type="text" name="localidad" id="localidad" required>
            </div>
            <div class="form-input">
                <label for="perfil">Perfil</label>
                <select name="perfil" id="perfil" required>
                    <option value="" selected>-- Seleccione --</option>
                    <option value="Operador de telecomunicaciones">Operador de telecomunicaciones</option>
                    <option value="Usuario Final">Usuario Final</option>
                </select>
            </div>
            <div class="form-input">
                <label for="sector">Sector</label>
                <select name="sector" id="sector" required>
                    <option value="" selected>-- Seleccione --</option>
                    <option value="Publico">Publico</option>
                    <option value="Privado">Privado</option>
                </select>
            </div>
            <div class="form-input">
                <label for="compania">Compania</label>
                <input type="text" name="compania" id="compania" required>
            </div>
            <div class="form-input">
                <label for="servicio">Servicio en el que esta interesado/a</label>
                <select name="servicio" id="servicio" required>
                    <option value="" selected>-- Seleccione --</option>
                    <option value="Hosting">Hosting</option>
                    <option value="Housing">Housing</option>
                    <option value="IAAS">IAAS</option>
                    <option value="Streaming">Streaming</option>
                    <option value="Acceso a Internet">Acceso a Internet</option>
                    <option value="Lan to Lan">Lan to Lan</option>
                    <option value="Trébol">Trébol</option>
                    <option value="Transporte de alta capacidad">Transporte de alta capacidad</option>
                    <option value="IoT">IoT</option>
                    <option value="Capacidad Satelital">Capacidad Satelital</option>
                    <option value="Vsat">Vsat</option>
                    <option value="Uplink Tv">Uplink Tv</option>
                    <option value="Housing satelital">Housing satelital</option>
                    <option value="Emisiones de canales en TDT">Emisiones de canales en TDT</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>
            <div class="form-input">
                <label for="mensaje">Mensaje</label>
                <textarea name="mensaje" id="mensaje" required></textarea>
            </div>
            <div class="form-input">
                <input type="submit" value="Enviar">
            </div>
        </form>
        <!-- EndContact Form Alpha -->

        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
        <script>
            $( function() {
                $("#perfil").change( function() {
                    if ($(this).val() === "Usuario Final" || "") {
                        $("#compania").prop("disabled", true);
                        $("#sector").prop("disabled", true);
                    } else {
                        $("#compania").prop("disabled", false);
                        $("#sector").prop("disabled", false);
                    }
                });
            });
        </script>
        <!-- End Scripts -->
    <?php
    return ob_get_clean();
};

