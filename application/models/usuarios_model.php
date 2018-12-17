<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {
  function __construct()
  {
    parent::__construct();
  }
  
  function get_estatus()
  {

    $this->db->select('status');
    $this->db->where('tipo','1');
    $query= $this->db->get('lista_status');
    return $query->result();
 
  }

  function get_lista_usuarios(){
    $query = $this-> db-> get('usuarios');
    return $query;
  }

   function get_ultimo_registro(){

   $this->db->select('Id');
   $this->db->from('usuarios');
   $this->db->order_by('Id', 'desc');
   $this->db->limit(1);
   $ultimo = $this->db->get();
   return $ultimo->row();
    //$ultimo = $this->db->get('visitas' ,1 , 0); # Set Limit
    //return $ultimo->result();
  }

  function insertar($datos){
    $this -> db -> insert('usuarios',$datos);
  }

  function get_datos_usuario($id){
    $this->db->where('Id', $id);
    $query = $this->db->get('usuarios');
    $fila = $query -> row();
    return $fila;
  }

function reset_pass($id,$new_pass){
  $this->db->set('CONTRASENA', $new_pass);
  $this->db->where('Id', $id);
  $this->db->update('usuarios');
}


   function actualizar_datos_usuario($datos , $id){
      $this->db->set($datos);
      $this->db->where('Id', $id);
      $this->db->update('usuarios');
  }


function comprobar_usuario($usuario){
    $this->db->where('USUARIO', $usuario);
    $query = $this->db->get('usuarios');
    $fila = $query -> num_rows();
    return $fila;
  }


  function eliminar($id){
    $this->db->where('Id', $id);
    $this->db->delete('usuarios');
    if($this->db->affected_rows() > 0)
      {
    // Code here after successful insert
    return true; // to the controller
      }
  }
}
