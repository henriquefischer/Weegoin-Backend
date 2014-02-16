<?php 

class Events_model extends CI_Model {
    
    function __construct()
    {
      // Call the Model constructor
      parent::__construct();
    }
   /**
    * Retorna 4 eventos a partir de next
     * 
     * @param num next
     * @return token,name,photo
     */
    public function list_events($next)
    {
        $this->load->database();
        if(isset($geolocation)){
           // TO-DO Geolocation Queries
        }else{
            $now = new DateTime('NOW');
            $date = $now->format('Y-m-d H:i:s');
            //$next = 1;
            $sql = "SELECT * FROM `Events` WHERE `date`> ? ORDER BY `date` LIMIT ?,4;";
            $query = $this->db->query($sql,array($date, $next));
            return $query->result_array();
        }
    }
    /**
     * Retorna informações específicas de um evento
     * 
     * @param $idEvent
     * @return token,name,photo
     */
    public function list_single_envent($idEvent){
        $this->load->database();
        $sql = "SELECT * FROM `Events` WHERE `idEvent` = ?;";
        $query = $this->db->query($sql,array($idEvent));
        return $query->result_array();
                
    }
}

/* End of file events_model.php */
/* Location: ./application/model/events_model.php */