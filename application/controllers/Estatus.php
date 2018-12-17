<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estatus extends CI_Controller {
 	
 	public function __construct(){
    	parent::__construct();
    	$this -> load -> model('estatus_model');
    	$this -> load -> library('pagination');
    	$this -> load -> helper('url');
	}

	public function index(){
    if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {
		 $datos['titulo'] = 'Estatus';
		 $datos['estatus'] = 'Estatus';
		 $datos['btn_nuevo'] = 'Nuevo Estatus';
		 $this -> load -> view('index',$datos);

			$this -> load -> view('estatus', $datos);
    }
 	 }
 
 	public function nuevo_estatus(){
    if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {
    $datos['titulo'] = 'Nuevo Estatus';
    $this -> load -> helper('form');
    $this -> load -> view('index',$datos);
  
    $this->load->view('formulario_estatus', $datos);
    }
	}

	public function modificar_estatus($id){
    if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {
    $datos['titulo'] = 'Modificar Estatus';
    $this -> load -> helper('form');
    $this -> load -> view('index',$datos);
    $datos['estatus'] = $this-> estatus_model -> get_datos_estatus($id);
    $this->load->view('formulario_estatus_modificar', $datos);
    }
  }

  public function estatus_eliminar($id){
    if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {
     
     $this -> estatus_model -> eliminar($id);
     
    }
   }


public function agregar_estatus(){
  if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {
    ini_set('date.timezone','America/Mexico_City'); 
    $ahora =  date('d/m/Y H:i:s');

    $id = $this -> estatus_model -> get_ultimo_registro() -> Id;
    $this -> form_validation -> set_rules('estatus','status','required|strtoupper');
    $this -> form_validation -> set_rules('tipo','tipo','required|strtoupper');

    if($this -> form_validation -> run() == FALSE ){
        $this->load->view('formulario_esatus', $datos);
     
    }else{
       
       $datos = array(
                    'Id' => $id + 1,
                    'status' => trim($this -> input -> post('estatus')),
                    'tipo' => $this -> input -> post('tipo'),
                    'historial' => $ahora . ' USUARIO Modificó los datos del registro. WAPP'   
                     );

       $this -> estatus_model -> insertar($datos);
  
       redirect( base_url(). 'Estatus');
      }
    }
   }


   public function actualizar_estatus($id){

    if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {
    ini_set('date.timezone','America/Mexico_City'); 
    $ahora =  date('d/m/Y H:i:s');
    $this -> form_validation -> set_rules('estatus','status','required|strtoupper');
    $this -> form_validation -> set_rules('tipo','tipo','required|strtoupper');
   
    if($this -> form_validation -> run() == FALSE ){
        $this->load->view('formulario_gafetes', $datos);
     
    }else{
       
       $datos = array(
                   //'Id' => $id + 1,
                    'status' => trim($this -> input -> post('estatus')),
                    'tipo' => $this -> input -> post('tipo'),
                    'historial' => $ahora . ' USUARIO Modificó los datos del registro. WAPP'
                     );

       $this -> estatus_model -> actualizar_datos_estatus($datos,$id);
  
       redirect( base_url(). 'estatus');
      }
    }
   }

 	 public function estatus_page()
     {
          if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {
          // Datatables Variables
          $draw = intval($this -> input -> get("draw"));
          $start = intval($this -> input-> get("start"));
          $length = intval($this -> input-> get("length"));


          $visitas = $this -> estatus_model -> get_lista_estatus();

          $data = array();

          foreach($visitas->result() as $r) {

          			if($r->tipo == 1){
          				$r->tipo = 'VISITAS';
          			}else{
          				$r->tipo = 'PROGRAMADAS';
          			}

               $data[] = array(
                    $r->Id,
                    $r->status,
                    $r->tipo
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