<?php
include 'controller/clienteSoapRentabilidad.php';
$clienteRentabilidad = new ClienteSoapRentabilidad();
$resultado = $clienteRentabilidad->obtenerRentabilidad($_POST['activo'], $_POST['precio']);
echo "La rentabilidad del activo: " . $_POST['activo'] . " en el Cliente: " . $_POST['nombre'] . " es " . $resultado['return'] . "%";
?>