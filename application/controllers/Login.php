<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

     public function __construct()
     {
          parent::__construct();
          $this->load->library('session');
          $this->load->helper('form');
          $this->load->helper('url');
          $this->load->helper('html');
          $this->load->database();
          $this->load->library('form_validation');
          //load the login model
          $this->load->model('login_model');
     }

	public function index()
	{
		$datos['titulo'] = 'Bienvenido';
   		
   		if ($this->session->userdata('is_authenticated') == FALSE) {
            $this-> load->view('formulario_login',$datos);
        } else {
			  redirect('investigaciones'); // the user is not logged in, redirect them!
		}	
	}

	public function logear_usuario(){
    
		$usuario = $this-> input->post("usuario");
        $password = $this -> Funcion_para_encriptar($this-> input->post("password"));

        //set validations
          $this-> form_validation->set_rules("usuario", "USUARIO", "trim|required");
          $this-> form_validation->set_rules("password", "CONTRASENA", "trim|required");

          
          if ($this-> form_validation->run() == FALSE)
          {
               //validation fails
               $this-> load->view('formulario_login');
               
          }else{
          		//validation succeeds

               		//check if usuario and password is correct
                    $usr_result = $this-> login_model->get_user($usuario, $password);
                                     
                    	if ($usr_result > 0) //active user record is present
	                    {
                          $datos_usuario = $this-> login_model->get_datos_usuario($usuario);
	                         //set the session variables
                       
	                         $sessiondata = array(
	                              'usuario' => $usuario,
	                              'is_authenticated' => TRUE,
                                'permisos' => $datos_usuario -> PERMISOS,

	                         );
	                         $this-> session->set_userdata( $sessiondata);
                          
                          if($this->session->userdata('permisos') == 'PROGRAMADAS'){
                            redirect( base_url()."programadas");
                          }else{
                             redirect( base_url()."investigaciones");
                          }


	                         
	                    }else
	                    {
	                         $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Usuario o contraseña incorrecta!</div>');

	                         redirect( base_url());
	                    }           
          }
	}


	public function cerrar_sesion(){
		$sessiondata = array(
	        'usuario' => null,
	    	'is_authenticated' => FALSE
	    );
	    $this-> session->set_userdata( $sessiondata);
	    redirect('');
	}

	public function Funcion_para_encriptar($ContraTecleada){
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
