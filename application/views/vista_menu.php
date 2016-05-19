<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
		<span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
		<li class="active"><a href="<?php echo site_url('Varios/Presentacion')?>">Inicio</a></li>
		
		<li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Notas <span class="caret"></span></a>
		  <ul class="dropdown-menu" role="menu">
			<li><a href="<?php echo site_url('Notas/Individual'); ?>">Registro individual </a></li>
			<li><a href="<?php echo site_url('Notas/Planilla'); ?>">Planilla de notas </a></li>
		  </ul>
		</li>
        
        <li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Alumnos <span class="caret"></span></a>
		  <ul class="dropdown-menu" role="menu">
			<li><a href="<?php echo site_url('Alumno/Nuevo'); ?>">Nuevo alumno </a></li>
			<li><a href="<?php echo site_url('Alumno/Busqueda'); ?>">Modificación datos alumno </a></li>
		  </ul>
		</li>
		
        <li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Grupos/paralelos/materias <span class="caret"></span></a>
		  <ul class="dropdown-menu" role="menu">
			<li><a href="<?php echo site_url('Grupo/Nuevo'); ?>">Nuevo alumno </a></li>
			<li><a href="<?php echo site_url('Grupo/Modificacion'); ?>">Modificación datos grupo </a></li>
		  </ul>
		</li>
		
        <li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Reportes <span class="caret"></span></a>
		  <ul class="dropdown-menu" role="menu">
			<li><a href="<?php echo site_url('Reporte/RegistroPDF'); ?>">Registro de notas (PDF) </a></li>
            <li><a href="<?php echo site_url('Reporte/RegistroXLS'); ?>">Registro de notas (Excel) </a></li>
            <li><a href="<?php echo site_url('Varios/ConfiguracionReporte'); ?>">Configuración del registro de notas </a></li>
		  </ul>
		</li>
        
        <li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Configuración <span class="caret"></span></a>
		  <ul class="dropdown-menu" role="menu">
			<li><a href="<?php echo site_url('Varios/CambiaClave'); ?>">Cambia contraseña </a></li>
            <li><a href="<?php echo site_url('Varios/ImportacionXLS'); ?>">Importación de nombres (Excel) </a></li>
            <li><a href="<?php echo site_url('Varios/ConfiguracionNotas'); ?>">Configuración de notas </a></li>
		  </ul>
		</li>
				
		<li><a href="<?php echo site_url('auth/logout'); ?>">Salir</a></li>
      </ul>
    </div>
  </div>
</nav>