<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);
$texto = $_GET['term'];

$consulta = pg_query("select * from clientes where nombres_cli like '%$texto%'");
while ($row = pg_fetch_row($consulta)) {
    $data[] = array(
        'value' => $row[3],
        'label' => $row[0]
    );
}
echo $data = json_encode($data);
?>



