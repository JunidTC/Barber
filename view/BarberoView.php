<?php
include '../business/BarberoBusiness.php';

$barberoBusiness = new BarberoBusiness();
$barbero = $barberoBusiness->getAllTBBarbero();
$desactivos = $barberoBusiness->getAllTBBarberoDesactivado();

echo gethostname();
?>
<!DOCTYPE html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Barbero CRUD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <style>
        h1 {
            text-align: center;
        }
    </style>

    <h1>Barbero CRUD</h1>
</head>



<body>


    <form method="POST" enctype="multipart/form-Data" action="../business/BarberoAction.php">
        <tr>
            <label for=""> Nombre</label>
            <td><input required type="text" name="barberonombre" id="barberonombre" onkeypress="return soloLetras(event)" placeholder="Nombre completo" /></td>
            <label for=""> Telefono</label>
            <td><input required type="number" name="barberotelefono" id="barberotelefono" placeholder="Teléfono" /></td>
            <label for=""> Email</label>
            <td><input required type="email" name="barberocorreo" id="barberocorreo" placeholder="Correo" /></td>
            <td><input type="submit" value="Insertar" name="create" id="create" /></td>
        </tr>
    </form>
    <div>
        <div>
            <label>Palabra a buscar</label>
            <input onkeypress="buscar_ahora($('#buscar1').val(), 'tbbarbero', 'tbbarberonombre','tbbarberotelefono');" onkeydown="limpiar();" onchange="limpiar();" type="text" id="buscar1" name="buscar1" placeholder="Palabra a buscar">

        </div>
        <div id="datos_buscador"></div>
    </div>
    <section id="form">
        <table>
            <tr>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Correo</th>
                
            </tr>

            <?php

            foreach ($barbero as $current) {
                echo '<form method="post" onclicenctype="multipart/form-Data" action="../business/BarberoAction.php">';
                echo '<input type="hidden" name="barberoid" value="' . $current->getbarberoId() . '">';
                echo '<tr>';
                echo '<td><input type="text" name="barberonombre" onkeypress="return soloLetras(event)"  value="' . $current->getNombre() . '"/></td>';
                echo '<td><input type="number" name="barberotelefono" id= "barberotelefono" value="' . $current->getTelefono() . '"/></td>';
                echo '<td><input type="text" name="barberocorreo" value="' . $current->getEmail() . '"/></td>';
                echo '<td><input type="submit" value="Actualizar" name="update" id="update"/></td>';
                echo '<td><input type="submit" value="Eliminar" name="delete" id="delete"/></td>';
                echo '</tr>';
                echo '</form>';
            }
            ?>

            <tr>
                <td><a href="../Index.php">Volver al menú principal</a></td>
                <label><input type="radio" id="tablaDesactivos" value="2" name="formDesactivos" onClick="displayForm(this)"></input> Ver Provedores desactivados</label><br>

            </tr>
        </table>
        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyField") {
                echo '<p style="color: red">Campo(s) vacio(s)</p>';
            } else if ($_GET['error'] == "dbError") {
                echo '<center><p style="color: red">Error en el formato de datos que digitó para guardar en la base de datos</p></center>';
            }
        } else if (isset($_GET['success'])) {
            echo '<p style="color: green">Transacción realizada</p>';
            echo '<br>';
        }
        ?>
    </section>
    <script type="text/javascript">
        function displayForm(c) {
            if (c.value == "2") {
                jQuery('#desactivoForm').toggle('show');
            }
            if (c.value == "1") {
                jQuery('#desactivoForm').hidden();
            }
        }
    </script>

    <div style="display:none" id="desactivoForm">


        <?php

        if (!empty($desactivos)) {
        ?>
            <table>
                <tr>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Activo</th>

                </tr>
            <?php
            echo '<h1>Barberos desactivados</h1>';
            foreach ($desactivos as $current) {
                echo '<form method="post" onclicenctype="multipart/form-Data" action="../business/BarberoAction.php">';
                echo '<input type="hidden" name="barberoid" value="' . $current->getBarberoId() . '">';
                echo '<tr>';
                echo '<td><input type="text" readonly="readonly" name="barberonombre" value="' . $current->getNombre() . '"/></td>';
                echo '<td><input type="number" readonly="readonly"  name="barberotelefono" value="' . $current->getTelefono() . '"/></td>';
                echo '<td><input type="text" readonly="readonly" name="barberocorreo" value="' . $current->getEmail() . '"/></td>';
                echo '<td><input type="checkbox" name="barberoactivo" value="' . $current->getActivo() . '"/></td>';

                echo '<td><input type="submit" value="Actualizar" name="updateDesactivado" id="updateDesactivado"/></td>';


                echo '</tr>';
                echo '</form>';
            }
        } else {
            echo '<h1>No hay Barberos desactivados</h1>';
        }

            ?>

            <tr>
                <td>
                    <?php
                    if (isset($_GET['error'])) {
                        if ($_GET['error'] == "emptyField") {
                            echo '<p style="color: red">Campo(s) vacio(s)</p>';
                        } else if ($_GET['error'] == "dbError") {
                            echo '<center><p style="color: red">Error al procesar la transacción</p></center>';
                        }
                    } else if (isset($_GET['success'])) {
                        echo '<p style="color: green">Transacción realizada</p>';
                        echo '<br>';
                    }
                    ?>
                </td>
            </tr>
            </table>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).on('click', '#delete', function() {
            var resultado = confirm('¿Está seguro que desea eliminar esta Proveedor?');
            if (!resultado) {
                return false;
            }
        });
    </script>

    <script type="text/javascript">
        function limpiar() {
            $("#datos_buscador").empty();
        }

        function buscar_ahora(dato, tb, col1, col2) {

            $.ajax({
                data: 'buscar=' + dato + "&tabla=" + tb + "&column1=" + col1 + "&column2=" + col2,
                type: "POST",
                url: "../business/FiltroAction.php",
                success: function(data) {

                    $("#datos_buscador").empty().append(data);

                    
                }
            });
        }
    </script>

    <script>
        // script para obtener solo letras de un input 

        function soloLetras(e) {
            key = e.keyCode || e.which;
            tecla = String.fromCharCode(key).toLowerCase();
            letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
            especiales = "8-37-39-46";

            tecla_especial = false
            for (var i in especiales) {
                if (key == especiales[i]) {
                    tecla_especial = true;
                    break;
                }
            }

            if (letras.indexOf(tecla) == -1 && !tecla_especial) {
                return false;
            }
        }
    </script>


    <script>
        var input = document.getElementById('barberotelefono');
        input.addEventListener('input', function() {
            if (this.value.length > 8)
                this.value = this.value.slice(0, 8);
        })
    </script>
</body>

</html>