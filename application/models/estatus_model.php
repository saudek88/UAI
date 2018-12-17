<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Estatus_model extends CI_Model {
  function __construct()
  {
    parent::__construct();
  }
  
  function get_estatus($tipo)
  {

    $this->db->select('status');
    $this->db->where('tipo',$tipo);
    $query= $this->db->get('lista_status');
    return $query->result();
 
  }

  function get_lista_estatus(){
    $query = $this-> db-> get('lista_status');
    return $query;
  }

   function get_ultimo_registro(){

   $this->db->select('Id');
   $this->db->from('lista_status');
   $this->db->order_by('Id', 'desc');
   $this->db->limit(1);
   $ultimo = $this->db->get();
   return $ultimo->row();
    //$ultimo = $this->db->get('visitas' ,1 , 0); # Set Limit
    //return $ultimo->result();
  }

  function insertar($datos){
    $this -> db -> insert('lista_status',$datos);
  }

  function get_datos_estatus($id){
    $this->db->where('Id', $id);
    $query = $this->db->get('lista_status');
    $fila = $query -> row();
    return $fila;
  }

   function actualizar_datos_estatus($datos , $id){
      $this->db->set($datos);
      $this->db->where('Id', $id);
      $this->db->update('lista_status');
  }

    function eliminar($id){
    $this->db->where('Id', $id);
    $this->db->delete('lista_status');
    if($this->db->affected_rows() > 0)
      {
    // Code here after successful insert
    return true; // to the controller
      }
  }

}
