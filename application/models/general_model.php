<?php defined('BASEPATH') OR exit('No direct script access allowed');

class General_model extends CI_Model {
  function __construct()
  {
    parent::__construct();
  }
  
  function get_lista_general(){
    $query = $this-> db-> get('listasgenerales');
    return $query;
  }


  function allposts_count()
    {   
        $query = $this
                ->db
                ->get('listasgenerales');
    
        return $query->num_rows();  

    }
    
    function allposts($limit,$start,$col,$dir)
    {   
       $query = $this
                ->db
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('listasgenerales');
        
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
                ->or_like('DESCRIPCION',$search)
                ->or_like('CARGO',$search)
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('listasgenerales');
        
       
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
                ->or_like('DESCRIPCION',$search)
                ->or_like('CARGO',$search)
                ->get('listasgenerales');
    
        return $query->num_rows();
    } 



  function get_datos_general($id){
    $this->db->where('Id', $id);
    $query = $this->db->get('listasgenerales');
    $fila = $query -> row();
    return $fila;
  }

 function actualizar_datos_general($datos , $id){
      $this->db->set($datos);
      $this->db->where('Id', $id);
      $this->db->update('listasgenerales');
  }

}
