<div class='row col-md-offset-4 col-md-4'>
<div class='panel panel-primary'>

<div class='panel-heading'>
	<h3 class='panel-title'>Búsqueda de alumno</h3>
</div>

<div class='panel-body'>
	<?php 
	echo form_open("Alumno/Busqueda",  array('id' => 'Alumno', 'name' => 'Alumno'));
	?>
	<div class="form-group">
		<input class='form-control' type='text' name='Nombre' id='Nombre' maxlength='25' placeholder='Nombre' />
	</div>
	
	<div class="form-group">
		<input class='form-control' type='text' name='Apellido' id='Apellido' maxlength='20' placeholder='Apellido' />
	</div>
		
	<div class="form-group">
		<input class='form-control' type='text' name='CI' id='CI' maxlength='10' placeholder='CI' />
	</div>

	<div class="form-group">
		<input class='form-control' type='text' name='RU' id='RU' maxlength='10' placeholder='Reg.univ' />
	</div>
	
	<div class="text-center">
		<input type='submit' class='btn-primary' value='Buscar' />
	</div>
		
	</form>
</div>
</div>
</div>


<script type="text/javascript">
$(document).ready(function() {
	$("#Nombre").focus();

	$("#Alumno").validate({        
		errorClass:'bg-danger',
		rules: {
            Nombre: {
                minlength: 3
            },
            Apellido: {
                minlength: 3
            }
        },
        messages: {
            Nombre: {
                minlength: "Debe registrar 3 caracteres o más."
            },
            Apellido: {
                minlength: "Debe registrar 3 caracteres o más."
            }
        }
    });
});
</script>
