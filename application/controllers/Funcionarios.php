<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Funcionarios extends CI_Controller {
 	
 	public function __construct(){
    	parent::__construct();
    	$this -> load -> model(array('funcionarios_model'));
    	$this -> load -> library('pagination');
    	$this -> load -> helper('url');
	}

	public function index(){
    if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {
		 $datos['titulo'] = 'Funcionarios';
		 $datos['vista'] = 'Funcionarios';
		 $datos['btn_nuevo'] = 'Nuevo Funcionario';
		 $this -> load -> view('index',$datos);

			$this -> load -> view('funcionarios', $datos);
    }
 	 }


 	 public function nuevo_funcionario(){

    if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {
    $datos['titulo'] = 'Nuevo Funcionario';
    $this -> load -> helper('form');
    $this -> load -> view('index',$datos);
  
    $this->load->view('formulario_funcionarios', $datos);
     }
  }

public function modificar_funcionario($id){
    if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {
    $datos['titulo'] = 'Modificar Funcionario';
    $this -> load -> helper('form');
    $this -> load -> view('index',$datos);
    $datos['funcionario'] = $this-> funcionarios_model -> get_datos_funcionario($id);
    $this->load->view('formulario_funcionarios_modificar', $datos);
    }
  }


public function agregar_funcionario(){
  if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {
    ini_set('date.timezone','America/Mexico_City'); 
    $ahora =  date('d/m/Y H:i:s');



    if($this-> funcionarios_model -> get_ultimo_registro()){  
         $id = $this -> funcionarios_model-> get_ultimo_registro() -> Id;
      }else{
         $id = 0;
      }
      
    $this -> form_validation -> set_rules('nombre','nombre','required|strtoupper');
    $this -> form_validation -> set_rules('cargo','cargo','required|strtoupper');
    $this -> form_validation -> set_rules('dependencia','dependencia','required|strtoupper');
    $this -> form_validation -> set_rules('area','area','required|strtoupper');
    $this -> form_validation -> set_rules('telefono','telefono_celular','strtoupper');

    if($this -> form_validation -> run() == FALSE ){
        $this->load->view('formulario_funcionarios', $datos);
     
    }else{
       
       $datos = array(
                    'Id' => $id + 1,
                    'nombre' => trim($this -> input -> post('nombre')),
                    'cargo' => trim($this -> input -> post('cargo')),
                    'dependencia' => trim($this -> input -> post('dependencia')),
                    'area' => trim($this -> input -> post('area')),
                    'telefono_celular' => trim($this -> input -> post('telefono')),
                    'historial' => $ahora . ' USUARIO Modificó los datos del registro. WAPP'
                     );

       $this -> funcionarios_model -> insertar($datos);
  
       redirect( base_url(). 'Funcionarios');
    }
    }
   }


   public function actualizar_funcionario($id){
    if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {
    ini_set('date.timezone','America/Mexico_City'); 
    $ahora =  date('d/m/Y H:i:s');

    //$id = $this -> funcionarios_model -> get_ultimo_registro() -> Id;

    $this -> form_validation -> set_rules('nombre','nombre','required|strtoupper');
    $this -> form_validation -> set_rules('cargo','cargo','required|strtoupper');
    $this -> form_validation -> set_rules('dependencia','dependencia','required|strtoupper');
    $this -> form_validation -> set_rules('area','area','required|strtoupper');
    $this -> form_validation -> set_rules('telefono','telefono_celular','strtoupper');

    if($this -> form_validation -> run() == FALSE ){
        $this->load->view('formulario_funcionarios', $datos);
     
    }else{
       
       $datos = array(
                   // 'Id' => $id,
                    'nombre' => trim($this -> input -> post('nombre')),
                    'cargo' => trim($this -> input -> post('cargo')),
                    'dependencia' => trim($this -> input -> post('dependencia')),
                    'area' => trim($this -> input -> post('area')),
                    'telefono_celular' => trim($this -> input -> post('telefono')),
                    'historial' => $ahora . ' USUARIO Modificó los datos del registro. WAPP'
                     );

       $this -> funcionarios_model -> actualizar_datos_funcionario($datos,$id);
  
       redirect( base_url(). 'Funcionarios');
        }
      }
   }

   public function funcionario_eliminar($id){
    if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {
     $this -> funcionarios_model -> eliminar($id);
     
    }
   }
  public function funcionarios_page()
     {  
      if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {

          // Datatables Variables
          $draw = intval($this -> input -> get("draw"));
          $start = intval($this -> input-> get("start"));
          $length = intval($this -> input-> get("length"));


          $visitas = $this -> funcionarios_model -> get_funcionarios();

          $data = array();

          foreach($visitas->result() as $r) {

               $data[] = array(
                    $r->Id,
                    $r->nombre,
                    $r->cargo,
                    $r->dependencia,
                    $r->area,
                    $r->telefono_celular
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