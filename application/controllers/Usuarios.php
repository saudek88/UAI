<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {
 	
 	public function __construct(){
    	parent::__construct();
    	$this -> load -> model('usuarios_model');
    	$this -> load -> library('pagination');
    	$this -> load -> helper('url');
	}

	public function index(){
    if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {
		 $datos['titulo'] = 'Usuario';
		 $datos['usuarios'] = 'Usuario';
		 $datos['btn_nuevo'] = 'Nuevo Usuario';
		 $this -> load -> view('index',$datos);

			$this -> load -> view('usuarios', $datos);
      }
    
 	 }
 
 	public function nuevo_usuario(){
    if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {
    $datos['titulo'] = 'Nuevo Usuario';
    $this -> load -> helper('form');
    $this -> load -> view('index',$datos);
  
    $this->load->view('formulario_usuarios', $datos);
    }
	}

	public function modificar_usuario($id){
    if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {
    $datos['titulo'] = 'Modificar Usuario';
    $this -> load -> helper('form');
    $this -> load -> view('index',$datos);
    $datos['usuarios'] = $this-> usuarios_model -> get_datos_usuario($id);
    $this->load->view('formulario_usuarios_modificar', $datos);
    }
  }

  public function reset_password($id){if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {
      $pass_aux = $this-> Funcion_para_encriptar('1234');
      $this-> usuarios_model ->reset_pass($id,$pass_aux);
    }
  }

public function usuario_eliminar($id){
    if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {
     
     $this -> usuarios_model -> eliminar($id);
     
    }
   }

public function agregar_usuario(){
if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {

    $id = $this -> usuarios_model -> get_ultimo_registro() -> Id;
    $this -> form_validation -> set_rules('usuario','USUARIO','required|strtoupper');
    $this -> form_validation -> set_rules('nombre','NOMBRE','required|strtoupper');
    $this -> form_validation -> set_rules('iniciales','INICIALES','required|strtoupper');
    $this -> form_validation -> set_rules('cargo','CARGO','required|strtoupper');
    $this -> form_validation -> set_rules('pass','CONTRASENA','required|strtoupper');
    $this -> form_validation -> set_rules('tipo','TIPO DE USUARIO','required|strtoupper');
    $this -> form_validation -> set_rules('permisos','PERMISOS','required|strtoupper');

    $pass = $this-> Funcion_para_encriptar($this -> input -> post('pass'));
    
   
    if($this -> form_validation -> run() == FALSE ){
        $this->load->view('formulario_usuarios', $datos);
     
    }else{
        
        $usr_result = $this-> usuarios_model->comprobar_usuario($this -> input -> post('usuario'));
       if($usr_result == FALSE ){
        $datos = array(
                    'Id' => $id + 1,
                    'USUARIO' => trim($this -> input -> post('usuario')),
                    'NOMBRE' => trim($this -> input -> post('nombre')),
                    'INICIALES' => trim($this -> input -> post('iniciales')),
                    'CARGO' => trim($this -> input -> post('cargo')),
                    'CONTRASENA' => $pass,
                     'TIPO'=> $this -> input -> post('tipo'),
                    'PERMISOS' => $this -> input -> post('permisos'),
                     );

       $this -> usuarios_model -> insertar($datos);

       redirect( base_url(). 'Usuarios');
     }else{
      $datos['titulo'] = 'Nuevo Usuario';
      $this -> load -> helper('form');
      $this -> load -> view('index',$datos);
      $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">¡El usuario ya existe!</div>');
      $this->load->view('formulario_usuarios',$datos);

     }

       }
    }
   }

   public function Funcion_para_encriptar($ContraTecleada){
    if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {
     $clave = "zxyw";
     $ContraseñaEncriptada = "";
    if (!strlen($ContraTecleada) == 0){
        $ListaNumerosContr = array();
        $ListaNumerosClave = array();
        $C = 0;
        $I = 0;
        $J = 0;
        $Suma;
        $N1;
        $N2;
        $ArregloEnChar = str_split($ContraTecleada);
    
        for ($I = 0; $I <= strlen($ContraTecleada) - 1; $I++)
        {
            $C = $ArregloEnChar[$I];
            $ListaNumerosContr[] = ord($C);
        }
        $ArregloEnChar = str_split ($clave);
        for ($I = 0; $I <= strlen($clave) - 1; $I++)
        {
             $C = $ArregloEnChar[$I];
             $ListaNumerosClave[] = ord($C);
        }

        $J = 0; $Suma = 0; $N1 = 0; $N2 = 0;
        for ($I = 0; $I <= count($ListaNumerosContr) - 1; $I++)
        {
            $Suma = $ListaNumerosContr[$I] + $ListaNumerosClave[$J];
           // echo $Suma;
            $N1 = (int)($Suma / 2);
            $N2 = $N1;
            if (($Suma % 2) == 1) $N2 += 1;

            $ContraseñaEncriptada .= "".chr($N1).chr($N2);

            $J++;
            if ($J == count($ListaNumerosClave)) $J = 0;

      }
   }
   return $ContraseñaEncriptada;
 }
}

   public function actualizar_usuario($id){

    if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {
    ini_set('date.timezone','America/Mexico_City'); 
    $ahora =  date('d/m/Y H:i:s');
    $this -> form_validation -> set_rules('usuario','USUARIO','required|strtoupper');
    $this -> form_validation -> set_rules('nombre','NOMBRE','required|strtoupper');
    $this -> form_validation -> set_rules('iniciales','INICIALES','required|strtoupper');
    $this -> form_validation -> set_rules('cargo','CARGO','required|strtoupper');
    $this -> form_validation -> set_rules('pass','CONTRASENA','required|strtoupper');
    $this -> form_validation -> set_rules('tipo','TIPO DE USUARIO','required|strtoupper');
    $this -> form_validation -> set_rules('permisos','PERMISOS','required|strtoupper');
   
    if($this -> form_validation -> run() == FALSE ){
        $this->load->view('formulario_gafetes', $datos);
     
    }else{
       
       $datos = array(
                    
                    'USUARIO' => trim($this -> input -> post('usuario')),
                    'NOMBRE' => trim($this -> input -> post('nombre')),
                    'INICIALES' => trim($this -> input -> post('iniciales')),
                    'CARGO' => trim($this -> input -> post('cargo')),
                    'TIPO'=> $this -> input -> post('tipo'),
                    'PERMISOS' => $this -> input -> post('permisos'),
                     );

       $this -> usuarios_model -> actualizar_datos_usuario($datos,$id);
  
       redirect( base_url(). 'usuarios');
      }
    }
   }

 	 public function usuarios_page()
     {
      if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {
          // Datatables Variables
          $draw = intval($this -> input -> get("draw"));
          $start = intval($this -> input-> get("start"));
          $length = intval($this -> input-> get("length"));


          $visitas = $this -> usuarios_model -> get_lista_usuarios();
          $data = array();

          foreach($visitas->result() as $r) {

               $data[] = array(
                    $r->Id,
                    $r->USUARIO,
                    $r->NOMBRE,
                    $r->INICIALES,
                    $r->CARGO,
                   
                    $r->TIPO,
                    $r->PERMISOS
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