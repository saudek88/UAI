<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportes extends CI_Controller {
 	
 	public function __construct(){
    	parent::__construct();
    	$this -> load -> model(array('visitas_model'));
    	$this -> load -> library('pagination');
    	$this -> load -> helper('url');

	}

	public function index(){
    if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {
		 $datos['titulo'] = 'Reportes';
		 $datos['vista'] = 'Reportes';
		 $datos['btn_nuevo'] = 'Generar Reporte';
		 $this -> load -> view('index',$datos);

			$this -> load -> view('reportes', $datos);
    }

 	 }

//******************** REPORTES *************************
   public function generate_pdf() {
    if($this -> input -> post('fecha_inicial_reporte_visitas') == ""|| $this -> input -> post('fecha_final_reporte_visitas') == ""){
      echo "<b>Ocurrió un error y el formulario no ha sido enviado. </b><br />";
      echo "Por favor, vuelva atrás y verifique la información ingresada<br />";
      die();
    }

    $fecha_inicial = date_create_from_format('d/m/Y H:i:s', $this -> input -> post('fecha_inicial_reporte_visitas'));
    $fecha_inicial = date_format($fecha_inicial, 'Y-m-d H:i:s');

    $fecha_final = date_create_from_format('d/m/Y H:i:s', $this -> input -> post('fecha_final_reporte_visitas'));
    //$fecha_final = date('Y-m-d', strtotime($fecha_final. ' + 1 day'));
    $fecha_final = date_format($fecha_final, 'Y-m-d H:i:s');
   
    
  $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Israel Parra');
        $pdf->SetTitle('Reporte');
        $pdf->SetSubject('Tutorial TCPDF');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
//relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 
 
// ---------------------------------------------------------
// establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);
 
// Establecer el tipo de letra
 
//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.
       $pdf->SetFont('Helvetica', '', 8, '', true);
 
// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage('L');
 
//fijar efecto de sombra en el texto
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
 
// Establecemos el contenido para imprimir
      
        $visitas = $this-> visitas_model->get_vistas_rango_fechas($fecha_inicial, $fecha_final);
             //preparamos y maquetamos el contenido a crear
      
       
    $fecha_inicial_print = date_create_from_format('d/m/Y H:i:s', $this -> input -> post('fecha_inicial_reporte_visitas'));
    $fecha_inicial_print = date_format($fecha_inicial_print, 'd/m/Y H:i:s');

    $fecha_final_print = date_create_from_format('d/m/Y H:i:s', $this -> input -> post('fecha_final_reporte_visitas'));
    $fecha_final_print = date_format($fecha_final_print , 'd/m/Y H:i:s');


    $rango_firma = '<table width="30%" border="1px" cellpadding="5">
                        <tr>
                            <th font-weight = "bold">Fecha Inicial</th>
                            <th>'.$fecha_inicial_print.'</th>
                        </tr>
                        <tr>
                            <th>Fecha Final</th>
                            <th>'.$fecha_final_print.'</th>
                        </tr>
                    </table>';
    //$rango_firma .= 'Reporte del: '.$fecha_inicial_print .' al '. $fecha_final_print . ' Nombre y firma : ' ;
     $rango_firma .= '<br />';
    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $rango_firma , $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);


       $html = '';
       $html .= '<style type=text/css>';
        $html .= 'th{
                    font-weight: bold;
                    background-color:  #1337B3; 
                    color: white;
                    text-align: center;
                    }';
        $html .= 'td{
                    background-color:  #8213B3; 
                    color:  #8213B3
                    }';
        $html .= '</style>';
        $html .= '<table  width="100%" border="1px" cellpadding="5">';
        $html .= '
            <thead>
            <tr  >                
                    <th width="50" background-color = "" color="" text-align="">#</th>
                    <th width="75" background-color = "" color="" >ID</th>
                    <th width="100" background-color = "" color="" >NOMBRE</th>
                    <th width="100" background-color = "" color="">AP. PATERNO</th>
                    <th width="100" background-color = "" color="">AP. MATERNO</th>
                    <th width="100" background-color = "" color="">PROCEDENCIA</th>
                    <th width="100" background-color = "" color="">MOTIVO</th>
                    <th width="100" background-color = "" color="">A QUIEN VISITA</th>
                    <th width="100" background-color = "" color="">FECHA INGRESO</th>
                    <th width="100" background-color = "" color="">FECHA EGRESO</th>
                  </tr>
            </thead>
                  ';

        //$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html , $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        
        $cont = 0;          
        foreach ($visitas as $fila) 
        {
            $cont += 1;
            $id = $fila-> Id;
            $nombre_visitante = $fila-> nombre_visitante;
            $apellido_pat_visitante = $fila-> apellido_pat_visitante;
            $apellido_mat_visitante = $fila-> apellido_mat_visitante;
            $procedencia = $fila -> procedencia;
            $motivo_visita = $fila -> motivo_visita;
            $a_quien_visita = $fila -> a_quien_visita;
            $fecha_ingreso = $fila -> fecha_ingreso;
            $fecha_egreso = $fila -> fecha_egreso;


           $html .= '<tbody>
                        <tr>
                        <td width="50">' . $cont . '</td>
                        <td width="75">' . $id . '</td>
                        <td width="100">' . $nombre_visitante . '</td>
                        <td width="100">'.  $apellido_pat_visitante . '</td>
                        <td width="100">' . $apellido_mat_visitante . '</td>
                        <td width="100">' . $procedencia . '</td>
                        <td width="100">' . $motivo_visita . '</td>
                        <td width="100">' . $a_quien_visita . '</td>
                        <td width="100">' . $fecha_ingreso . '</td>
                        <td width="100">' . $fecha_egreso . '</td>
                    </tr>
                    </tbody>';
           
            }

        $html .= '</table>';
        
   

      $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html , $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $fechaActual = date('d-m-Y H:i:s');
// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("reporte_visitas_".$fechaActual.".pdf");
       ob_end_clean();
       $pdf->Output($nombre_archivo, 'I');
     }
}