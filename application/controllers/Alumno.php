<?php

class Alumno extends CI_Controller {

	function __construct() {
        parent::__construct();
        //$this->form_validation->set_error_delimiters('<div class="alert alert-info">', '</div>');
    }

    function Index() {
		$this->Nuevo();
    }

    function Nuevo() {
		if (!$this->ion_auth->logged_in())	redirect('Auth/login');
        
        $this->form_validation->set_rules('Nombre', '"nombre"', 'trim');
        if ($this->form_validation->run()) {
			$this->Modelo_alumno->Insert($this->input->post('Paterno'), $this->input->post('Materno'),
										  $this->input->post('Nombres'), $this->input->post('CI'), $this->input->post('RU'));
			$data['Mensaje'] = "Se ha registrado un nuevo alumno.";                        
            $data['VistaPrincipal'] = 'varios/vista_mensaje';            
        } else
            $data['VistaPrincipal'] = 'alumno/vista_nuevo_alumno';                                                
        $this->load->view('vista_maestra', $data);
    }
    
	public function Busqueda() {
        if (!$this->ion_auth->logged_in())	redirect('Auth/login');
        
        $this->form_validation->set_rules('Nombre', '"nombre"', 'trim');
        
        if ($this->form_validation->run()) {
            $registros = $this->Modelo_alumno->Busqueda($this->input->post('Nombre'),$this->input->post('Apellido'), 
			                                             $this->input->post('CI'), $this->input->post('RU'));
            if ($registros->num_rows() == 0) {
                $data['Mensaje'] = 'No se encontraron registros que cumplan el criterio de b&uacute;squeda';
                $data['VistaPrincipal'] = 'varios/vista_mensaje';            
            } else if ($registros->num_rows() == 1) {            //solo un registro encontrado                
                $data['Fila'] = $registros->row();
                $data['VistaPrincipal'] = 'alumno/vista_modifica_alumno';
            } else {                                             // varios registros encontrados: muestra lista
                $this->load->library('table');
				$this->table->set_empty("&nbsp;");
                $this->table->set_heading('No.', 'Nombre del alumno', 'CI', 'Reg.univ.', 'Acci&oacute;n');
                $aux = array('table_open' => '<table class="table table-bordered table-condensed table-hover table-striped">');
                $this->table->set_template($aux);
                $i = 0;
                foreach ($registros->result() as $registro)
                    $this->table->add_row(++$i, $registro->Paterno.' '.$registro->Materno.' '.$registro->Nombres, $registro->CI, $registro->RU,
                            anchor("Alumno/CargaVista/" . $registro->CodAlumno, 
                                  ' Modificar ', array('class'=>'btn btn-primary btn-xs')). '  '.
                            anchor('Alumno/BorrarAlumno/' . $registro->CodAlumno, 'Eliminar', array('class'=>'btn btn-warning btn-xs',
                            'onclick'=>"return confirm('Realmente desea borrar este registro?')")));                
                $data['Tabla'] = $this->table->generate();
                $data['Vista'] = 'alumno/vista_busca_alumno';
                $data['VistaPrincipal'] = 'alumno/vista_lista_alumnos';
            }
			$this->load->view('vista_maestra', $data);
        } else {
            $data['VistaPrincipal'] = 'alumno/vista_busca_alumno';
            $this->load->view('vista_maestra', $data);
        }
    }
    
    public function Modifica() {
        if (!$this->ion_auth->logged_in())	redirect('Auth/login');
        
        $this->form_validation->set_rules('Nombre', '"nombre"', 'trim');
        if ($this->form_validation->run()) {
            $Accion = $this->input->post("submit");
            $data['VistaPrincipal'] = 'varios/vista_mensaje';   
            if ($Accion == "Guardar") {
                $this->Modelo_alumno->Update($this->input->post('CodAlumno'), $this->input->post('Paterno'), 
											$this->input->post('Materno'), $this->input->post('Nombres'), 
											$this->input->post('CI'), $this->input->post('RU'));
                $data['Mensaje'] = 'Se han modificado los datos del alumno.';                
            }
            else if ($Accion == "Borrar") {
                $this->Modelo_alumno->Delete($this->input->post('CodAlumno'));
                $data['Mensaje'] = 'Los datos del alumno han sido eliminados.';
            }
            $this->load->view('vista_maestra', $data);
        } else {
            $data['VistaPrincipal'] = 'alumno/vista_nuevo_alumno';
            $this->load->view('vista_maestra', $data);
        }
    }
	
    public function CargaVista($CodAlumno) {
        $data['Fila'] = $this->Modelo_alumno->getFila($CodAlumno);
        $data['VistaPrincipal'] = 'alumno/vista_modifica_alumno';
        $this->load->view('vista_maestra', $data);
    }

    public function BorrarAlumno($CodAlumno) {
        $this->Modelo_alumno->Delete($CodAlumno);
        redirect('Alumno','refresh');
    }

}
?>