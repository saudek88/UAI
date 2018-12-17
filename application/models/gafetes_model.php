 <?php defined('BASEPATH') OR exit('No direct script access allowed');

class Gafetes_model extends CI_Model {
  function __construct()
  {
    parent::__construct();
  }
  
  function get_gafetes()
  {

    $this->db->select('gafete');
    $this->db->where('disponible','SI');
    $query= $this->db->get('lista_gafetes');
    return $query->result();
 
  }

  function insertar($datos){
 $this -> db -> insert('lista_gafetes',$datos);
     
  }

  function actualizar_gafete($gafete, $disponilbe){
    $this->db->set('disponible',  $disponilbe);
    $this->db->where('gafete', $gafete);
    $this->db->update('lista_gafetes');
  }

function get_lista_gafetes()
  {
    $query = $this->db->get('lista_gafetes');
    return $query;
  }

  function get_ultimo_registro(){

   $this->db->select('Id');
   $this->db->from('lista_gafetes');
   $this->db->order_by('Id', 'desc');
   $this->db->limit(1);
   $ultimo = $this->db->get();
   return $ultimo->row();
    //$ultimo = $this->db->get('visitas' ,1 , 0); # Set Limit
    //return $ultimo->result();
  }

function get_datos_gafete($id){
    $this->db->where('Id', $id);
    $query = $this->db->get('lista_gafetes');
    $fila = $query -> row();
    return $fila;
  }


  function actualizar_datos_gafete($datos , $id){
      $this->db->set($datos);
      $this->db->where('Id', $id);
      $this->db->update('lista_gafetes');
  }

   function eliminar($id){
    $this->db->where('Id', $id);
    $this->db->delete('lista_gafetes');
    if($this->db->affected_rows() > 0)
      {
    // Code here after successful insert
    return true; // to the controller
      }
  }

}
