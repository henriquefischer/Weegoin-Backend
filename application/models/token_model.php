<?php 

class Token_model extends CI_Model {

	
	public function is_token_valid($token)
	{
            $this->load->database();
            $sql = "SELECT * FROM `Users` WHERE `token` = ?;";
            $query = $this->db->query($sql,array($token));
            if($query->num_rows()>0){
                return TRUE;
            }
            return FALSE;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */