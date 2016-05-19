<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Varios extends CI_Controller {
	
	public function Presentacion() {
		$data['VistaPrincipal'] = 'varios/vista_presentacion';
		$this->load->view('vista_maestra', $data);
	}
	
	public function Opcion($n) {
		$data['VistaPrincipal'] = 'varios/vista_mensaje';
		$data['Mensaje'] = "Opción $n";
		$this->load->view('vista_maestra', $data);
	}
	
	public function CambiaClave() {
		redirect('auth/change_password', 'refresh');
	}
	
	public function RecuperaClave() {
		redirect('auth/forgot_password', 'refresh');
	}
}

/* End of file Varios.php */
/* Location: ./application/controllers/Varios.php */