<div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>¡Informaci&oacute;n!</strong> &nbsp;&nbsp;&nbsp;<?php echo $Mensaje; ?>
</div>

<?php 
if( isset($BotonRegresar) )
	echo "
	<div class='col-sm-offset-4 col-sm-4 text-center'>
      <a class='btn btn-default text-center' href='".site_url("$BotonRegresar")."'>Regresar</a>
    </div>";

if( isset($Redireccion) )
   redirect($Redireccion, 'refresh');   
?>