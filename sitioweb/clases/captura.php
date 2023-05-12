<?php
require '../config/config.php';
require '../config/database.php';
$db = new Database();
$con = $db->conectar();


$json = file_get_contents('php://input');
$datos = json_decode($json, true);

if (is_array($datos)) {
    $id_transaccion = $datos['detalles']['id'];
    $monto = $datos['detalles']['purchase_units'][0]['amount']['value'];
    $status = $datos['detalles']['status'];
    $fecha = $datos['detalles']['update_time'];
    $fecha_nueva = date('Y-m-d H:i:s', strtotime($fecha));
    $email = $datos['detalles']['player']['email_address'];
    $id_cliente = $datos['detalles']['player']['player_id'];


    $sql = $con->prepare("INSERT INTO compra (id_transacion, fecha, status, email, id_cliente, total) VALUES (?
    ,?,?,?,?,?)");
}
