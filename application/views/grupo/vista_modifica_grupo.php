<div class='row col-sm-offset-3 col-sm-6'>
<div class='panel panel-primary'>

<div class='panel-heading'>
	<h3 class='panel-title'>Modificación de curso</h3>
</div>

<div class='panel-body'>

<?php 
echo form_open("Grupo/Modifica/$CodGrupo", array('id' => 'Formulario', 'name' => 'Formulario', 'class' => 'form-horizontal', 'role' => 'form'));
?>
	<br />
	<div class="col-sm-offset-1 col-sm-10">		
		<div class="form-group">
			<label for="Nombre" class='error'>Nombre</label>
			<?php echo form_error('Nombre'); ?>
			<input type="text" class="form-control" id="Nombre" name="Nombre" maxlength='100' value='<?php echo $Nombre?>'/>
		</div>

		<div class="form-group"> 
			<div class="col-sm-offset-5 col-sm-2">
			  <button type="submit" class="btn btn-primary">Guardar</button>
			</div>
		</div>
	</div>
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
				required: "Escriba el nombre del grupo."
			}
		}
	});
});
</script>