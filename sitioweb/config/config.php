<?php
define("CLIENT_ID", "AXIaN8_I3eujv_scrPyOt-aqho4mQv0NTuP5D2DIIXKpvWoUN_Kt3OdyUhkj5eEEnu8roxBPJs1f-cAw");
define("CURRENCY", "MXN");
define("KEY_TOKEN", "APR.wqc-354*");
define("MONEDA", "$");

session_start();

$num_cart = 0;
if (isset($_SESSION['carrito']['productos'])) {
    $num_cart = count($_SESSION['carrito']['productos']);
}
