<?php
include '../business/ClienteCategoriaBusiness.php';

include '../business/ClienteTipoBusiness.php';

$clienteTipoBusiness = new ClienteTipoBusiness();
$clienteTipos = $clienteTipoBusiness->getAllTBClienteTipo();
$clienteCategoriaBusiness2 = new ClienteCategoriaBusiness();
$desactivada = $clienteCategoriaBusiness2->getAllTBClienteCategoriaDesactivado();

echo gethostname();

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Cliente Categoría CRUD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <style>
        h1 {
            text-align: center;
        }
    </style>
    <h1>Cliente Categoría CRUD</h1>

</head>

<body>

    <form method="POST" action="../business/ClienteCategoriaAction.php">
            
        <tr>
            <th>Nombre categoría</th>
            <td><input  type="text" name="clientecategorianombre" id="clientecategorianombre" onkeypress="return soloLetras(event)" placeholder="Nombre categoria" /></td>
            <th>Descripción</th>
            <td><textarea  name="clientecategoriadescripcion" id="clientecategoriadescripcion" placeholder="Escribe una descripción"></textarea></td>
            <th>Puntaje Categoria</th> 
            <td><select name="clienteTipos[clienteTipoId]" id="tipo">
                    <option selected value=""> -- Elija un puntaje -- </option>
                    <?php
                    foreach ($clienteTipos as $clienteTipo) { ?>
                        <option value="<?php echo $clienteTipo->getClienteTipoId(); ?>">
                            <?php echo $clienteTipo->getPuntaje()  ?>
                        </option>
                    <?php } ?>
                </select>
            </td>

            <td><input type="submit" value="Insertar" name="create" id="create" /></td>
        </tr>
    </form>
    <div>
        <label>Palabra a buscar</label>
        <input onkeypress="buscar_ahora($('#buscar1').val(), 'tbclientecategoria', 'tbclientecategoriadescripcion','tbclientecategorianombre');" onkeydown="limpiar();" onchange="limpiar();" type="text" id="buscar1" name="buscar1" placeholder="Palabra a buscar">
    </div>
    <div id="datos_buscador"></div>

    <section id="form">
        <table>
            <tr>
                <th>Descripción</th>
                <th>Nombre categoría</th>
                <th>Puntaje Categoria</th> 
            </tr>

            <?php
            $clienteCategoriaBusiness = new ClienteCategoriaBusiness();
            $clientesCategoria = $clienteCategoriaBusiness->getAllTBClienteCategoria();
            foreach ($clientesCategoria as $current) {
                echo '<form method="post" action="../business/ClienteCategoriaAction.php">';
                echo '<input type="hidden" name="clientecategoriaid" value="' . $current->getId() . '">';
                echo '<tr>';
                echo '<td><input type="text" name="clientecategoriadescripcion" value="' . $current->getDescripcion() . '"/></td>';
                echo '<td><input type="text" name="clientecategorianombre" value="' . $current->getNombreCategoria() . '"/></td>';
                echo '<td><input type="text" readonly value="' . $clientePuntos= $clienteTipoBusiness->getTBTipoClienteById($current->getClienteTipoId())->getPuntaje() . '"/></td>';
                echo '<td><input type="hidden" name="clientecategoriatipoid" value="' . $current->getClienteTipoId() . '"/></td>';
                echo '<td><input type="submit" value="Actualizar" name="update" id="update"/></td>';
                echo '<td><input type="submit" value="Eliminar" name="delete" id="delete"/></td>';
                echo '</tr>';
                echo '</form>';
            }
            ?>

            <tr>
                <td><a href="../Index.php">Volver al menu principal</a></td>
                <label><input type="radio" id="tablaDesactivos" value="2" name="formDesactivos" onClick="displayForm(this)"></input> Ver categorias desactivadas</label><br>
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
    </section>
    
    <div style="display:none" id="desactivoForm">
        <?php
            if(!empty($desactivada)){
        ?> 
        <table>
            <tr>
                <th>Descripción</th>
                <th>Nombre categoría</th>
                <th>Puntaje Categoria</th> 
                <th>Activo</th>
            </tr>

            <?php
                echo '<h1>Categorias desactivadas</h1>';
                foreach ($desactivada as $current) {
                    echo '<form method="post" onclicenctype="multipart/form-Data" action="../business/ClienteCategoriaAction.php">';
                    echo '<input type="hidden" name="clientecategoriaid" value="' . $current->getId() . '">';
                    echo '<tr>';
                    echo '<td><input type="text" readonly="readonly" name="clientecategoriadescripcion" value="' . $current->getDescripcion() . '"/></td>';
                    echo '<td><input type="text" readonly="readonly" name="clientecategorianombre" value="' . $current->getNombreCategoria() . '"/></td>';
                    echo '<td><input type="text" readonly value="' . $clientePuntos= $clienteTipoBusiness->getTBTipoClienteById($current->getClienteTipoId())->getPuntaje() . '"/></td>';
                    echo '<td><input type="hidden" name="clientecategoriatipoid" value="' . $current->getClienteTipoId() . '"/></td>';
                    echo '<td><input type="checkbox" name="clientecategoriaactivo" value="' . $current->getActivo() . '"/></td>';
                    echo '<td><input type="submit" value="Actualizar" name="updateDesactivado" id="updateDesactivado"/></td>';
                    echo '</tr>';
                    echo '</form>';
                }
            }else{
                echo '<h1>No hay categorias desactivadas</h1>';
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

    <script type="text/javascript">
        function displayForm(c){
            if(c.value == "2"){
               jQuery('#desactivoForm').toggle('show');
            }
            if(c.value == "1"){
                jQuery('#desactivoForm').hidden();
            }
        }
    </script>

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
</body>

</html>