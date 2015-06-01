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
      <table class="table table-bordered">
         
              
          
          <tbody>
              <td>Identificador</td>
              <td>Usuario</td>
              <td>Creado</td>
              <td>Acciones</td>
            <?php foreach ($params['usuarios'] as $usuario):?>
                <tr>
                    <td><?= $usuario['id']?></td>
                    <td><?= $usuario['nombre_usuario']?></td>
                    <td><?= $usuario['creado']?></td>
                    <td>
                        <div>
                        <a href="<?= Config::getURL().'usuarios/view/'.$usuario['id'] ?>" class="btn btn-info"><i class='fa fa-search'></i>Ver</a>
                        <a href="<?= Config::getURL().'usuarios/edit/'.$usuario['id'] ?>" class="btn btn-warning"><i class='fa fa-pencil'></i>Editar</a>
                        <a href="<?= Config::getURL().'usuarios/delete/'.$usuario['id'] ?>" class="btn btn-danger"><i class='fa fa-times-circle'></i>Borrar</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach;?>
          </tbody>
      </table>
      
  </div><!-- /.box-body -->
  <div class="box-footer">
    
  </div><!-- /.box-footer-->
</div><!-- /.box -->
          
 

 <?php $contenido = ob_get_clean() ?>

 <?php include "\..\Layouts\\".$this->layout.".php" ?>