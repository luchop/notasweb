<?php

class Modelo_grupo extends CI_Model {
    private $Tabla = 'grupo';

    function __construct() {
        parent::__construct();
    }
		
	function Insert($Nombre) {
        $sql = "INSERT INTO $this->Tabla (Nombre, Activo) VALUES(?, ?)";
		$this->db->query($sql, array($Nombre, 'S'));
		
		$sql = "SELECT LAST_INSERT_ID() AS Codigo";
		$query = $this->db->query($sql);
		return $query->row()->Codigo;
    }
	
	function Update($CodGrupo, $Nombre) {
        $sql = "UPDATE $this->Tabla SET Nombre=? WHERE CodGrupo=?";
		$this->db->query($sql, array($Nombre, $CodGrupo));
    }
	
	function Delete($CodGrupo) {
        $sql = "DELETE FROM $this->Tabla WHERE CodGrupo=$CodGrupo";
		$this->db->query($sql);
    }
	
	function GetDatos($CodCuenta, &$Codigo, &$Nombre, &$Grupo, &$Nivel, &$CodMayor, &$Subcuentas) {
        $sql = "SELECT FROM $this->Tabla WHERE CodCuenta=$CodCuenta";
		$resultado = $this->db->query($sql);
		if( $resultado.num_row()>0 ) {
			$r = $resultado->row();
			$Codigo = $r->Codigo; 
			$Nombre = $r->Nombre; 
			$Grupo = $r->Grupo; 
			$Nivel = $r->Nivel;
			$CodMayor = $r->CodMayor;
			$Subcuentas = $r->Subcuentas;
		}
		else {
			$Codigo = $Nombre = $Grupo = '';
			$Nivel = $CodMayor = $Subcuentas = 0;
		}
    }
	
	function Tabla() {
        $sql = "SELECT * from $this->Tabla WHERE Activo='S' ORDER BY Nombre";
		return $this->db->query($sql);
    }
    
    public function GetNombre($CodGrupo){
		$sql = "SELECT Nombre FROM $this->Tabla WHERE CodGrupo=$CodGrupo";
		return $this->db->query($sql)->row()->Nombre;
	}
	
	public function ExisteNombre($str){
		$sql = "select COUNT(*) AS Conteo from $this->Tabla where Activo='S' and Nombre='$str'";
		$query = $this->db->query($sql);
		return $query->row()->Conteo>0;
	}
}