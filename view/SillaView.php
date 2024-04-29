<?php
include '../business/SillaBusiness.php';
$sillaBusiness2 = new SillaBusiness();
$desactivadas = $sillaBusiness2->getAllTBSillasDesactivados();
echo gethostname();
?>
<!DOCTYPE html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Silla CRUD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <style>
        h1 {
            text-align: center;
        }
    </style>
    <h1>Silla CRUD</h1>

</head>

<body>

    <form method="POST" enctype="multipart/form-Data" action="../business/SillaAction.php">
        <tr>
            <th>Serie</th>
            <td><input  type="text" name="sillaserie" id="sillaserie" placeholder="Serie" /></td>
            <th>Marca</th>
            <td><input  type="text" name="sillamarca" id="sillamarca" placeholder="Marca" /></td>
            <th>Modelo</th>
            <td><input  type="text" name="sillamodelo" id="sillamodelo" placeholder="Modelo" /></td>
            <th>Precio de Compra</th>
            <td><input  type="number" name="sillapreciocompra" id="sillapreciocompra" placeholder="Precio compra" /></td>
            <td><input type="submit" value="Insertar" name="create" id="create" /></td>
        </tr>
    </form>
    <div>
        <label>Palabra a buscar</label>
        <input onkeypress="buscar_ahora($('#buscar1').val(), 'tbsilla', 'tbsillamarca','tbsillamodelo');" onkeydown="limpiar();" onchange="limpiar();" type="text" id="buscar1" name="buscar1" placeholder="Palabra a buscar">

    </div>
    <div id="datos_buscador"></div>
    <section id="form">
        <table>
            <tr>
                <th>Serie</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Precio de Compra</th>
            </tr>

            <?php
            $sillaBusiness = new SillaBusiness();
            $sillas = $sillaBusiness->getAllTBSillas();
            foreach ($sillas as $current) {
                echo '<form method="post" onclicenctype="multipart/form-Data" action="../business/SillaAction.php">';
                echo '<input type="hidden" name="sillaid" value="' . $current->getIdsilla() . '">';
                echo '<tr>';
                echo '<td><input type="text" name="sillaserie" value="' . $current->getSerie() . '"/></td>';
                echo '<td><input type="text" name="sillamarca" value="' . $current->getMarca() . '"/></td>';
                echo '<td><input type="text" name="sillamodelo" value="' . $current->getModelo() . '"/></td>';
                echo '<td><input type="text" name="sillapreciocompra" value="' . '₡' . $current->getPrecioCompra() . '"/></td>';
                echo '<td><input type="submit" value="Actualizar" name="update" id="update"/></td>';
                echo '<td><input type="submit" value="Eliminar" name="delete" id="delete"/></td>';
                echo '</tr>';
                echo '</form>';
            }
            ?>

            <tr>
                <td><a href="../Index.php">Volver al inicio</a></td>
                <label><input type="radio" id="tablaDesactivos" value="2" name="formDesactivos" onClick="displayForm(this)"></input> Ver sillas Desactivadas</label><br>
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

    <div style="display:none" id="desactivoForm">
        <?php

        if(!empty($desactivadas)){
        ?>  

            <table>
                <tr>
                    <th>Serie</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Precio de Compra</th>
                    <th>Activo</th>
                </tr>

                <?php
                 
                echo '<h1>Sillas Desactivadas</h1>';
                foreach ($desactivadas as $current) {
                    echo '<form method="post" onclicenctype="multipart/form-Data" action="../business/SillaAction.php">';
                    echo '<input type="hidden" name="sillaid" value="' . $current->getIdsilla() . '">';
                    echo '<tr>';
                    echo '<td><input type="text" readonly="readonly" name="sillaserie" value="' . $current->getSerie() . '"/></td>';
                    echo '<td><input type="text" readonly="readonly" name="sillamarca" value="' . $current->getMarca() . '"/></td>';
                    echo '<td><input type="text" readonly="readonly" name="sillamodelo" value="' . $current->getModelo() . '"/></td>';
                    echo '<td><input type="text" readonly="readonly" name="sillapreciocompra" value="' . '₡' . $current->getPrecioCompra() . '"/></td>';
                    echo '<td><input type="checkbox" name="sillaactivo" value="' . $current->getActivo() . '"/></td>';
                    echo '<td><input type="submit" value="Actualizar" name="updateDesactivados" id="update"/></td>';
                    echo '</tr>';
                    echo '</form>';
                }
            }else{
                 echo '<h1>No hay sillas desactivadas</h1>';
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



    <footer>
    </footer>

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
</body>

</html>