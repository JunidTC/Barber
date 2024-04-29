<?php
include '../business/ClienteBusiness.php';
include '../business/ClienteCategoriaBusiness.php';

$clienteCategoriaBusiness = new ClienteCategoriaBusiness();
$clienteCategorias = $clienteCategoriaBusiness->getAllTBClienteCategoria();
$clienteCategoriaBusiness = new ClienteCategoriaBusiness();

$clienteBusiness = new ClienteBusiness();
$clientes = $clienteBusiness->getAllTBCliente();

$clienteBusiness2 = new ClienteBusiness();
$desactivos = $clienteBusiness2->getAllTBClienteDesactivado();

echo gethostname();
?>
<!DOCTYPE html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Cliente CRUD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <style>
        h1 {
            text-align: center;
        }
    </style>

    <h1>Cliente CRUD</h1>
</head>



<body>


    <form method="POST" action="../business/ClienteAction.php">
        <tr>
            <label for=""> Nombre</label>
            <td><input required type="text" name="clientenombre" id="clientenombre" onkeypress="return soloLetras(event)" placeholder="Nombre" /></td>
            <label for=""> Apellido</label>
            <td><input required type="text" name="clienteapellido" id="clienteapellido" onkeypress="return soloLetras(event)" placeholder="Apellido" /></td>
            <label for=""> Telefono</label>
            <td><input required type="number" name="clientetelefono" id="clientetelefono" placeholder="Teléfono" /></td>
            <label for=""> Email</label>
            <td><input required type="email" name="clientecorreo" id="clientecorreo" placeholder="Correo" /></td>
            <label for=""> Categoria de Cliente</label>
            <td> <select name="clienteCategorias[clienteCategoriaId]" id="categoria">
                    <option selected value=""> -- Elija una categoria -- </option>
                    <?php
                    foreach ($clienteCategorias as $clienteCategoria) { ?>

                        <option value="<?php echo $clienteCategoria->getId(); ?>">
                            <?php echo $clienteCategoria->getNombreCategoria()  ?>
                        </option>
                    <?php } ?>
                </select>
            </td>
            <td><input type="submit" value="Insertar" name="create" id="create" /></td>
        </tr>
    </form>
    <div>
        <div>
            <label>Palabra a buscar</label>
            <input onkeypress="buscar_ahora($('#buscar1').val(), 'tbcliente', 'tbclientenombre','tbclientetelefono');" onkeydown="limpiar();" onchange="limpiar();" type="text" id="buscar1" name="buscar1" placeholder="Palabra a buscar">

        </div>
        <div id="datos_buscador"></div>
    </div>
    <section id="form">
        <table>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Categoria del cliente</th>
            </tr>

            <?php

            foreach ($clientes as $current) {
                echo '<form method="post" action="../business/ClienteAction.php">';
                echo '<input type="hidden" name="clienteid" value="' . $current->getId() . '">';
                echo '<input type="hidden" name="clienteCategoriaId" value="' . $current->getClienteCategoriaId() . '">';
                echo '<tr>';
                echo '<td><input type="text" name="clientenombre" onkeypress="return soloLetras(event)"  value="' . $current->getNombre() . '"/></td>';
                echo '<td><input type="text" name="clienteapellido" onkeypress="return soloLetras(event)" value="' . $current->getApellido() . '"/></td>';
                echo '<td><input type="number" name="clientetelefono" id= "clientetelefono" value="' . $current->getNumeroTelefono() . '"/></td>';
                echo '<td><input type="email" name="clientecorreo" value="' . $current->getCorreo() . '"/></td>';
                ?>
               <td> <select name="clienteCategorias[clienteCategoriaId]" id="categoria">
               <option selected value="<?php echo $clienteCategoriaBusiness->getTBClienteCategoriaById($current->getClienteCategoriaId())->getId()?>"><?php echo $clienteCategoriaBusiness->getTBClienteCategoriaById($current->getClienteCategoriaId())->getNombreCategoria() ?></option>
                <?php foreach ($clienteCategorias as $clienteCategoria) { ?>
                        <option value="<?php echo $clienteCategoria->getId();?>">
                        <?php echo $clienteCategoria->getNombreCategoria() ?>
                        </option>
                <?php } ?>
                </select>
                </td><?
                ?>
                <?php
                echo '<td><input type="submit" value="Actualizar" name="update" id="update"/></td>';
                echo '<td><input type="submit" value="Eliminar" name="delete" id="delete"/></td>';

                echo '</tr>';
                echo '</form>';
            }
            ?>

            <tr>
                <td><a href="../Index.php">Volver al menú principal</a></td>
                <label><input type="radio" id="tablaDesactivos" value="2" name="formDesactivos" onClick="displayForm(this)"></input> Ver clientes desactivados</label><br>

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
                    <th>Apellido</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Categoria del cliente</th>
                    <th>Activo</th>
                </tr>
            <?php
            echo '<h1>Clientes desactivados</h1>';
            foreach ($desactivos as $current) {
                echo '<form method="post" action="../business/ClienteAction.php">';
                echo '<input type="hidden" name="clienteid" value="' . $current->getId() . '">';
                echo '<input type="hidden" name="clienteCategoriaId" value="' . $current->getClienteCategoriaId() . '">';
                echo '<tr>';
                echo '<td><input type="text" readonly="readonly" name="clientenombre" value="' . $current->getNombre() . '"/></td>';
                echo '<td><input type="text" readonly="readonly" name="clienteapellido" value="' . $current->getApellido() . '"/></td>';
                echo '<td><input type="number" readonly="readonly"  name="clientetelefono" value="' . $current->getNumeroTelefono() . '"/></td>';
                echo '<td><input type="text" readonly="readonly" name="clientecorreo" value="' . $current->getCorreo() . '"/></td>';
                echo '<td><input type="text"  readonly value="' . $clienteCategoria = $clienteCategoriaBusiness->getTBClienteCategoriaById($current->getClienteCategoriaId())->getNombreCategoria() . '"/></td>';
                echo '<td><input type="checkbox" name="clienteactivo" value="' . $current->getActivo() . '"/></td>';

                echo '<td><input type="submit" value="Actualizar" name="updateDesactivado" id="updateDesactivado"/></td>';


                echo '</tr>';
                echo '</form>';
            }
        } else {
            echo '<h1>No hay clientes desactivados</h1>';
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
            var resultado = confirm('¿Está seguro que desea eliminar esta categoría? (Todas las subcategorias enlazadas serán eliminadas)');
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

                    // document.getElementById("datos_buscador").innerHTML = Data;
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
        var input = document.getElementById('clientetelefono');
        input.addEventListener('input', function() {
            if (this.value.length > 8)
                this.value = this.value.slice(0, 8);
        })
    </script>
</body>

</html>