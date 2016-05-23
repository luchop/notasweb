<div class='row col-sm-offset-2 col-sm-8'>
<div class='panel panel-primary'>

<div class='panel-heading'>
	<h3 class='panel-title'>Actividad evaluativa</h3>
</div>

<div class='panel-body'>

<?php 
echo form_open('Actividad/Actividades', array('id' => 'Formulario', 'name' => 'Formulario', 'class' => 'form-inline', 'role' => 'form'));
echo "<input type='hidden' id='CodGrupo' name='CodGrupo' value='$CodGrupo' />";
?>
	<br />
	<div class="col-sm-offset-1 col-sm-10">
        <div class="form-group">
			<?php echo form_error('Nombre'); ?>
			<input type="text" class="form-control" id="Nombre" name="Nombre" maxlength='20' placeholder='Nombre' style='width:300px;' />
		</div>
        
        <div class="form-group">
			<input type="number" class="form-control" id="MaxNota" name="MaxNota" maxlength='3' value='' placeholder='Nota máx.' style='width:120px;' />
		</div>

        <button type="submit" class="btn btn-primary">Añadir</button>
    </div>
    <div class='clearfix'></div>
    <br /><br />
	<div id="divMuestraDatos">
		<?php echo $Tabla; ?>
	</div>
	<br />
</form>

</div>
</div>
</div>
<script>

$(document).ready(function () {
	$('#Nombre').focus();

	$("#Formulario").validate({
		errorClass: 'label-warning',
		
		rules: {
			Nombre: {
				required:true
			}
		},
		messages: {
			Nombre: {
				required: "Escriba el nombre de la cuenta."
			}
		}
	});
});
</script>