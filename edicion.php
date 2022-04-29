<?php

include 'controller/clienteRestCrud.php';
$cliente = new ClienteRestCrud;

if($_POST['action'] == 'edit')
{
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $activo = $_POST['activo'];
    $bolsa = $_POST['bolsa'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];

    $arrayEdit = $cliente->update(array($nombre, $activo, $bolsa, $cantidad, $precio, $id));

    echo json_encode($_POST);
}

if($_POST['action'] == 'delete')
{
    $id = $_POST['id'];
    $cliente->delete($id);

    echo json_encode($_POST);
}

?>
