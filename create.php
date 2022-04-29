<?php
include 'controller/clienteRestCrud.php';
$cliente = new ClienteRestCrud;
if( isset($_POST['submit_data']) ){

    $nombre = $_POST['nombre'];
    $activo = $_POST['activo'];
    $bolsa = $_POST['bolsa'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];

    $cliente->add(array($nombre, $activo, $bolsa, $cantidad, $precio));

}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Crear registro</title>
</head>
<body>
<div style="width: 500px; margin: 20px auto;">

    <table width="100%" cellpadding="5" cellspacing="1" border="1">
        <form action="create.php" method="post">
            <tr>
                <td>Cartera:</td>
                <td><input name="nombre" type="text"></td>
            </tr>
            <tr>
                <td>Activo:</td>
                <td><input name="activo" type="text"></td>
            </tr>
            <tr>
                <td>Bolsa:</td>
                <td><input name="bolsa" type="text"></td>
            </tr>
            <tr>
                <td>Cantidad:</td>
                <td><input  name="cantidad" type="number"></td>
            </tr>
            <tr>
                <td>Precio:</td>
                <td><input  name="precio" type="number" step="0.01"></td>
            </tr>
            <tr>
                <td><a href="index.php">Ver datos</a></td>
                <td>
                    <input name="submit_data" type="submit" value="Insert Data">
                </td>
            </tr>
        </form>
    </table>
</div>
</body>
</html>
