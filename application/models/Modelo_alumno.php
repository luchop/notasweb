<?php

class Modelo_alumno extends CI_Model {

    private $Tabla = 'alumno';

    function __construct() {
        parent::__construct();
    }
	
    function Insert($Paterno, $Materno, $Nombres, $CI, $RU) {
        $sql = "INSERT INTO $this->Tabla (Paterno, Materno, Nombres, CI, RU, Activo) 
                VALUES ('$Paterno', '$Materno', '$Nombres', '$CI', '$RU', 'S')";
        $this->db->query($sql);  
        
        $sql = "SELECT LAST_INSERT_ID() AS Codigo";
        $query = $this->db->query($sql);
        if ( $query->num_rows()>0 )
           return $query->row()->Codigo;
        else        
            return 0;
    }

    function Update($CodAlumno, $Paterno, $Materno, $Nombres, $CI, $RU) {
        $sql = "UPDATE $this->Tabla SET Paterno='$Paterno', Materno='$Materno', Nombres='$Nombres',
                CI='$CI', RU='$RU'
                WHERE CodAlumno=$CodAlumno";
        return $this->db->query($sql);
    }

    function Busqueda($Nombre, $Apellido, $CI, $RU) {
        $sql = "select * from $this->Tabla where 1=1 ";
        if($Nombre!='')
            $sql .= "AND Nombres like '%$Nombre%' ";
        if($Apellido!='')
            $sql .= "AND CONCAT_WS(' ', Paterno, Materno)  like '%$Apellido%' ";
        if($CI!='')
            $sql .= "AND CI='$CI' ";
        if($RU!='')
            $sql .= "AND RU='$RU' ";
        $sql .= "ORDER BY Paterno, Materno, Nombres";
        
        return $this->db->query($sql);
    }

    function getFila($CodAlumno) {
        $sql = "select * from $this->Tabla where CodAlumno=$CodAlumno";
        return $this->db->query($sql)->row();
    }

    function Delete($CodAlumno) {
        $this->db->where('CodAlumno', $CodAlumno);
        $this->db->delete($this->Tabla);
    }
    
    function EsAdministrador($CodAlumno) {
        $sql = "SELECT * FROM $this->Tabla WHERE CodAlumno=? AND Activo=1";  //1:administrador
        $query = $this->db->query($sql, array($CodAlumno));
        return $query->num_rows()>0;        
    }
    
    function BuscarAlumno($Alumno){
        $sql = "SELECT * FROM $this->Tabla
                WHERE (Nombres LIKE('%$Alumno%')
                OR Apellidos LIKE('%$Alumno%')) and
				Alumno='$this->EsAlumno'
                ORDER BY Nombres, Apellidos";
        $resultado=mysql_query($sql,$link); 
        return $resultado;
    }
    
    function NombreAlumno($CodAlumno) {
        $sql = "select * FROM $this->Tabla WHERE CodAlumno=$CodAlumno";
        $query = $this->db->query($sql);
        if($query->num_rows()>0) {
            $row = $query->row();
            return $row->Nombre;
        } else
            return '';
    }
    
    function ComboAlumno($CodAlumno, $Requerido='1') {
        $sql = "select * from $this->Tabla 
		where CodInstitucion=$this->CodInstitucion 
		and EsAlumno='$this->EsAlumno'
		order by Nombre";
        $resultado = $this->db->query($sql);
        $s = "<select name='CodAlumno' id='CodAlumno'>";
		if($Requerido==0)
			$s .= "<option value=''>-- Seleccione el alumno --</option>";
        foreach($resultado->result() as $row) 
            $s .= "<option value=".$row->CodAlumno.($CodAlumno==$row->CodAlumno? ' selected ':'').">".$row->Nombre."</option>";
        return $s."</select>";       
    }
    
    function ExisteNick($s) {
        $sql = "SELECT CodAlumno FROM $this->Tabla WHERE Nick='$s'";
        $query = $this->db->query($sql);
        return ($query->num_rows()>0);
    }
    
    function ExisteCorreo($s) {
        $sql = "SELECT CodAlumno FROM $this->Tabla WHERE Correo='$s'";
        $query = $this->db->query($sql);
        return ($query->num_rows()>0);
    }
    
    //devuelve codigo de alumno.	
    function Verifica($nick, $clave, &$Codigo) {
		$sql = "SELECT CodAlumno FROM $this->Tabla WHERE Nick=? AND Clave=SHA1(?)";							
		$query = $this->db->query($sql, array($nick, $clave));
		if ($query->num_rows() > 0) {    //encontrado 
			$row = $query->row(); 
			$Codigo = $row->CodAlumno;
			return true;
		}
		else
			return false;
	}
    
    function GetNombre($CodAlumno) {
        $sql = "SELECT Nombre FROM $this->Tabla WHERE CodAlumno=$CodAlumno";
        $query = $this->db->query($sql);
        if( $query->num_rows()>0) {
            $row = $query->row();
            return $row->Nombre;
        }
        else
            return '';
    }
    
    function CambiaClave( $CodAlumno, $NuevaClave ) {
        $sql = "UPDATE $this->Tabla SET Clave=MD5($NuevaClave) WHERE CodAlumno=$CodAlumno";
        $this->db->query($sql);
    }
 
}

?>