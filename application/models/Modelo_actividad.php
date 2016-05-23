<?php

class Modelo_actividad extends CI_Model {
    private $Tabla = 'actividad';

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

	
	function Tabla($CodGrupo) {
        $sql = "SELECT * from $this->Tabla WHERE CodGrupo=$CodGrupo AND Activo='S' ORDER BY Nombre";
		return $this->db->query($sql);
    }
    
    public function GetNombre($CodActividad){
		$sql = "SELECT Nombre FROM $this->Tabla WHERE CodActividad=$CodActividad";
		return $this->db->query($sql)->row()->Nombre;
	}
    
	public function GetMaxNota($CodActividad){
		$sql = "SELECT MaxNota FROM $this->Tabla WHERE CodActividad=$CodActividad";
		return $this->db->query($sql)->row()->MaxNota;
	}
    
    public function Cantidad($CodActividad){
		$sql = "SELECT COUNT(*) AS Conteo  FROM $this->Tabla WHERE CodActividad=$CodActividad";
		return $this->db->query($sql)->row()->MaxNota;
	}
    
	public function ExisteNombre($str){
		$sql = "select COUNT(*) AS Conteo from $this->Tabla where Activo='S' and Nombre='$str'";
		$query = $this->db->query($sql);
		return $query->row()->Conteo>0;
	}
}