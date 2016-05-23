<?php
class Actividad extends CI_Controller {
	
	function __construct(){
	    parent::__construct();
		
		$this->form_validation->set_error_delimiters('<div class="label-warning">', '</div>');
	}

	public function Index() {	   
       if (!$this->ion_auth->logged_in())	redirect('Auth/login');
        
        $data['VistaPrincipal'] = 'grupo/vista_seleccion_grupo';
        $data['Tabla'] = $this->Modelo_grupo->Tabla();
        $data['Redireccion'] = 'Actividad';
        $this->form_validation->set_rules('CodGrupo', '"grupo"', 'trim');
        if ( $this->form_validation->run() ) {
            $data['CodGrupo'] = $this->input->post('CodGrupo');
            $data['Tabla'] = $this->SeleccionActividad($data['CodGrupo']);
            $data['VistaPrincipal'] = 'actividad/vista_nueva_actividad';
        }
        $this->load->view('vista_maestra', $data);    
	}
    
    public function Actividades() {	   
       if (!$this->ion_auth->logged_in())	redirect('Auth/login');
       
        $this->form_validation->set_rules('Nombre', '"nombre"', 'trim|callback_NombreRepetido');
        $data['CodGrupo'] = $this->input->post('CodGrupo');
        $data['Tabla'] = $this->SeleccionActividad($data['CodGrupo']);
	    if ( $this->form_validation->run() ) {
			$this->Modelo_actividad->Insert($this->input->post('CodGrupo'), $this->input->post('Nombre', true), $this->input->post('MaxNota'));
			$data['Tabla'] = $this->SeleccionActividad($this->input->post('CodGrupo'));
        } 
        $data['VistaPrincipal'] = 'actividad/vista_nueva_actividad';
        $this->load->view('vista_maestra', $data);    
	}
	
	public function SeleccionActividad($CodGrupo) {
		if (!$this->ion_auth->logged_in())	redirect('Auth/login');
        
        $this->load->library('table');
		$query = $this->Modelo_actividad->Tabla($CodGrupo);
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('#', 'Nombre de la actividad',  'Nota máx.', 'Acci&oacute;n');
		$aux = array('table_open' => '<table class="table table-bordered table-striped">');
		$this->table->set_template($aux);
		$i = 0;
		foreach ($query->result() as $row) {
			$this->table->add_row(++$i, $row->Nombre, $row->MaxNota, 
					anchor("Actividad/Modifica/$row->CodActividad", ' Modificar ', array('class'=>'btn-info btn-xs')). '&nbsp;&nbsp;'.
					anchor("Actividad/Elimina/$row->CodActividad", ' Eliminar ', array('class'=>'btn-warning btn-xs',
					'onclick'=>"return confirm('Realmente desea borrar este registro?')")));                
		}
		return $this->table->generate();
	}
	
	
	public function Modifica($CodActividad) {
		if (!$this->ion_auth->logged_in())	redirect('Auth/login');
        
        $this->form_validation->set_rules('Nombre', '"nombre"', 'trim');
		$data['Nombre'] = $this->Modelo_actividad->GetNombre($CodActividad);
        $data['MaxNota'] = $this->Modelo_actividad->GetMaxNota($CodActividad);
		$data['CodActividad'] = $CodActividad;
		$data['VistaPrincipal'] = 'actividad/vista_modifica_actividad';
	    if ( $this->form_validation->run() ) {
			$this->Modelo_actividad->Update($CodActividad, $this->input->post('Nombre', true), $this->input->post('MaxNota'));
            redirect('Actividad', 'refresh');
        }   
        $this->load->view('vista_maestra', $data);
	}
	
	public function Elimina($CodActividad) {
		if (!$this->ion_auth->logged_in())	redirect('Auth/login');
        
        if($this->Modelo_nota->Registrados($CodActividad)>0) {
			$data['Mensaje'] = 'Esta actividad tiene alumnos registrados y no puede ser borrada.';
		}
		else {
			$this->Modelo_actividad->Delete($CodActividad);
			$data['Mensaje'] = 'La actividad evaluativa ha sido borrada.';
		}
		$data['VistaPrincipal'] = 'varios/vista_mensaje';
		$this->load->view('vista_maestra', $data); 
	}
	
    public function ListadoActividad() {
        if (!$this->ion_auth->logged_in())	redirect('Auth/login');
        
		$data = array();
		$data['Listado'] = $this->Modelo_actividad->findAll();
		$data['VistaPrincipal'] = 'actividad/vista_listado_actividad';
		$this->load->view('vista_maestra', $data);
	}
    
	public function EdicionCuenta($id) {
        if (!$this->ion_auth->logged_in())	redirect('Auth/login');
        
	    $this->form_validation->set_rules('Nombre', '"Nombre"', 'required|min_length[3]|xss_clean');
	    $this->form_validation->set_rules('Codigo', '"C&oacute;digo"', 'required|min_length[1]|xss_clean|callback_codigoNoRepetido');
	    $this->form_validation->set_rules('Tipo', '', 'required|xss_clean');	    
		
	    $data = array();
	    	    
	    if ($this->form_validation->run()) {
            $this->Modelo_cuenta->Update($id,$this->input->post('Codigo'), $this->input->post('Nombre'), $this->input->post('Tipo'));
            $data['Mensaje'] = 'Se han actualizado los datos de la cuenta.';
            $data['VistaPrincipal'] = 'vista_mensaje';
            $this->load->view('vista_maestra', $data);
        } else {
        	$data['Registro'] = $this->Modelo_cuenta->getById($id);	 
            $data['VistaPrincipal'] = 'vista_edicion_cuenta';
            $this->load->view('vista_maestra', $data);
        }
	}	
	
	public function BorrarCuenta($id){
		if (!$this->ion_auth->logged_in())	redirect('Auth/login');
        
        $this->Modelo_cuenta->Delete($id);
		$data['Mensaje'] = 'Se ha eliminado la cuenta.';
        $data['VistaPrincipal'] = 'vista_mensaje';
        $this->load->view('vista_maestra', $data);
	} 
	
	public function NombreRepetido($str){
		$aux = $this->Modelo_actividad->ExisteNombre($str);		
		if ($aux){	
			$this->form_validation->set_message('NombreRepetido', 'Este nombre ya se ha registrado.');
			return FALSE;
		}
		else
			return TRUE;
	}
	
	//ajax
	public function GetCuentas(){
		$Tipo = $this->input->post('Tipo');
		$Datos = $this->Modelo_cuenta->ComboCuentas2(false, true, 0, $Tipo);
		echo $Datos;
	}
}