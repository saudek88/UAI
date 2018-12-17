<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Visitas_model extends CI_Model {
  function __construct()
  {
    parent::__construct();
  }
  
  function get_visitas()
  {
    $query = $this->db->get('visitas');
    return $query;
  }
 
  function get_total_visitas(){
    return $this->db->count_all('visitas');
  }

  function get_ultimo_registro(){

   $this->db->select('Id');
   $this->db->from('visitas');
   $this->db->order_by('Id', 'desc');
   $this->db->limit(1);
   $ultimo = $this->db->get();
   return $ultimo->row();
    //$ultimo = $this->db->get('visitas' ,1 , 0); # Set Limit
    //return $ultimo->result();
  }

  function insertar($datos){
 $this -> db -> insert('visitas',$datos);
     
     if($this->db->affected_rows() > 0)
      {
    // Code here after successful insert
    return true; // to the controller
      }
  }

  function get_datos_visita($id){
    $this->db->where('Id', $id);
    $query = $this->db->get('visitas');
    $fila = $query -> row();
    return $fila;
  }

  function get_gafete_visita($id){
    $this->db->select('gafete');
    $this->db->where('Id', $id);
    $query = $this->db->get('visitas');
    $fila = $query -> row();
    return $fila;
  }

  function actualizar_datos_visitas($datos , $id){
      $this->db->set($datos);
      $this->db->where('Id', $id);
      $this->db->update('visitas');
      if($this->db->affected_rows() > 0)
      {
    // Code here after successful insert
    return true; // to the controller
      }
  }

  function eliminar($id){
    $this->db->where('Id', $id);
    $this->db->delete('visitas');
    if($this->db->affected_rows() > 0)
      {
    // Code here after successful insert
    return true; // to the controller
      }
  }




function get_lista_general(){
    $query = $this-> db-> get('visitas');
    return $query;
  }

/*************funciones para el server side ****************/
  function allposts_count()
    {   
        $query = $this
                ->db
                ->get('visitas');
    
        return $query->num_rows();  

    }
    
    function allposts($limit,$start,$col,$dir)
    {   
       $query = $this
                ->db
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('visitas');
        
        if($query->num_rows()>0)
        {
            return $query->result(); 
        }
        else
        {
            return null;
        }
        
    }
   
    function posts_search($limit,$start,$search,$col,$dir)
    { 
        $query = $this
                ->db
                ->like('Id',$search)
                ->or_like('nombre_visitante',$search)
                ->or_like('apellido_pat_visitante',$search)
                ->or_like('apellido_mat_visitante',$search)
                ->or_like('procedencia',$search)
                ->or_like('motivo_visita',$search)
                ->or_like('a_quien_visita',$search)
                ->or_like('fecha_ingreso',$search)
                ->or_like('fecha_egreso',$search)
                ->or_like('gafete',$search)
                ->or_like('status',$search)
                ->or_like('vehiculo_placa',$search)
                ->or_like('vehiculo_marca',$search)
                ->or_like('vehiculo_modelo',$search)
                ->or_like('vehiculo_tipo',$search)
                ->or_like("CONCAT(nombre_visitante, ' ', apellido_pat_visitante, ' ', apellido_mat_visitante)", $this->db->escape_like_str($search))
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('visitas');
        
       
        if($query->num_rows()>0)
        {
            return $query->result();  
        }
        else
        {
            return null;
        }
    }

    function posts_search_by_range($limit,$start,$from,$to,$col,$dir)
    { 
        $query = $this
                ->db
                ->where('fecha_ingreso >=', $from)
                ->where('fecha_ingreso <=', $to)
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('visitas');
        
       
        if($query->num_rows()>0)
        {
            return $query->result();  
        }
        else
        {
            return null;
        }
    }

    function posts_search_count_by_range($from, $to)
    {
        $query = $this
                ->db
                ->where('fecha_ingreso >=', $from)
                ->where('fecha_ingreso <=', $to)
                ->get('visitas');
    
        return $query->num_rows();
    } 


    function posts_search_count($search)
    {
        $query = $this
                ->db
                ->like('Id',$search)
                ->or_like('nombre_visitante',$search)
                ->or_like('apellido_pat_visitante',$search)
                ->or_like('apellido_mat_visitante',$search)
                ->or_like('procedencia',$search)
                ->or_like('motivo_visita',$search)
                ->or_like('a_quien_visita',$search)
                ->or_like('fecha_ingreso',$search)
                ->or_like('fecha_egreso',$search)
                ->or_like('gafete',$search)
                ->or_like('status',$search)
                ->or_like('vehiculo_placa',$search)
                ->or_like('vehiculo_marca',$search)
                ->or_like('vehiculo_modelo',$search)
                ->or_like('vehiculo_tipo',$search)
                ->or_like("CONCAT(nombre_visitante, ' ', apellido_pat_visitante, ' ', apellido_mat_visitante)", $this->db->escape_like_str($search))
                ->get('visitas');
    
        return $query->num_rows();
    } 
/*************funciones para el server side ****************/

  function fecha_ingreso(){
    $this->db->select('fecha_ingreso');
     $this->db->from('visitas');
     $this->db->order_by('fecha_ingreso', 'desc');
     $this->db->limit(1);
     $ultimo = $this->db->get();
     return $ultimo-> row();
  }

  function get_ultimo_registro_fecha(){

     $this->db->from('visitas');
     $this->db->order_by('fecha_ingreso', 'desc');
     $this->db->limit(1);
     $ultimo = $this->db->get();
     return $ultimo->result();
      //$ultimo = $this->db->get('visitas' ,1 , 0); # Set Limit
      //return $ultimo->result();
    }

  function get_vistas_rango_fechas($fi, $ff){

              
                $query = $this
                ->db
                ->where('fecha_ingreso >=', $fi)
                ->where('fecha_ingreso <=', $ff)
                ->where('relevante = "1"')               
                ->get('visitas');
                return $query->result();      
        
  }

}
