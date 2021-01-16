<?php
function display_form()
{
    ob_start();
    ?>
        <!-- Contact Form Alpha -->
        <form method="POST" action="<?php get_the_permalink(); ?>" class="form-alpha">
        <?php wp_nonce_field('contact_form', 'contact_nonce') ?>
        <section class="form-mensajes">
        <div class="container">
            <div class="form-row">
                <div class="form-input-container">
                    <div class="form-input">
                        <!-- <label for="nombre">Nombre</label> -->
                        <input type="text" name="nombre" id="nombre" placeholder="Nombre" required>
                    </div>
                </div>
                <div class="form-input-container">
                    <div class="form-input">
                        <!-- <label for="apellido">Apellido</label> -->
                        <input type="text" name="apellido" id="apellido" placeholder="Apellido" required>
                    </div>
                </div>
                <div class="form-input-container">
                    <div class="form-input">
                        <!-- <label for="correo">Email</label> -->
                        <input type="email" name="correo" id="correo" placeholder="Correo" required>
                    </div>
                </div>
                <div class="form-input-container">
                <div class="form-input">
                    <!-- <label for="celular">Celular</label> -->
                    <input type="text" name="celular" placeholder="Celular" id="celular">
                </div>
                </div>
                <div class="form-input-container">
                <div class="form-input">
                    <!-- <label for="provincia">Provincia</label> -->
                    <select name="provincia" id="provincia" required>
                        <option value="" selected >-- Seleccione --</option>
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
                </div>
                <div class="form-input-container">
                <div class="form-input">
                    <!-- <label for="localidad">Localidad</label> -->
                    <input type="text" name="localidad" id="localidad" required>
                </div>
                </div>
                <div class="form-input-container">
                <div class="form-input">
                    <!-- <label for="perfil">Perfil</label> -->
                    <select name="perfil" id="perfil" required>
                        <option value="" selected>-- Seleccione --</option>
                        <option value="Operador de telecomunicaciones">Operador de telecomunicaciones</option>
                        <option value="Usuario Final">Usuario Final</option>
                    </select>
                </div>
                </div>
                <div class="form-input-container">
                    <div class="form-input">
                        <!-- <label for="sector">Sector</label> -->
                        <select name="sector" id="sector" required>
                            <option value="" selected>-- Seleccione --</option>
                            <option value="Publico">Publico</option>
                            <option value="Privado">Privado</option>
                        </select>
                    </div>
                </div>
                <div class="form-input-container">
                    <div class="form-input">
                        <!-- <label for="compania">Compania</label> -->
                        <input type="text" name="compania" id="compania" required>
                    </div>
                </div>
                <div class="form-input-container">
                    <div class="form-input">
                        <!-- <label for="servicio">Servicio en el que esta interesado/a</label> -->
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
                </div>
                <div class="form-input-container-textarea">
                    <div class="form-textarea">
                        <!-- <label for="mensaje">Mensaje</label> -->
                        <textarea name="mensaje" id="mensaje" required></textarea>
                    </div>
                </div>
                <div class="form-input-container">
                    <div class="form-input">
                        <input type="submit" value="Enviar">
                    </div>
                </div>
            </div>
            </div>
            </section>
            
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
}
