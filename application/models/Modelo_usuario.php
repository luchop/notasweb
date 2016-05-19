<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modelo_usuario extends CI_Model {
	public function Grupos() {
		$sql = "select * from groups";
		return $this->db->query($sql);
	}
}