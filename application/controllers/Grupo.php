<?php
class Grupo extends CI_Controller {
	
	function __construct(){
	    parent::__construct();
		
		$this->form_validation->set_error_delimiters('<div class="label-warning">', '</div>');
	}

	public function Index() {	   
       if (!$this->ion_auth->logged_in())	redirect('Auth/login');
        $this->form_validation->set_rules('Nombre', '"nombre"', 'trim|callback_NombreRepetido');
	    $data = array();
		$data['Tabla'] = $this->SeleccionGrupo();
	    if ( $this->form_validation->run() ) {
			$this->Modelo_grupo->Insert($this->input->post('Nombre', true));
			$data['Tabla'] = $this->SeleccionGrupo();
        } 
        $data['VistaPrincipal'] = 'grupo/vista_nuevo_grupo';
        $this->load->view('vista_maestra', $data);    
	}
	
	public function SeleccionGrupo() {
		if (!$this->ion_auth->logged_in())	redirect('Auth/login');
        
        $this->load->library('table');
		$query = $this->Modelo_grupo->Tabla();
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('#', 'Nombre del grupo',  'Acci&oacute;n');
		$aux = array('table_open' => '<table class="table table-bordered table-striped">');
		$this->table->set_template($aux);
		$i = 0;
		foreach ($query->result() as $row) {
			$this->table->add_row(++$i, $row->Nombre, 
					anchor("Grupo/Modifica/$row->CodGrupo", ' Modificar ', array('class'=>'btn-info btn-xs')). '&nbsp;&nbsp;'.
					anchor("Grupo/Elimina/$row->CodGrupo", ' Eliminar ', array('class'=>'btn-warning btn-xs',
					'onclick'=>"return confirm('Realmente desea borrar este registro?')")));                
		}
		return $this->table->generate();
	}
	
	
	public function Modifica($CodGrupo) {
		if (!$this->ion_auth->logged_in())	redirect('Auth/login');
        
        $this->form_validation->set_rules('Nombre', '"nombre"', 'trim');
	
	    $data = array();
		$data['Nombre'] = $this->Modelo_grupo->GetNombre($CodGrupo);
		$data['CodGrupo'] = $CodGrupo;
		$data['VistaPrincipal'] = 'grupo/vista_modifica_grupo';
	    if ( $this->form_validation->run() ) {
			$this->Modelo_grupo->Update($CodGrupo, $this->input->post('Nombre', true));
            redirect('Grupo', 'refresh');
        }   
        $this->load->view('vista_maestra', $data);
	}
	
	public function Elimina($CodGrupo) {
		if (!$this->ion_auth->logged_in())	redirect('Auth/login');
        
        if($this->Modelo_actividad->Cantidad($CodGrupo)>0) {
			$data['Mensaje'] = 'Este grupo tiene actividades registradas y no puede ser borrado.';
		}
        else if($this->Modelo_alumno->Cantidad($CodGrupo)>0) {
			$data['Mensaje'] = 'Este grupo tiene alumnos registrados y no puede ser borrado.';
		}
		else {
			$this->Modelo_grupo->Delete($CodGrupo);
			$data['Mensaje'] = 'El grupo ha sido borrado.';
		}
		$data['VistaPrincipal'] = 'varios/vista_mensaje';
		$this->load->view('vista_maestra', $data); 
	}
	
    public function ListadoGrupo() {
        if (!$this->ion_auth->logged_in())	redirect('Auth/login');
        
		$data = array();
		$data['Listado'] = $this->Modelo_grupo->findAll();
		$data['VistaPrincipal'] = 'grupo/vista_listado_grupo';
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
		$aux = $this->Modelo_grupo->ExisteNombre($str);		
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