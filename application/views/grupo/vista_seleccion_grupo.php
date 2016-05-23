<div class='row col-md-offset-4 col-md-4'>
<div class='panel panel-primary'>

<div class='panel-heading'>
	<h3 class='panel-title'>Selección de grupo</h3>
</div>

<div class='panel-body'>
<?php 
echo form_open($Redireccion,  array('id' => 'Formulario', 'name' => 'Formulario', 'class' => 'form-horizontal', 'role' => 'form'));
?>
	<?php 
        $s = "<select class='form-control' id='CodGrupo' name='CodGrupo'>";
        foreach($Tabla->result() as $fila) 
            $s .= "<option value='$fila->CodGrupo'>$fila->Nombre</option>";
        $s .= "</select>";
        
        echo $s;
    ?>
    <br />
    <div class="text-center">
        <input type='submit' class='btn-primary' value='Continuar' />
	</div>
</form>
</div>
</div>
</div>