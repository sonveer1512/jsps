<?php
if (!defined('BASEPATH')) exit('Hacking Attempt : Get Out of the system ..!');

class Products_model extends CI_Model

{

    public function __construct()

    {

        parent::__construct();
    }
    public function masterData($table,$limit,$offset)
    {
    
    $this->db->select('*');
    $this->db->from($table);
    $this->db->where('flag !=', '2');
    if (!empty($limit)) {
        $this->db->limit($limit, $offset);
      }
    $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    
    }

    public function list_common($table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('flag', '0');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function list_common_where3($table,$where,$id){
		$this->db->select('*');
		$this->db->where($where,$id);
    	$this->db->where('flag','0');
		$this->db->order_by('id','desc');	
 		$this->db->from($table);		
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
    public function delete_products($table,$id,$data)
    {
      $this->db->where('id',$id);
      $this->db->update($table,$data);
      return true;
    
    }
}