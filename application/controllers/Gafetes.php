<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gafetes extends CI_Controller {
 	
 	public function __construct(){
    	parent::__construct();
    	$this -> load -> model(array('gafetes_model'));
    	$this -> load -> library('pagination');
    	$this -> load -> helper('url');
	}

	public function index(){
    if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {
		 $datos['titulo'] = 'Gafetes';
		 $datos['gafete'] = 'Gafetes';
		 $datos['btn_nuevo'] = 'Nuevo Gafete';
		 $this -> load -> view('index',$datos);

			$this -> load -> view('gafetes', $datos);
    }
 	 }


 	 public function nuevo_gafete(){
    if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {
    $datos['titulo'] = 'Nuevo Gafete';
    $this -> load -> helper('form');
    $this -> load -> view('index',$datos);
  
    $this->load->view('formulario_gafete', $datos);
    }
  }

public function modificar_gafete($id){
    if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {
    $datos['titulo'] = 'Modificar Gafete';
    $this -> load -> helper('form');
    $this -> load -> view('index',$datos);
    $datos['gafete'] = $this-> gafetes_model -> get_datos_gafete($id);
    $this->load->view('formulario_gafete_modificar', $datos);
    }
  }

public function gafete_eliminar($id){
    if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {
     
     $this -> gafetes_model -> eliminar($id);
     
    }
   }

public function agregar_gafete(){
    if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {
    ini_set('date.timezone','America/Mexico_City'); 
    $ahora =  date('d/m/Y H:i:s');

    $id = $this -> gafetes_model -> get_ultimo_registro() -> Id;
    $gafete = $this -> input -> post('edificio').$this -> input -> post('numero').$this -> input -> post('puerta');
     $gafete = strtoupper($gafete);
    $this -> form_validation -> set_rules('edificio','edificio','required|strtoupper');
    $this -> form_validation -> set_rules('numero','numero','required|strtoupper');
    $this -> form_validation -> set_rules('puerta','puerta','required|strtoupper');
    $this -> form_validation -> set_rules('dsiponible','dsiponible','strtoupper');

    if($this -> form_validation -> run() == FALSE ){
        $this->load->view('formulario_gafete', $datos);
     
    }else{
       
       $datos = array(
                    'Id' => $id + 1,
                    'edificio' => trim($this -> input -> post('edificio')),
                    'numero' => trim($this -> input -> post('numero')),
                    'puerta' => trim($this -> input -> post('puerta')),
                    'historial' => $ahora . ' USUARIO Modificó los datos del registro. WAPP',
                    'gafete' => $gafete,
                    'disponible' =>  $this -> input -> post('disponible')
                     );

       $this -> gafetes_model -> insertar($datos);
  
       redirect( base_url(). 'Gafetes');
      }
    }
   }


   public function actualizar_gafete($id){
    if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {
    ini_set('date.timezone','America/Mexico_City'); 
    $ahora =  date('d/m/Y H:i:s');

    //$id = $this -> funcionarios_model -> get_ultimo_registro() -> Id;
    $gafete = $this -> input -> post('edificio').$this -> input -> post('numero').$this -> input -> post('puerta');
    $this -> form_validation -> set_rules('edificio','edificio','required|strtoupper');
    $this -> form_validation -> set_rules('numero','numero','required|strtoupper');
    $this -> form_validation -> set_rules('puerta','puerta','required|strtoupper');
    $this -> form_validation -> set_rules('dsiponible','dsiponible','strtoupper');

    if($this -> form_validation -> run() == FALSE ){
        $this->load->view('formulario_gafetes', $datos);
     
    }else{
       
       $datos = array(
                   //'Id' => $id + 1,
                    'edificio' => trim($this -> input -> post('edificio')),
                    'numero' => trim($this -> input -> post('numero')),
                    'puerta' => trim($this -> input -> post('puerta')),
                    'historial' => $ahora . ' USUARIO Modificó los datos del registro. WAPP',
                    'gafete' => strtoupper($gafete),
                    'disponible' =>  $this -> input -> post('disponible')
                     );

       $this -> gafetes_model -> actualizar_datos_gafete($datos,$id);
  
       redirect( base_url(). 'Gafetes');
      }
    }
   }

  public function gafetes_page()
     {
      if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {
          // Datatables Variables
          $draw = intval($this -> input -> get("draw"));
          $start = intval($this -> input-> get("start"));
          $length = intval($this -> input-> get("length"));


          $visitas = $this -> gafetes_model -> get_lista_gafetes();

          $data = array();

          foreach($visitas->result() as $r) {

               $data[] = array(
                    $r->Id,
                    $r->edificio,
                    $r->numero,
                    $r->puerta,
                    $r->gafete,
                    $r->disponible
               );
          }

          $output = array(
               "draw" => $draw,
                 "recordsTotal" => $visitas->num_rows(),
                 "recordsFiltered" => $visitas->num_rows(),
                 "data" => $data
            );
          echo json_encode($output);
          exit();
     }
   }
}