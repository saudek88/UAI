<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login_model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }

     
     function get_user($usr, $pwd)
     {
          $sql = "select * from usuarios where USUARIO = '" . $usr . "' and CONTRASENA = '" . $pwd . "'";
          $query = $this->db->query($sql);
          return $query->num_rows();
     }

     function get_datos_usuario($usr){
    $this->db->where('USUARIO', $usr);
    $query = $this->db->get('usuarios');
    $fila = $query -> row();
    return $fila;
  }

}?>