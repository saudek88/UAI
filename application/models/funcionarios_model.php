<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Funcionarios_model extends CI_Model {
  function __construct()
  {
    parent::__construct();
  }

 function get_funcionarios()
  {
    $query = $this->db->get('lista_funcionarios');
    return $query;
  }

  function insertar($datos){
    $this -> db -> insert('lista_funcionarios',$datos);
     
  }

  function get_ultimo_registro(){

   $this->db->select('Id');
   $this->db->from('lista_funcionarios');
   $this->db->order_by('Id', 'desc');
   $this->db->limit(1);
   $ultimo = $this->db->get();
   return $ultimo->row();
    //$ultimo = $this->db->get('visitas' ,1 , 0); # Set Limit
    //return $ultimo->result();
  }

  function get_datos_funcionario($id){
    $this->db->where('Id', $id);
    $query = $this->db->get('lista_funcionarios');
    $fila = $query -> row();
    return $fila;
  }


  function actualizar_datos_funcionario($datos , $id){
      $this->db->set($datos);
      $this->db->where('Id', $id);
      $this->db->update('lista_funcionarios');
  }

  function eliminar($id){
    $this->db->where('Id', $id);
    $this->db->delete('lista_funcionarios');
    if($this->db->affected_rows() > 0)
      {
    // Code here after successful insert
    return true; // to the controller
      }
  }


  function get_funcionarios1()
  {
    $query = $this->db->get('lista_funcionarios');
    return $query->result();
  }
}