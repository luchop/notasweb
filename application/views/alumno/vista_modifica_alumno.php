<div class='row col-md-offset-3 col-md-6'>
<div class='panel panel-primary'>

<div class='panel-heading'>
	<h3 class='panel-title'>Modificación de datos de alumno</h3>
</div>

<div class='panel-body'>

<?php 
echo form_open('Alumno/Modifica',  array('id' => 'Alumno', 'name' => 'Alumno', 'class' => 'form-horizontal', 'role' => 'form'));
echo "<input type='hidden' name='CodAlumno' id='CodAlumno' value='$Fila->CodAlumno' />";
?>

	<div class="col-md-offset-1 col-md-10">
		<input class='form-control' type='text' name='Paterno' id='Paterno' maxlength='20' value='<?php echo $Fila->Paterno; ?>' placeholder='Apellido paterno' />
		<input class='form-control' type='text' name='Materno' id='Materno' maxlength='20' value='<?php echo $Fila->Materno; ?>' placeholder='Apellido paterno' />
        <input class='form-control' type='text' name='Nombres' id='Nombres' maxlength='25' value='<?php echo $Fila->Nombres; ?>' placeholder='Nombres' />
        <input class='form-control' type='text' name='CI' id='CI' maxlength='10' value='<?php echo $Fila->CI; ?>' placeholder='C.I.' />
        <input class='form-control' type='text' name='RU' id='RU' maxlength='10' value='<?php echo $Fila->RU; ?>' placeholder='Reg.univ.'  />
    </div>
	<div class='clearfix'></div>
	<br />
	<div class="row text-center">
		<input type='submit' class='btn btn-primary' name='submit' value='Guardar' />
		<input type='submit' class='btn btn-warning' id='Borrar' name='submit' value='Borrar' />
	</div>
 
</form>
</div>
</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	$("#Alumno").validate({
		errorClass:'bg-danger',
		onkeyup: false,
		rules: {
            Nombres: {
                required: true
            }
        },
        messages: {
            Nombres: {
                required: "Debe registrar el nombre del alumno."
            }
        }
    });
    
    $("#Borrar").click(function(e) {
        return confirm('Realmente desea borrar este registro?')
    });
});
</script>
