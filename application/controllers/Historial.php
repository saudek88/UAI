<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Historial extends CI_Controller {
 	
 	public function __construct(){
    	parent::__construct();
    	$this -> load -> model(array('general_model'));
    	$this -> load -> library('pagination');
    	$this -> load -> helper('url');
	}

	public function index(){
    if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {
		 $datos['titulo'] = 'Historial';
		 $datos['historial'] = 'Historial';
		 //$datos['btn_nuevo'] = 'Nuevo Gafete';
		 $this -> load -> view('index',$datos);

			$this -> load -> view('historial', $datos);
    }
 	 }

/*
 	 public function nuevo_gafete(){

    $datos['titulo'] = 'Nuevo Gafete';
    $this -> load -> helper('form');
    $this -> load -> view('index',$datos);
  
    $this->load->view('formulario_gafete', $datos);
  } */

/*
public function agregar_gafete(){
    ini_set('date.timezone','America/Mexico_City'); 
    $ahora =  date('d/m/Y H:i:s');

    $id = $this -> gafetes_model -> get_ultimo_registro() -> Id;
    $gafete = $this -> input -> post('edificio').$this -> input -> post('numero').$this -> input -> post('puerta');
    $this -> form_validation -> set_rules('edificio','edificio','required|strtoupper');
    $this -> form_validation -> set_rules('numero','numero','required|strtoupper');
    $this -> form_validation -> set_rules('puerta','puerta','required|strtoupper');
    $this -> form_validation -> set_rules('dsiponible','dsiponible','strtoupper');

    if($this -> form_validation -> run() == FALSE ){
        $this->load->view('formulario_gafete', $datos);
     
    }else{
       
       $datos = array(
                    'Id' => $id + 1,
                    'edificio' => $this -> input -> post('edificio'),
                    'numero' => $this -> input -> post('numero'),
                    'puerta' => $this -> input -> post('puerta'),
                    'historial' => $ahora . ' USUARIO Modificó los datos del registro. WAPP',
                    'gafete' => $gafete,
                    'disponible' =>  $this -> input -> post('disponible')
                     );

       $this -> gafetes_model -> insertar($datos);
  
       redirect( base_url(). 'Gafetes');
    }
   }
*/

   public function actualizar_general($id){
    if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {
    ini_set('date.timezone','America/Mexico_City'); 
    $ahora =  date('d/m/Y H:i:s');

    //$id = $this -> funcionarios_model -> get_ultimo_registro() -> Id;
    
   $this -> form_validation -> set_rules('descripcion','DESCRIPCION','strtoupper');
   $this -> form_validation -> set_rules('cargo','CARGO','required|strtoupper');

    if($this -> form_validation -> run() == FALSE ){
        $this->load->view('formulario_general_modificar', $datos);
     
    }else{
       


    $tmpname  = $_FILES['imagen']['tmp_name']; //The temporary filename of the file in which the uploaded file was stored on the server.
    $filesize = $_FILES['imagen']['size'];
    $filetype = $_FILES['imagen']['type'];
    $allowedtypes=array("image/jpeg","image/jpg","image/png","image/gif");
    if($filesize>=0){
        if(in_array($filetype, $allowedtypes))
        {
            $fp      = fopen($tmpname, 'r');
           $imagen  = fread($fp, filesize($tmpname));
            fclose($fp);
        }
    }

       $datos = array(
                    'DESCRIPCION' => $this -> input -> post('descripcion'),
                    'CARGO' => $this -> input -> post('cargo'),
                    'IMAGEN' => $imagen
                     );

       $this -> general_model -> actualizar_datos_general($datos,$id);
  
       redirect( base_url(). 'general');
      }
    }
   }

  /*public function general_page()
     {
  
          // Datatables Variables
          $draw = intval($this -> input -> get("draw"));
          $start = intval($this -> input-> get("start"));
          $length = intval($this -> input-> get("length"));


          $visitas = $this -> general_model -> get_lista_general();


          $data = array();

          foreach($visitas->result() as $r) {

               $data[] = array(
                    $r->Id,
                    $r->DESCRIPCION,
                    $r->CARGO,
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
     }*/
public function general_page(){
if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') != 'TODOS' ) {
                    redirect('');
        } else {
     $columns = array( 
                           0 =>'Id', 
                           1 =>'DESCRIPCION',
                           2 =>'CARGO',  
                           3 =>'IMAGEN',                       
                        );

    $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  
        $totalData = $this-> general_model->allposts_count();
            
        $totalFiltered = $totalData; 
            
        if(empty($this->input->post('search')['value']))
        {            
            $posts = $this-> general_model->allposts($limit,$start,$order,$dir);
           
        }
        else {
            $search = $this->input->post('search')['value']; 

            $posts =  $this-> general_model->posts_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this-> general_model->posts_search_count($search);
        }

        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
               $nestedData['Id'] = $post->Id;
               $nestedData['DESCRIPCION'] = $post->DESCRIPCION;
               $nestedData['CARGO'] = $post->CARGO;
               if(!empty($post->IMAGEN) || $post->IMAGEN !== ""){
                $nestedData['IMAGEN'] = base64_encode($post->IMAGEN);
               }
               
                $data[] = $nestedData;
            }
        }
          
        $json_data = array(
                    "draw"            => intval($this->input->post('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
            
        echo json_encode($json_data); 
  }
 }
}