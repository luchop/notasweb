<div class='row col-md-offset-3 col-md-6'>
<div class='panel panel-primary'>

<div class='panel-heading'>
	<h3 class='panel-title'>Nuevo alumno</h3>
</div>

<div class='panel-body'>

<?php 
echo form_open('Alumno/Nuevo',  array('id' => 'Nuevo', 'name' => 'Nuevo', 'class' => 'form-horizontal', 'role' => 'form'));
?>
    <div class='col-md-offset-1 col-md-10'>
        <input class='form-control' type='text' name='Paterno' id='Paterno' maxlength='20' value='<?php echo set_value('Paterno'); ?>' placeholder='Apellido paterno' />
        <input class='form-control' type='text' name='Materno' id='Materno' maxlength='20' value='<?php echo set_value('Materno'); ?>' placeholder='Apellido materno' />
        <input class='form-control' type='text' name='Nombres' id='Nombres' maxlength='25' value='<?php echo set_value('Nombres'); ?>' placeholder='Nombres' />
        <input class='form-control' type='text' name='CI' id='CI' maxlength='10' value='<?php echo set_value('CI'); ?>' placeholder='C.I.' />
        <input class='form-control col-md-3' type='text' name='RU' id='RU' maxlength='10' value='<?php echo set_value('RU'); ?>' placeholder='Reg.univ.'  />
    </div>
	<div class='clearfix'></div>
    <br />
	<div class="text-center">
        <input type='submit' class='btn-primary' value='Guardar' />
	</div>
</form>
</div>
</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	$("#Nuevo").validate({
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
});
</script>