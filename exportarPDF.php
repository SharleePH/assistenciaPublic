<?php
include_once 'functions.php';
require('fpdf/fpdf.php');
class PDF extends FPDF
{
    protected $B = 0;
    protected $I = 0;
    protected $U = 0;
    protected $HREF = '';

    function WriteHTML($html)
    {
        // HTML parser
        $html = str_replace("\n",' ',$html);
        $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
        foreach($a as $i=>$e)
        {
            if($i%2==0)
            {
                // Text
                if($this->HREF)
                    $this->PutLink($this->HREF,$e);
                else
                    $this->Write(5,$e);
            }
            else
            {
                // Tag
                if($e[0]=='/')
                    $this->CloseTag(strtoupper(substr($e,1)));
                else
                {
                    // Extract attributes
                    $a2 = explode(' ',$e);
                    $tag = strtoupper(array_shift($a2));
                    $attr = array();
                    foreach($a2 as $v)
                    {
                        if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                            $attr[strtoupper($a3[1])] = $a3[2];
                    }
                    $this->OpenTag($tag,$attr);
                }
            }
        }
    }

    function OpenTag($tag, $attr)
    {
        // Opening tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,true);
        if($tag=='A')
            $this->HREF = $attr['HREF'];
        if($tag=='BR')
            $this->Ln(5);
    }

    function CloseTag($tag)
    {
        // Closing tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,false);
        if($tag=='A')
            $this->HREF = '';
    }

    function SetStyle($tag, $enable)
    {
        // Modify style and select corresponding font
        $this->$tag += ($enable ? 1 : -1);
        $style = '';
        foreach(array('B', 'I', 'U') as $s)
        {
            if($this->$s>0)
                $style .= $s;
        }
        $this->SetFont('',$style);
    }

    function PutLink($URL, $txt)
    {
        // Put a hyperlink
        $this->SetTextColor(0,0,255);
        $this->SetStyle('U',true);
        $this->Write(5,$txt,$URL);
        $this->SetStyle('U',false);
        $this->SetTextColor(0);
    }
}

// create document
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$curso                         = obtenerCursosXID($_GET['idCurso']);
$empleados                     = obtenerempleadosXID($_GET['idCurso']);
$empleadosRelacionadosXIdCurso = obtenerRelacionCursoEmpleados($_GET['idCurso']);
$empleados                     = getEmployees();

$html= "<table width='100%' style='align:center'>";
    $html.= "<tr>";
        $html.= "<td>";
            $html.= "<center><h3 class='text-center'>Lista de asistencia del curso ".$curso[0]->nombreCurso." </h3></center>";
        $html.= "</td>";
    $html.= "</tr>";
$html.= "</table></br></br></br>";


$html.= "<table>";
    $html.= "<thead>";
        $html.= "<tr>";
            $html.= "<th width='10%' class='col-lg-1'>Id</th>";
            $html.= "<th width='80%'>Empleado</th>";
            $html.= "<th width='10%'>Firma</th>";
        $html.= "</tr>";
    $html.= "</thead>";
    $html.= "<tbody>";
        $i=0;
        foreach ($empleadosRelacionadosXIdCurso as $empleado) {
            if($i>=0){
            $html.= '<tr>';
                $html.= '<td>'.$empleado->idEmpleado.'</td>';
                $html.= '<td>'.$empleado->name.'</td>';
                $html.= '<td>';
                $path = 'firmas/'.$empleado->idCurso.'/'.$empleado->idEmpleado.'/';
                if (!file_exists($path)) {
                    $html.="<center>";
                    $html.="<span>FALTA</span>";
                    $html.="</center>";
                }else{
                    //$html.= "<img src='./".$path."/sign.png' width='200px'>";
                    $html.="<span>ASISTENCIA</span>";
                }
                $html.= '</td>';
            $html.= '</tr>';
            $i++;
            }
        } 
    $html.= "</tbody>";
$html.= "</table>";
$pdf->WriteHTML($html);
//$pdf->WriteHTML("<br><br><br><span>FOO</span>");
$pdf->SetFont('Arial','B',6);
$pdf->Output(); 

//$dompdf->stream("dompdf_out.pdf");

//exit(0);
?>