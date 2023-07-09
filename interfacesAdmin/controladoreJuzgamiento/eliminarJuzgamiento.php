<?php
if (!empty($_GET["Mesa"])) {
    $mesa=$_GET["Mesa"];
    $sql=$conexion->query("DELETE FROM general WHERE Mesa=$mesa");
    if ($sql==1) {
        echo "<div style='color: white;
        padding: 0 0 30px 0;
        text-align: center;
        color: #fff;
        font-size: 20px;'>Mesa limpiada exitosamente</div>";
        
    } else {
        echo "<div style='color: white;
        padding: 0 0 30px 0;
        text-align: center;
        color: #fff;
        font-size: 20px;'>Error en la eliminación</div>";
    }
    
}
?>