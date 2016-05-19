<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."third_party/fpdf/fpdf.php";

class Pdf  extends FPDF{

	function __construct() {
		parent::__construct();
    }
	
	public function Footer() {
        $this->SetY(-18);
		$this->SetFont('Arial', '', 8);
		$this->Cell(0, 4, utf8_decode('Pág. ').$this->PageNo().'/{nb}', 'T', 0, 'R');
    }
	
	public function Titulo($Titulo, $Linea1='', $Linea2='', $Linea3='') {
        $this->SetFont('Arial', '', 10);
		$this->cell(60, 4, utf8_decode($Linea1), 0, 1, 'C');
		$this->cell(60, 4, utf8_decode($Linea2), 0, 1, 'C');
		$this->cell(60, 4, utf8_decode($Linea3), 0, 1, 'C');
		$this->Ln(2);
		$this->SetFont('Arial', 'B', 18);		
		$this->cell(0, 4, $Titulo, 0, 1, 'C');
		$this->Ln(2);
    }
	
	function ClippingRect($x, $y, $w, $h, $outline=false) {
        $op=$outline ? 'S' : 'n';
        $this->_out(sprintf('q %.2F %.2F %.2F %.2F re W %s',
            $x*$this->k,
            ($this->h-$y)*$this->k,
            $w*$this->k,-$h*$this->k,
            $op));
    }
	
	function UnsetClipping() {
        $this->_out('Q');
    }
	
	function ClippedCell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='') {
        if($border || $fill || $this->y+$h>$this->PageBreakTrigger)
        {
            $this->Cell($w,$h,'',$border,0,'',$fill);
            $this->x-=$w;
        }
        $this->ClippingRect($this->x,$this->y,$w,$h);
        $this->Cell($w,$h,$txt,'',$ln,$align,false,$link);
        $this->UnsetClipping();
    }
	
	function RoundedRect($x, $y, $w, $h, $r, $style = '') {
        $k = $this->k;
        $hp = $this->h;
        if($style=='F')
            $op='f';
        elseif($style=='FD' || $style=='DF')
            $op='B';
        else
            $op='S';
        $MyArc = 4/3 * (sqrt(2) - 1);
        $this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));
        $xc = $x+$w-$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));

        $this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);
        $xc = $x+$w-$r ;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
        $this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
        $xc = $x+$r ;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
        $this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
        $xc = $x+$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
        $this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
        $this->_out($op);
    }

    function _Arc($x1, $y1, $x2, $y2, $x3, $y3) {
        $h = $this->h;
        $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
            $x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
    }

}