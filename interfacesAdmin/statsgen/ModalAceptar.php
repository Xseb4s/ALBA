<!--ventana para Update--->
<div  class="modal fade" id="editChildresn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div  class="modal-dialog">
    <div  class="modal-content">
<<<<<<< HEAD
      <div style="background: rgba(65, 64, 59, 0.445);" class="modal-header">
=======
      <div style="background: rgba(119, 117, 86, 0.445);" class="modal-header">
>>>>>>> main
            <h4 class="modal-title" style="text-align: center; color:white;">
                Estadísticas por Categoría
            </h4>
      </div>
<<<<<<< HEAD
      <div style="background: rgba(65, 64, 59, 0.445);" class="modal-body">
=======
      <div style="background: rgba(119, 117, 86, 0.445);" class="modal-body">
>>>>>>> main
      
        <?php 
            while ($dataCliente = mysqli_fetch_array($queryCliente)) { ?>
            <form method="POST" action="aceptar.php">
              <input type="hidden" name="id" value="<?php echo $dataCliente['Id_categoria']; ?>">
              <div class="modal-body">
                <button type="submit" style="background: #39A900; border:yellow" class="btn btn-primary"><?php echo $dataCliente['Nombre']; ?></button>
              </div>
              </form>
          <?php } ?>
        
        <div class="modal-footer">
            <button type="button" style="background: red; border:red" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!---fin ventana Update --->
