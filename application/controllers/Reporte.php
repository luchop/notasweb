<?php

class Reporte extends CI_Controller {
	function __construct() {
        parent::__construct();
		$this->load->model('Modelo_usuario');
    }

	public function EjemploPDF(){
		$data['Grupos'] = $this->Modelo_usuario->Grupos();
		$this->output->set_header('Content:application/pdf');
		$this->load->view('impresion/vista_grupos_pdf', $data);
	}
}
?>