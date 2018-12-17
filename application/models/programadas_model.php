<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Programadas_model extends CI_Model {
  function __construct()
  {
    parent::__construct();
  }
  
  function get_programadas()
  {
    $query = $this->db->get('programadas');
    return $query;
  }
 
  function get_total_programadas(){
    return $this->db->count_all('programadas');
  }

  function get_ultimo_registro(){

   $this->db->select('Id');
   $this->db->from('programadas');
   $this->db->order_by('Id', 'desc');
   $this->db->limit(1);
   $ultimo = $this->db->get();
   return $ultimo->row();
    //$ultimo = $this->db->get('visitas' ,1 , 0); # Set Limit
    //return $ultimo->result();
  }

  function insertar($datos){
 $this -> db -> insert('programadas',$datos);
     
     if($this->db->affected_rows() > 0)
      {
    // Code here after successful insert
    return true; // to the controller
      }
  }

  function get_datos_programada($id){
    $this->db->where('Id', $id);
    $query = $this->db->get('programadas');
    $fila = $query -> row();
    return $fila;
  }


  function actualizar_datos_programadas($datos , $id){
      $this->db->set($datos);
      $this->db->where('Id', $id);
      $this->db->update('programadas');
      if($this->db->affected_rows() > 0)
      {
    // Code here after successful insert
    return true; // to the controller
      }
  }

  function eliminar($id){
    $this->db->where('Id', $id);
    $this->db->delete('programadas');
    if($this->db->affected_rows() > 0)
      {
    // Code here after successful insert
    return true; // to the controller
      }
  }




function get_lista_general(){
    $query = $this-> db-> get('programadas');
    return $query;
  }

/*************funciones para el server side ****************/
  function allposts_count()
    {   
        $query = $this
                ->db
                ->get('programadas');
    
        return $query->num_rows();  

    }
    
    function allposts($limit,$start,$col,$dir)
    {   
       $query = $this
                ->db
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('programadas');
        
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
                ->or_like('nombre',$search)
                ->or_like('apellido_pat',$search)
                ->or_like('apellido_mat',$search)
                ->or_like('procedencia',$search)
                ->or_like('motivo',$search)
                ->or_like('a_quien_visita',$search)
                ->or_like('fecha_ingreso',$search)
                ->or_like('telefono',$search)
                ->or_like('status',$search)
                ->or_like('observaciones',$search)
                ->or_like('relevante',$search)
                ->or_like("CONCAT(nombre, ' ', apellido_pat, ' ', apellido_mat)", $this->db->escape_like_str($search))
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('programadas');
        
       
        if($query->num_rows()>0)
        {
            return $query->result();  
        }
        else
        {
            return null;
        }
    }

    function posts_search_count($search)
    {
        $query = $this
                ->db
                ->like('Id',$search)
                ->or_like('nombre',$search)
                ->or_like('apellido_pat',$search)
                ->or_like('apellido_mat',$search)
                ->or_like('procedencia',$search)
                ->or_like('motivo',$search)
                ->or_like('a_quien_visita',$search)
                ->or_like('fecha_ingreso',$search)
                ->or_like('telefono',$search)
                ->or_like('status',$search)
                ->or_like('observaciones',$search)
                ->or_like('relevante',$search)
                ->or_like("CONCAT(nombre, ' ', apellido_pat, ' ', apellido_mat)", $this->db->escape_like_str($search))
                ->get('programadas');
    
        return $query->num_rows();
    } 



     function allposts_count_visitas()
    {   
        $this->db->where('status', 'PROGRAMADA');
        $query = $this
                ->db
                ->get('programadas');
    
        return $query->num_rows();  

    }

    function allposts_visitas($limit,$start,$col,$dir)
    {   
      $this->db->where('status', 'PROGRAMADA');
       $query = $this
                ->db
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('programadas');
        
        if($query->num_rows()>0)
        {
            return $query->result(); 
        }
        else
        {
            return null;
        }
        
    }

     function posts_search_visitas($limit,$start,$search,$col,$dir)
    {
        
       /* $query = $this
                ->db
                ->where('status', 'PROGRAMADA')
                ->like('Id',$search)
                ->or_like('nombre',$search)
                ->or_like('apellido_pat',$search)
                ->or_like('apellido_mat',$search)
                ->or_like('procedencia',$search)
                ->or_like('motivo',$search)
                ->or_like('a_quien_visita',$search)
                ->or_like('fecha_ingreso',$search)
                ->or_like('telefono',$search)
                ->or_like('status',$search)
                ->or_like('observaciones',$search)
                ->or_like('relevante',$search)
                ->or_like("CONCAT(nombre, ' ', apellido_pat, ' ', apellido_mat)", $this->db->escape_like_str($search))
                //->where( 'status', 'PROGRAMADA')
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('programadas');*/

                $query = $this -> db -> query("
                          SELECT * FROM `programadas` WHERE `status` = 'PROGRAMADA' 
                          AND (Id LIKE '%".$search."%' ESCAPE '!' 
                          OR nombre LIKE '%".$search."%' ESCAPE '!' 
                          OR apellido_pat LIKE '%".$search."%' ESCAPE '!' 
                          OR apellido_mat LIKE '%".$search."%' ESCAPE '!' 
                          OR procedencia LIKE '%".$search."%' ESCAPE '!' 
                          OR motivo LIKE '%".$search."%' ESCAPE '!' 
                          OR a_quien_visita LIKE '%".$search."%' ESCAPE '!' 
                          OR fecha_ingreso LIKE '%".$search."%' ESCAPE '!' 
                          OR telefono LIKE '%".$search."%' ESCAPE '!' 
                          OR status LIKE '%".$search."%' ESCAPE '!' 
                          OR observaciones LIKE '%".$search."%' ESCAPE '!' 
                          OR relevante LIKE '%".$search."%' ESCAPE '!' 
                          OR CONCAT(nombre, ' ', apellido_pat, ' ', apellido_mat) LIKE '%".$search."%' ESCAPE '!')
                          ORDER BY `Id` DESC LIMIT 5
                  ");
        
         //print_r($this->db->last_query());
      //exit;
       
        if($query->num_rows()>0)
        {
            return $query->result();  
        }
        else
        {
            return null;
        }


    }
   
   function posts_search_count_visitas($search)
    {
        
       /* $query = $this
                ->db
                ->where('status', 'PROGRAMADA')
                ->like('Id',$search)
                ->or_like('nombre',$search)
                ->or_like('apellido_pat',$search)
                ->or_like('apellido_mat',$search)
                ->or_like('procedencia',$search)
                ->or_like('motivo',$search)
                ->or_like('a_quien_visita',$search)
                ->or_like('fecha_ingreso',$search)
                ->or_like('telefono',$search)
                ->or_like('status',$search)
                ->or_like('observaciones',$search)
                ->or_like('relevante',$search)
                ->or_like("CONCAT(nombre, ' ', apellido_pat, ' ', apellido_mat)", $this->db->escape_like_str($search))
                ->get('programadas');*/
    
    $query = $this -> db -> query("
                          SELECT * FROM `programadas` WHERE `status` = 'PROGRAMADA' 
                          AND (Id LIKE '%".$search."%' ESCAPE '!' 
                          OR nombre LIKE '%".$search."%' ESCAPE '!' 
                          OR apellido_pat LIKE '%".$search."%' ESCAPE '!' 
                          OR apellido_mat LIKE '%".$search."%' ESCAPE '!' 
                          OR procedencia LIKE '%".$search."%' ESCAPE '!' 
                          OR motivo LIKE '%".$search."%' ESCAPE '!' 
                          OR a_quien_visita LIKE '%".$search."%' ESCAPE '!' 
                          OR fecha_ingreso LIKE '%".$search."%' ESCAPE '!' 
                          OR telefono LIKE '%".$search."%' ESCAPE '!' 
                          OR status LIKE '%".$search."%' ESCAPE '!' 
                          OR observaciones LIKE '%".$search."%' ESCAPE '!' 
                          OR relevante LIKE '%".$search."%' ESCAPE '!' 
                          OR CONCAT(nombre, ' ', apellido_pat, ' ', apellido_mat) LIKE '%".$search."%' ESCAPE '!')
                          ORDER BY `Id` DESC LIMIT 5
                  ");
        return $query->num_rows();
    } 
/*************funciones para el server side ****************/

function fecha_ingreso(){
  $this->db->select('fecha_ingreso');
   $this->db->from('programadas');
   $this->db->order_by('fecha_ingreso', 'desc');
   $this->db->limit(1);
   $ultimo = $this->db->get();
   return $ultimo-> row();
}

function get_ultimo_registro_fecha(){

   $this->db->from('programadas');
   $this->db->order_by('fecha_ingreso', 'desc');
   $this->db->limit(1);
   $ultimo = $this->db->get();
   return $ultimo->result();
    //$ultimo = $this->db->get('visitas' ,1 , 0); # Set Limit
    //return $ultimo->result();
  }

  function cambiar_status_programada($id){
      $datos = array('status' => 'EN VISITA');
      $this->db->where('Id', $id);
      $this->db->update('programadas',$datos);
      if($this->db->affected_rows() > 0)
      {
    // Code here after successful insert
    return true; // to the controller
      }

  }

  function cancelar_programadas($fecha){
    $this->db->set('status', 'CANCELADO');
      $this->db->where('fecha_ingreso <=', $fecha);
      $this->db->update('programadas');
      if($this->db->affected_rows() > 0)
      {
    // Code here after successful insert
    return true; // to the controller
      }
  }
}
