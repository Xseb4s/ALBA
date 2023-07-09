<?php

include "config/conexion.php";

$sql=$conexion->query("SELECT * FROM evento ORDER BY Id_evento DESC LIMIT 0,1");
$dat=$sql->fetch_object();

if ($dat!=null) {
    if (($dat->Nombre)!="") {
        $hoy = date('Y-m-d');
        if (($dat->Fecha_fin)<=$hoy) {
            $sql=$conexion->query(" INSERT INTO evento (Nombre, Fecha, Fecha_fin, Lugar) VALUES ('', '', '','') ");

            if ($sql == 1) {
                
                /* echo "<div style='color: white;
                padding: 0 0 20px 0;
                text-align: center;
                color: #fff;
                font-size: 20px;'>Evento registrado</div>"; */
                echo "<script> location.reload(true);
                
                </script>";

            } else {
                
                echo "<div style='color: white;
                padding: 0 0 20px 0;
                text-align: center;
                color: #fff;
                font-size: 20px;'>Ocurrio un error</div>";

            }
            
        }
    }
}

?>