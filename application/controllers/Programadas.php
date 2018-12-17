<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Programadas extends CI_Controller {
  
 
  public function __construct()
    {
    parent::__construct();
    $this -> load -> model(array('programadas_model', 'estatus_model','funcionarios_model'));
    $this -> load -> library('pagination');
    $this -> load -> helper('url');
    }
  public function index()
  {   

        if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') == 'PUERTA' ) {
                    redirect('');
        } else {
        $datos['programadas'] = $this -> programadas_model-> get_programadas();  
        $datos['titulo'] = 'Programadas';
        $datos['programada'] = 'PROGRAMADAS';
        $datos['btn_nuevo'] = 'Nueva Programada';
        $datos['agregado'] = 'false';
        $this -> load -> view('index',$datos);
        $this -> load -> view('programadas', $datos);
        }
  }

  public function nueva_programada(){
    if ($this-> session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') == 'PUERTA' ) {
                    redirect('');
      } else {
      $datos['titulo'] = 'Nueva Visita Programada';
      $this -> load -> helper('form');
      $this -> load -> view('index',$datos);
      $datos['estatus'] = $this-> estatus_model->get_estatus('0');
      $datos['a_quien'] = $this-> funcionarios_model-> get_funcionarios();

      if($this-> programadas_model->get_ultimo_registro()){  
          $datos['ultimo_id'] = $this-> programadas_model->get_ultimo_registro() -> Id;
      }else{
         $datos['ultimo_id'] = 0;
      }
      $this->load->view('formulario_programadas', $datos);
    }
  }

    public function modificar_programada($id){
      if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') == 'PUERTA') {
                    redirect('');
        } else {
    $datos['titulo'] = 'Modificar Programada';
    $this -> load -> helper('form');
    $this -> load -> view('index',$datos);
    $datos['estatus'] = $this-> estatus_model->get_estatus('0');
    $datos['ultimo_id'] = $id;
    $datos['programada'] = $this-> programadas_model -> get_datos_programada($id);
     $datos['a_quien'] = $this-> funcionarios_model-> get_funcionarios();
    
    if($datos['programada']->status === 'CANCELADO'){
      $datos['deshabilitar'] = 'disabled';
     
    }else{
      $datos['deshabilitar'] = '';
    }


    $this->load->view('formulario_programadas_modificar', $datos);
    }
  }

  public function agregar_programada(){
    ini_set('date.timezone','America/Mexico_City'); 
    $ahora =  date('d/m/Y H:i:s');

    $this -> form_validation -> set_rules('nombre','nombre','required|strtoupper');
    $this -> form_validation -> set_rules('paterno','apellido_pat','required|strtoupper');
    $this -> form_validation -> set_rules('materno','apellido_mat','required|strtoupper');
    $this -> form_validation -> set_rules('procedencia','procedencia','required|strtoupper');
    $this -> form_validation -> set_rules('motivo','motivo','required|strtoupper');
    $this -> form_validation -> set_rules('a_quien','a_quien_visita','required|strtoupper');
    $this -> form_validation -> set_rules('observaciones','observaciones','strtoupper');
    $this -> form_validation -> set_rules('telefono','telefono','strtoupper');
    $this -> form_validation -> set_rules('telefono','telefono','strtoupper');
    $this -> form_validation -> set_rules('relevante','relevante','strtoupper');

    $fecha_ingreso = date_create_from_format('d/m/Y H:i:s', $this -> input -> post('fecha_entrada'));

    if($this -> form_validation -> run() == FALSE ){
        $datos['ultimo_id'] = $this -> programadas_model -> get_ultimo_registro();
        $this->load->view('formulario_programadas', $datos);
    }else{
       $datos = array(
                    'Id' => $this -> input -> post('folio'),
                    'nombre' => trim($this -> input -> post('nombre')),
                    'apellido_pat' => trim($this -> input -> post('paterno')),
                    'apellido_mat' => trim($this -> input -> post('materno')),
                    'motivo' => trim($this -> input -> post('motivo')),
                    'observaciones' => trim($this -> input -> post('observaciones')),
                    'a_quien_visita' => trim($this -> input -> post('a_quien')),
                    'procedencia' => trim($this -> input -> post('procedencia')),
                    'fecha_ingreso' => date_format($fecha_ingreso, 'Y-m-d H:i:s') ,
                    'telefono'=> trim($this -> input ->  post('telefono')),
                    'status' => $this -> input -> post('estatus'),
                    'historial' => $ahora . ' USUARIO Modificó los datos del registro. WAPP',
                    'relevante' => $this -> input -> post('relevante'),
                     );

      $this -> programadas_model -> insertar($datos);

    }
   }


public function actualizar_programada(){
    ini_set('date.timezone','America/Mexico_City'); 
    $ahora =  date('d/m/Y H:i:s');

    $this -> form_validation -> set_rules('nombre','nombre','required|strtoupper');
    $this -> form_validation -> set_rules('paterno','apellido_pat','required|strtoupper');
    $this -> form_validation -> set_rules('materno','apellido_mat','required|strtoupper');
    $this -> form_validation -> set_rules('procedencia','procedencia','required|strtoupper');
    $this -> form_validation -> set_rules('motivo','motivo','required|strtoupper');
    $this -> form_validation -> set_rules('a_quien','a_quien_visita','required|strtoupper');
    $this -> form_validation -> set_rules('observaciones','observaciones','strtoupper');
    $this -> form_validation -> set_rules('telefono','telefono','strtoupper');
    $this -> form_validation -> set_rules('relevante','relevante','strtoupper');

  $fecha_ingreso = date_create_from_format('d/m/Y H:i:s', $this -> input -> post('fecha_entrada'));


    if($this -> form_validation -> run() == FALSE ){
        
        $this->load->view('formulario_visitas_modificar', $datos);
    }else{
        $gafete = $this -> input -> post('gafete');
        $id = $this -> input -> post('folio');
       $datos = array(
                    'Id' => $this -> input -> post('folio'),
                    'nombre' => trim($this -> input -> post('nombre')),
                    'apellido_pat' => trim($this -> input -> post('paterno')),
                    'apellido_mat' => trim($this -> input -> post('materno')),
                    'motivo' => trim($this -> input -> post('motivo')),
                    'observaciones' => trim($this -> input -> post('observaciones')),
                    'a_quien_visita' => trim($this -> input -> post('a_quien')),
                    'procedencia' => trim($this -> input -> post('procedencia')),
                    'fecha_ingreso' => date_format($fecha_ingreso, 'Y-m-d H:i:s'),
                    'telefono'=> trim($this -> input ->  post('telefono')),
                    'status' => $this -> input -> post('estatus'),
                    'historial' => $ahora . ' USUARIO Modificó los datos del registro. WAPP',
                    'relevante' => $this -> input -> post('relevante')
                     );


    

       $this -> programadas_model -> actualizar_datos_programadas($datos, $id);
    }
   }

   public function programada_eliminar($id){
    if ($this->session->userdata('is_authenticated') == FALSE || $this-> session->userdata('permisos') == 'PUERTA') {
                    redirect('');
        } else {
     
     $this -> programadas_model -> eliminar($id);
     
    }
   }

   public function visitas1_page()
     {

          // Datatables Variables
          $draw = intval($this -> input -> get("draw"));
          $start = intval($this -> input-> get("start"));
          $length = intval($this -> input-> get("length"));


          $visitas = $this -> visitas_model -> get_visitas();

          $data = array();

          foreach($visitas->result() as $r) {

               $data[] = array(
                    $r->Id,
                    $r->nombre_visitante,
                    $r->apellido_pat_visitante,
                    $r->apellido_mat_visitante,
                    $r->procedencia,
                    $r->motivo_visita,
                    $r->a_quien_visita,
                    $r->fecha_ingreso,
                    $r->fecha_egreso,
                    $r->gafete,
                    $r->status
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

     public function programadas_page(){

     $columns = array( 
                           0 =>'Id', 
                           1 =>'nombre',
                           2 =>'apellido_pat',  
                           3 =>'apellido_mat',
                           4 =>'procedencia',                       
                           5 =>'motivo',                       
                           6 =>'a_quien_visita',                       
                           7 =>'fecha_ingreso',
                           8 =>'telefono',
                           9 =>'status',
                           10 =>'observaciones',
                           11 =>'relevante',

                      );

    $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  
        $totalData = $this-> programadas_model->allposts_count();
            
        $totalFiltered = $totalData; 
            
        if(empty($this->input->post('search')['value']))
        {            
            $posts = $this-> programadas_model->allposts($limit,$start,$order,$dir);
           
        }
        else {
            $search = $this->input->post('search')['value']; 

            $posts =  $this-> programadas_model->posts_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this-> programadas_model->posts_search_count($search);
        }

        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
               $nestedData['Id'] = $post->Id;
               $nestedData['nombre'] = $post->nombre;
               $nestedData['apellido_pat'] = $post->apellido_pat;
               $nestedData['apellido_mat'] = $post->apellido_mat;
               $nestedData['procedencia'] = $post->procedencia;
               $nestedData['motivo'] = $post->motivo;
               $nestedData['a_quien_visita'] = $post->a_quien_visita;
               $nestedData['fecha_ingreso'] = $post->fecha_ingreso;
               $nestedData['telefono'] = $post->telefono;
               $nestedData['status'] = $post->status;
               $nestedData['observaciones'] = $post->observaciones;
               $nestedData['relevante'] = $post->relevante;
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

public function cancelar(){ 
  $fecha = date('Y').'-'.date('m').'-'.(date('d')-1).' 23:59:59';
      $this-> programadas_model-> cancelar_programadas($fecha);
  }

}