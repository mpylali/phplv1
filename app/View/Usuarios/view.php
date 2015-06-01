 <?php ob_start();?>

<!-- Default box -->

<div class="box">
  <div class="box-header with-border">
    <i class="fa fa-list"></i>
    <h3 class="box-title">Datos</h3>
    <div class="box-tools pull-right">
      <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
      <!--<button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>-->
    </div>
  </div>
  <div class="box-body">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-body">
          <dl>
            <dt>Identificador</dt>
            <dd><?=$params['usuario']['id']?></dd>
            <dt>Nombre de usuario</dt>
            <dd><?=$params['usuario']['nombre_usuario']?></dd>
            <dt>Contraseña</dt>
            <dd><?=$params['usuario']['contrasena']?></dd>
            <dt>Imagen</dt>
            <dd><?php if($params['usuario']['img_mime']!=NULL)
                        {
                            echo '<img class="thumbnail" width="250px" src="data:'.$params['usuario']['img_mime'].'; base64,'.base64_encode($params['usuario']['img']).'">';
                        }else{
                            echo 'No hay foto disponible';
                        } ?></dd>
            <dt>Fecha de creación</dt>
            <dd><?=$params['usuario']['creado']?></dd>
          </dl>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- ./col -->
      
  </div><!-- /.box-body -->
  <div class="box-footer">
    <a href="<?= Config::getURL().'usuarios/' ?>" class="btn btn-primary"><i class='fa fa-arrow-left'></i>Regresar</a>
  </div><!-- /.box-footer-->
</div><!-- /.box -->
          
 

 <?php $contenido = ob_get_clean() ?>

 <?php include "\..\Layouts\\".$this->layout.".php" ?>