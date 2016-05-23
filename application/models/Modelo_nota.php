<?php

class Modelo_nota extends CI_Model {
    private $Tabla = 'nota';

    function __construct() {
        parent::__construct();
    }
		
	function Insert($CodGrupo, $Nombre, $MaxNota) {
        $sql = "INSERT INTO $this->Tabla (CodGrupo, Nombre, MaxNota, Activo) VALUES(?,?,?,?)";
        $this->db->query($sql, array($CodGrupo, $Nombre, $MaxNota, 'S'));

		$sql = "SELECT LAST_INSERT_ID() AS Codigo";
		$query = $this->db->query($sql);
		return $query->row()->Codigo;
    }
	
	function Update($CodActividad, $Nombre, $MaxNota) {
        $sql = "UPDATE $this->Tabla SET Nombre=?, MaxNota=? WHERE CodActividad=?";
		$this->db->query($sql, array($Nombre, $MaxNota, $CodActividad));
    }
	
	function Delete($CodActividad) {
        $sql = "DELETE FROM $this->Tabla WHERE CodActividad=$CodActividad";
		$this->db->query($sql);
    }
	
	function Tabla() {
        $sql = "SELECT * from $this->Tabla WHERE Activo='S' ORDER BY Nombre";
		return $this->db->query($sql);
    }
    
    
	function Registrados($CodActividad) {
        $sql = "SELECT COUNT(*) AS Conteo from $this->Tabla WHERE CodActividad=$CodActividad";
		return $this->db->query($sql)->row()->Conteo;
    }
    
}