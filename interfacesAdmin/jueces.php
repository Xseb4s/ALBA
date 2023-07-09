<?php

session_start();
if (empty($_SESSION["Id_usuario"])) {
    header("location: ../../login/login.php");
}else if (!empty($_SESSION["Rol"] != 1)) {

    session_start();
    session_destroy();
    header("location: ../login/login.php");
};


include "../config/conexion.php";
if(!$conexion){
  die("<br/>Sin conexi&oacute;n.");
};
$sql=$conexion->query("SELECT * FROM evento ORDER BY Id_evento DESC LIMIT 0,1");
$alt=$sql->fetch_object();
/* obtenemos el numero de mesas que hay */


if(($alt->Nombre)!=""){
    $alt = $conexion->query( "SELECT Mesas FROM evento WHERE Id_evento=($alt->Id_evento)");
    $count=$alt->fetch_object();

    
}else {
    $sql=$conexion->query("SELECT * FROM evento ORDER BY Id_evento DESC LIMIT 1,1");
    $alt=$sql->fetch_object();

    $dat = $conexion->query("SELECT Mesas FROM evento WHERE Id_evento=($alt->Id_evento)");
    $count=$dat->fetch_object(); 

}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar mesas</title>
    <link rel="stylesheet" href="../css/jueces2.css">
    <link rel="icon" href="../img/Logo.png">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- llamada de iconos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- llamada de jquery -->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

    <script>

    function eliminar(){
        var respuesta=confirm("Estás a punto de limpiar una mesa. ¿Deseas eliminar?");
        return respuesta
    };
    
    </script>


</head>
<body>

    <div class="boton">
        <?php include "modales/aceptar.php";?>
        <!-- Button trigger modal -->
        <button type="button" style="background: #39A900;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#aceptarS"nname="asignar">
            Asignar Mesas
        </button>
    </div>
    <div >
    <?php include "controladoreJuzgamiento/asignar_mesa.php";?>
        <form method="POST" id="resultado">
            
                    
            
            
           
        </form>
    </div>
    <div  class="table-responsive">
    
        <div class="tabla">        
        
            
                    <!-- se muestran datos de la tabla y se hace la consulta -->
                    <?php
                    include "../config/conexion.php";
					include "controladoreJuzgamiento/eliminarJuzgamiento.php";
                    
                    $a=0;
                    while($a<$count->Mesas){
                        $a++;

                        $sql = $conexion->query("SELECT general.Id,general.fk_usuario, (SELECT Nombre FROM usuarios WHERE Id_usuario=general.fk_usuario) AS Usuario, 
                        categorias.Nombre AS Categoria, estilos.Nombre AS Estilo, cerveza.Codigo, general.Mesa
                        FROM evento_usuarios
                        INNER JOIN usuarios ON evento_usuarios.fk_usuarios=usuarios.Id_usuario
                        INNER JOIN cerveza ON cerveza.fk_usuario=usuarios.Id_usuario
                        INNER JOIN general ON general.fk_cerveza= cerveza.Id_cerveza
                        INNER JOIN estilos ON estilos.Id_estilo=cerveza.fk_estilo
                        INNER JOIN categorias ON categorias.Id_categoria=estilos.fk_categoria
                        WHERE general.Juzgado=0 AND general.Mesa=$a
                        GROUP BY general.fk_usuario");
                        
                        ?>
                        <h2>Mesa <?=$a?></h2>
                        <table>
                        <thead>
                            <tr>
                                 Jueces
                            </tr>
                            <br>
                            <tr>
                                <?php while ($alt=$sql->fetch_object()) {?>
                                    |<?=$alt->Usuario?>|
                                    <?php } ?>
                            </tr>
                            <tr>
                                <th colspan=2>Código</th>
                                <th colspan=2>Cervezas</th>
                                
                            </tr>
                        </thead>
                        <?php
                        $sql=$conexion->query("SELECT general.Id,general.fk_usuario, (SELECT Nombre FROM usuarios WHERE Id_usuario=general.fk_usuario) AS Usuario, 
                        categorias.Nombre AS Categoria, estilos.Nombre AS Estilo, cerveza.Codigo, general.Mesa
                        FROM evento_usuarios
                        INNER JOIN usuarios ON evento_usuarios.fk_usuarios=usuarios.Id_usuario
                        INNER JOIN cerveza ON cerveza.fk_usuario=usuarios.Id_usuario
                        INNER JOIN general ON general.fk_cerveza= cerveza.Id_cerveza
                        INNER JOIN estilos ON estilos.Id_estilo=cerveza.fk_estilo
                        INNER JOIN categorias ON categorias.Id_categoria=estilos.fk_categoria
                        WHERE general.Juzgado=0 AND general.Mesa=$a
                        GROUP BY categorias.Nombre");

                        while($datos=$sql->fetch_object()){
                            ?>
                                <tbody>
                                    <tr>
                                        <td colspan=2><?=$datos->Codigo?></td> 
                                        <!-- se debe colocar el nombre de los atributos de la tabla que se mostrarán en la tabla -->
                                        <!-- <td><?=$datos->Id?></td>-->
                                        <td colspan=2><?=$datos->Categoria." - ".$datos->Estilo?></td>
                                        <!-- <td><?=$datos->Usuario?></td>  -->  
                                    </tr>
                                </tbody>
                            
                            <?php

                        }
                        ?>
                        
                        </table>
                        <a onclick="return eliminar()" href="jueces.php?Mesa=<?=$a?>"><i class="bi bi-trash"></i>Eliminar todo</a>
                        <?php
                       
                    }
                    ?>

            <div class="botonRegresar">
			<a href="inicioAdmin.php"><button>Regresar</button></a>
                
            </div>

        </div>
    </div>

</body>
</html>

