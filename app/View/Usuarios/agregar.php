<?php ob_start(); 
echo $params['mensaje'];?>

<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Formulario</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            <!--<button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>-->
        </div>
    </div>
    <!-- form start -->
    <form name="agregarUsuario" role="form" method="POST" action="agregar">
        <div class="box-body">
            <div class="form-group">
                <label for="usuario">Usuario</label>
                <input name="usuario" type="text" class="form-control" id="usuario" placeholder="Ingresa usuario">
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña</label>
                <input name="contrasena" type="password" class="form-control" id="contrasena" placeholder="Contraseña">
            </div>
        </div><!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </form>
</div><!-- /.box -->



<?php $contenido = ob_get_clean() ?>

<?php include "\..\Layouts\\" . $this->layout . ".php" ?>
