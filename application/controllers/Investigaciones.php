<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Investigaciones extends CI_Controller {
  
 
  public function __construct()
    {
    parent::__construct();
    $this -> load -> model(array('visitas_model', 'estatus_model','gafetes_model', 'programadas_model','funcionarios_model'));
    $this -> load -> library('pagination');
    $this -> load -> helper('url');
    }
  public function index()
  {   

        if ($this->session->userdata('is_authenticated') == FALSE) {
                    redirect('');
        } else {
        $datos['visitas'] = $this -> visitas_model-> get_visitas();  
        $datos['titulo'] = 'Investigación';
        $datos['visita'] = 'Investigación';
        $datos['btn_nuevo'] = 'Nueva registro';
        $datos['agregado'] = 'false';
        $this -> load -> view('index',$datos);
        $this -> load -> view('visitas', $datos);
        }
  }

  public function nuevo_registro(){
    if ($this-> session->userdata('is_authenticated') == FALSE) {
                    redirect('');
      } else {
      $datos['titulo'] = 'Nueva Investigación';
      $this -> load -> helper('form');
      $this -> load -> view('index',$datos);
      $datos['estatus'] = $this-> estatus_model->get_estatus('1');
      $datos['gafetes'] = $this-> gafetes_model->get_gafetes();
      $datos['a_quien'] = $this-> funcionarios_model-> get_funcionarios();

      if($this-> visitas_model->get_ultimo_registro()){  
          $datos['ultimo_id'] = $this-> visitas_model->get_ultimo_registro() -> Id;
      }else{
         $datos['ultimo_id'] = 0;
      }
      $this->load->view('formulario_visitas', $datos);
    }
  }

public function nueva_visita_reingreso($id){
    if ($this-> session->userdata('is_authenticated') == FALSE) {
                    redirect('');
      } else {
      $datos['titulo'] = 'Nueva Visita';
      $this -> load -> helper('form');
      $this -> load -> view('index',$datos);
      $datos['estatus'] = $this->estatus_model->get_estatus('1');
      $datos['gafetes'] = $this->gafetes_model->get_gafetes();
      

      if($this-> visitas_model->get_ultimo_registro()){  
          $datos['ultimo_id'] = $this-> visitas_model->get_ultimo_registro() -> Id;
      }else{
         $datos['ultimo_id'] = 0;
      }
       $datos['visita'] = $this-> visitas_model -> get_datos_visita($id);
       $datos['a_quien'] = $this-> funcionarios_model-> get_funcionarios();
     ///----------para otro tipo de llenado-----------///
     // $datos['reingreso'] =  $this -> input -> post('nombre');
      //$datos['nombre'] = $this -> input -> post('nombre');
    //$datos['reingreso'] = json_decode($_POST['encapsulado']);
      ///----------para otro tipo de llenado-----------///

      $this->load->view('formulario_visitas_reingreso', $datos);

    }
  }

  public function programada_visita($id){
      if ($this-> session->userdata('is_authenticated') == FALSE) {
                    redirect('');
      } else {
      $datos['titulo'] = 'Nueva Visita';
      $this -> load -> helper('form');
      $this -> load -> view('index',$datos);
      $datos['estatus'] = $this->estatus_model->get_estatus('1');
      $datos['gafetes'] = $this->gafetes_model->get_gafetes();
      

      if($this-> visitas_model->get_ultimo_registro()){  
          $datos['ultimo_id'] = $this-> visitas_model->get_ultimo_registro() -> Id;
      }else{
         $datos['ultimo_id'] = 0;
      }

      $datos['id_programada'] = $id;


      $datos['visita_programada'] = $this -> programadas_model -> get_datos_programada($id);

      $this->load->view('formulario_programadas_a_visitas', $datos);
      }

  }

    public function modificar_visita($id){
      if ($this->session->userdata('is_authenticated') == FALSE) {
                    redirect('');
        } else {
    $datos['titulo'] = 'Modificar Visita';
    $this -> load -> helper('form');
    $this -> load -> view('index',$datos);
    $datos['estatus'] = $this->estatus_model->get_estatus('1');
    $datos['gafetes'] = $this->gafetes_model->get_gafetes();
    $datos['ultimo_id'] = $id;
    $datos['visita'] = $this-> visitas_model -> get_datos_visita($id);
    $datos['a_quien'] = $this-> funcionarios_model-> get_funcionarios();
    
    if($datos['visita']->status === 'ENTREGÓ GAFETE'){
      $datos['deshabilitar'] = 'disabled';
     
    }else{
      $datos['deshabilitar'] = '';
    }


    $this->load->view('formulario_visitas_modificar', $datos);
    }
  }

  public function agregar_visita(){
    ini_set('date.timezone','America/Mexico_City'); 
    $ahora =  date('d/m/Y H:i:s');

    $this -> form_validation -> set_rules('nombre','nombre_visitante','required|strtoupper');
    $this -> form_validation -> set_rules('paterno','apellido_pat_visitante','required|strtoupper');
    $this -> form_validation -> set_rules('materno','apellido_mat_visitante','required|strtoupper');
    $this -> form_validation -> set_rules('procedencia','procedencia','required|strtoupper');
    $this -> form_validation -> set_rules('motivo','motivo_visita','required|strtoupper');
    $this -> form_validation -> set_rules('a_quien','a_quien_visita','required|strtoupper');
    $this -> form_validation -> set_rules('gafete','gafete','required|strtoupper');
    $this -> form_validation -> set_rules('observaciones','observaciones','strtoupper');
    $this -> form_validation -> set_rules('placa','vehiculo_placa','strtoupper');
    $this -> form_validation -> set_rules('marca','vehiculo_marca','strtoupper');
    $this -> form_validation -> set_rules('modelo','vehiculo_modelo','strtoupper');
    $this -> form_validation -> set_rules('tipo','vehiculo_tipo','strtoupper');
    $this -> form_validation -> set_rules('armamento','armamento','strtoupper');
    $this -> form_validation -> set_rules('pertenencias','pertenencias','strtoupper');
    $this -> form_validation -> set_rules('telefono','telefono','strtoupper');
    $this -> form_validation -> set_rules('relevante','relevante','strtoupper');


    $fecha_ingreso = date_create_from_format('d/m/Y H:i:s', $this -> input -> post('fecha_entrada'));

    if($this -> form_validation -> run() == FALSE ){
        $datos['ultimo_id'] = $this -> visitas_model -> get_ultimo_registro();
        $this->load->view('formulario_visitas', $datos);
    }else{
        $gafete = $this -> input -> post('gafete');
       $datos = array(
                    'Id' => $this -> input -> post('folio'),
                    'nombre_visitante' => trim($this -> input -> post('nombre')),
                    'apellido_pat_visitante' => trim($this -> input -> post('paterno')),
                    'apellido_mat_visitante' => trim($this -> input -> post('materno')),
                    'procedencia' => trim($this -> input -> post('procedencia')),
                    'motivo_visita' => trim($this -> input -> post('motivo')),
                    'a_quien_visita' => trim($this -> input -> post('a_quien')),
                    'fecha_ingreso' => date_format($fecha_ingreso, 'Y-m-d H:i:s') ,
                    'gafete' => $this -> input -> post('gafete'),
                    'observaciones' => trim($this -> input -> post('observaciones')),
                    'vehiculo_placa' => trim($this -> input -> post('placa')),
                    'vehiculo_marca' => trim($this -> input -> post('marca')),
                    'vehiculo_modelo' => trim($this -> input -> post('modelo')),
                    'vehiculo_tipo' => trim($this -> input -> post('tipo')),
                    'armamento' => trim($this -> input -> post('armamento')),
                    'pertenencias' => trim($this -> input -> post('pertenencias')),
                    'status' => $this -> input -> post('estatus'),
                    'historial' => $ahora . ' USUARIO Modificó los datos del registro. WAPP',
                    'telefono'=> trim($this -> input ->  post('telefono')),
                    'relevante'=> $this -> input ->  post('relevante'),

                     );
  

      if($this-> input -> post('id_programada') != ''){
        $id_programada = $this -> input -> post('id_programada');
        $this -> programadas_model -> cambiar_status_programada($id_programada);
      }
  
      $this -> visitas_model -> insertar($datos);
       $this -> gafetes_model -> actualizar_gafete($gafete, 'NO');

    }
   }


public function actualizar_visita(){
    ini_set('date.timezone','America/Mexico_City'); 
    $ahora =  date('d/m/Y H:i:s');

    $this -> form_validation -> set_rules('nombre','nombre_visitante','required|strtoupper');
    $this -> form_validation -> set_rules('paterno','apellido_pat_visitante','required|strtoupper');
    $this -> form_validation -> set_rules('materno','apellido_mat_visitante','required|strtoupper');
    $this -> form_validation -> set_rules('procedencia','procedencia','required|strtoupper');
    $this -> form_validation -> set_rules('motivo','motivo_visita','required|strtoupper');
    $this -> form_validation -> set_rules('a_quien','a_quien_visita','required|strtoupper');
    $this -> form_validation -> set_rules('gafete','gafete','required|strtoupper');
    $this -> form_validation -> set_rules('observaciones','observaciones','strtoupper');
    $this -> form_validation -> set_rules('placa','vehiculo_placa','strtoupper');
    $this -> form_validation -> set_rules('marca','vehiculo_marca','strtoupper');
    $this -> form_validation -> set_rules('modelo','vehiculo_modelo','strtoupper');
    $this -> form_validation -> set_rules('tipo','vehiculo_tipo','strtoupper');
    $this -> form_validation -> set_rules('armamento','armamento','strtoupper');
    $this -> form_validation -> set_rules('pertenencias','pertenencias','strtoupper');
    $this -> form_validation -> set_rules('telefono','telefono','strtoupper');
    $this -> form_validation -> set_rules('relevante','relevante','strtoupper');


  $fecha_ingreso = date_create_from_format('d/m/Y H:i:s', $this -> input -> post('fecha_entrada'));
  $fecha_egreso = date_create_from_format('d/m/Y H:i:s', $this -> input -> post('fecha_salida'));

  $aux_fecha_egreso = date_format( $fecha_egreso, 'Y-m-d H:i:s');

  if($aux_fecha_egreso == null){
      $aux_fecha_egreso = NULL;
  }


 if($this -> form_validation -> run() == FALSE ){
        
        $this->load->view('formulario_visitas_modificar', $datos);
    }else{
        $gafete = $this -> input -> post('gafete');
        $id = $this -> input -> post('folio');
       $datos = array(
                    'Id' => $this -> input -> post('folio'),
                    'nombre_visitante' => trim($this -> input -> post('nombre')),
                    'apellido_pat_visitante' => trim($this -> input -> post('paterno')),
                    'apellido_mat_visitante' => trim($this -> input -> post('materno')),
                    'procedencia' => trim($this -> input -> post('procedencia')),
                    'motivo_visita' => trim($this -> input -> post('motivo')),
                    'a_quien_visita' => trim($this -> input -> post('a_quien')),
                    'fecha_ingreso' => date_format($fecha_ingreso, 'Y-m-d H:i:s')  ,
                    'fecha_egreso' => $aux_fecha_egreso,
                    'gafete' => $this -> input -> post('gafete'),
                    'observaciones' => trim($this -> input -> post('observaciones')),
                    'vehiculo_placa' => trim($this -> input -> post('placa')),
                    'vehiculo_marca' => trim($this -> input -> post('marca')),
                    'vehiculo_modelo' => trim($this -> input -> post('modelo')),
                    'vehiculo_tipo' => trim($this -> input -> post('tipo')),
                    'armamento' => trim($this -> input -> post('armamento')),
                    'pertenencias' => trim($this -> input -> post('pertenencias')),
                    'status' => $this -> input -> post('estatus'),
                    'historial' => $ahora . ' USUARIO Modificó los datos del registro. WAPP',
                    'telefono'=> trim($this -> input ->  post('telefono')),
                    'relevante'=> $this -> input ->  post('relevante')
                     );

    $gafete_aux = $this -> visitas_model -> get_gafete_visita($id)-> gafete;
        if($this -> input -> post('estatus') == "ENTREGÓ GAFETE"){
          $this -> gafetes_model -> actualizar_gafete($gafete, 'SI');
       }

        if( $gafete_aux != $gafete) {
            $this -> gafetes_model -> actualizar_gafete($gafete_aux, 'SI');
            $this -> gafetes_model -> actualizar_gafete($gafete, 'NO');
        }

    

       $this -> visitas_model -> actualizar_datos_visitas($datos, $id);

    }
   }

   public function visita_eliminar($id){
    if ($this->session->userdata('is_authenticated') == FALSE) {
                    redirect('');
        } else {
     $gafete = $this -> visitas_model -> get_gafete_visita($id)-> gafete;
     $this -> gafetes_model -> actualizar_gafete($gafete, 'SI');
     $this -> visitas_model -> eliminar($id);
     
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

    public function validateDate($date, $format = 'Y-m-d H:i:s'){
      $d = DateTime::createFromFormat($format, $date);
      return $d && $d->format($format) == $date;
    }

     public function visitas_page(){

      if(!empty($this -> input -> post('fecha_inicial')) && !empty($this -> input -> post('fecha_final'))){
          $aux_from = date_create_from_format('d/m/Y H:i:s', $this -> input -> post('fecha_inicial'));
          $aux_to = date_create_from_format('d/m/Y H:i:s', $this -> input -> post('fecha_final'));

          $from = date_format($aux_from, 'Y-m-d H:i:s');
          $to = date_format($aux_to, 'Y-m-d H:i:s');

      }
      
     $columns = array( 
                           0 =>'Id', 
                           1 =>'nombre_visitante',
                           2 =>'apellido_pat_visitante',  
                           3 =>'apellido_mat_visitante',
                           4 =>'procedencia',                       
                           5 =>'motivo_visita',                       
                           6 =>'a_quien_visita',                       
                           7 =>'fecha_ingreso',
                           8 =>'fecha_egreso',
                           9 =>'gafete',
                           10 =>'status',
                           11 =>'vehiculo_placa',
                           12 =>'vehiculo_marca',
                           13 =>'vehiculo_modelo',
                           14 =>'vehiculo_tipo',
                           15 =>'relevante',
                           16 =>'reingreso',                          

                      );

    $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  
        $totalData = $this-> visitas_model->allposts_count();
            
        $totalFiltered = $totalData; 
        $busqueda = $this->input->post('search')['value'];
        if($this ->validateDate($busqueda, 'd/m/Y')){
          //echo ' SI ES UNA FECHA';
         // echo ' La busqueda es '.$busqueda;
           $busqueda_fecha = date_create_from_format('d/m/Y', $busqueda);
          // echo ' busqueda_fecha: '.$busqueda_fecha;
           $busqueda = date_format($busqueda_fecha, 'Y-m-d');
        }        
            
        if(empty($busqueda) && empty($from) && empty($to))
        {            
            $posts = $this-> visitas_model->allposts($limit,$start,$order,$dir);
           
        }elseif (!empty($from) && !empty($to)) {
            $posts =  $this-> visitas_model->posts_search_by_range($limit,$start,$from,$to,$order,$dir);
            $totalFiltered = $this-> visitas_model->posts_search_count_by_range($from,$to);
           
        }
        elseif(!empty($busqueda)) {
            $search = $busqueda; 

            $posts =  $this-> visitas_model->posts_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this-> visitas_model->posts_search_count($search);
           
        }

        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
               $nestedData['Id'] = $post->Id;
               $nestedData['nombre_visitante'] = $post->nombre_visitante;
               $nestedData['apellido_pat_visitante'] = $post->apellido_pat_visitante;
               $nestedData['apellido_mat_visitante'] = $post->apellido_mat_visitante;
               $nestedData['procedencia'] = $post->procedencia;
               $nestedData['motivo_visita'] = $post->motivo_visita;
               $nestedData['a_quien_visita'] = $post->a_quien_visita;
               $nestedData['fecha_ingreso'] = $post->fecha_ingreso;
               $nestedData['fecha_egreso'] = $post->fecha_egreso;
               $nestedData['gafete'] = $post->gafete;
               $nestedData['status'] = $post->status;
               $nestedData['vehiculo_placa'] = $post->vehiculo_placa;
               $nestedData['vehiculo_marca'] = $post->vehiculo_marca;
               $nestedData['vehiculo_modelo'] = $post->vehiculo_modelo;
               $nestedData['vehiculo_tipo'] = $post->vehiculo_tipo;
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
  
        $totalData = $this-> programadas_model-> allposts_count_visitas();
            
        $totalFiltered = $totalData; 
            
        if(empty($this->input->post('search')['value']))
        {            
            $posts = $this-> programadas_model-> allposts_visitas($limit,$start,$order,$dir);
           
        }
        else {
            $search = $this->input->post('search')['value']; 

            $posts =  $this-> programadas_model-> posts_search_visitas($limit,$start,$search,$order,$dir);

            $totalFiltered = $this-> programadas_model-> posts_search_count_visitas($search);
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

}