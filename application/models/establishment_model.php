<?php 

class Establishment_model extends CI_Model {
    
    function __construct()
    {
      // Call the Model constructor
      parent::__construct();
    }
    public function list_establishment()
    {
        $this->load->database();
        if(isset($geolocation)){
           // TO-DO Geolocation Queries
        }else{
            $now = new DateTime('NOW');
            $date = $now->format('Y-m-d H:i:s');
            $next = 1;
            $sql = "SELECT * FROM `Establishment` ORDER BY RAND() LIMIT ?,5;";
            $query = $this->db->query($sql,array($next));
            return $query->result_array();
        }
    }
    
    public function list_single_establishment($idEstablishment){
        $this->load->database();
        $sql = "SELECT * FROM `Establishment` WHERE `idEstablishment` = ?;";
        $query = $this->db->query($sql,array($idEstablishment));
        return $query->result_array();
                
    }
    
    public function list_events_establishment($idEstablishment){
        $this->load->database();
        $sql = "SELECT * FROM `Events` WHERE idEstablishment = ?;";
        $query = $this->db->query($sql,array($idEstablishment));
        return $query->result_array();
    }
}

/* End of file events_model.php */
/* Location: ./application/model/events_model.php */