<?php

include 'controller/clienteRestCrud.php';
$cliente = new ClienteRestCrud;

$arrayEdit = $cliente->listar();
$rows = array();
foreach($arrayEdit as $row) {
    $rows[] = $row;
    $sub_array = array();
    $sub_array[] = $row->id;
    $sub_array[] = $row->nombre;
    $sub_array[] = $row->activo;
    $sub_array[] = $row->bolsa;
    $sub_array[] = $row->cantidad;
    $sub_array[] = $row->precio;
    $data[] = $sub_array;
}

$output = array(
    'draw' => intval($_POST['draw']),
    'recordsTotal' => count($data, COUNT_NORMAL),
    'recordsFiltered' => count($data, COUNT_NORMAL),
    'data' => $data
);

echo json_encode($output);

?>
