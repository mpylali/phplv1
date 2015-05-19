 <?php ob_start();?>

<!-- Default box -->
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Lista de usuarios</h3>
    <div class="box-tools pull-right">
      <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
      <!--<button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>-->
    </div>
  </div>
  <div class="box-body">
      <div class="col-lg-4">
      <table class="table table-bordered">
          <thead>
              <th>Identificador</th>
              <th>Usuario</th>
              <th>Contraseña</th>
          </thead>
          <tbody>
            <?php foreach ($params['usuarios'] as $usuario):?>
                <tr>
                    <td><?= $usuario['id']?></td>
                    <td><?= $usuario['nombre_usuario']?></td>
                    <td><?= $usuario['contrasena']?></td>
                </tr>
            <?php endforeach;?>
          </tbody>
      </table>
      </div>
      
  </div><!-- /.box-body -->
  <div class="box-footer">
    
  </div><!-- /.box-footer-->
</div><!-- /.box -->
          
 

 <?php $contenido = ob_get_clean() ?>

 <?php include "\..\Layouts\\".$this->layout.".php" ?>