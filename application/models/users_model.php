<?php 

class Users_model extends CI_Model {
    
    public function sing_up($name,$password,$profilePhoto,$idFacebook,$facebookToken)
	{         
            $this->load->database();
            $sql = "INSERT INTO `Users`
            (`name`,
            `password`,
            `profilePhoto`,
            `idFacebook`,
            `facebookToken`)
            VALUES
            (?,
             ?,
             ?,
             ?,
             ?);
            ";
            $query = $this->db->query($sql,array($name,$password,$profilePhoto,$idFacebook,$facebookToken));
            return;
          
        }

        public function user_exist($name,$password,$idFacebook)
	{         
            $this->load->database();
            $sql = "SELECT * FROM `Users` WHERE `name`=? AND `password`=? AND `idFacebook`=?)";
            $query = $this->db->query($sql,array($name,$password,$idFacebook));
            if($query->num_rows() > 0){
                return TRUE;
            }
            return FALSE;
          
        }
        
        public function login($name,$password){
            $this->load->database();
            $sql = "SELECT * FROM `Users` WHERE `name`=? AND `password`=?)";
            $query = $this->db->query($sql,array($name,$password));
            if($query->num_rows() > 0){
                 $token = md5(uniqid(rand(), true));
                  $sql = "UPDATE`Users` SET `token` = ?, `lastLogin` = ?, WHERE `idUsers` = ? AND `idFacebook` = ?;";
                  $query = $this->db->query($sql,array($token,now(),$name,$password));
                  return $token;
            }
            return FALSE;
        }
        
        
        public function edit_user($token,$name,$password,$idFacebook,$facebookToken){
            $this->load->database();
            $sql = "SELECT * FROM `Users` WHERE `name`=? AND `password`=?)";
            $query = $this->db->query($sql,array($name,$password));
            if($query->num_rows() > 0){
                 $token = md5(uniqid(rand(), true));
                  $sql = "UPDATE`Users` SET `token` = ?, `lastLogin` = ?, WHERE `idUsers` = ? AND `idFacebook` = ?;";
                  $query = $this->db->query($sql,array($token,now(),$name,$password));
                  return $token;
            }
            return FALSE;
        }
        
        private function update_profile($name,$password,$idFacebook,$facebookToken){
            $this->load->database();
            $sql = "SELECT * FROM `Users` WHERE `name`=? AND `password`=?)";
            $query = $this->db->query($sql,array($name,$password));
            if($query->num_rows() > 0){
                 $token = md5(uniqid(rand(), true));
                  $sql = "UPDATE`Users` SET `token` = ?, `lastLogin` = ?, WHERE `idUsers` = ? AND `idFacebook` = ?;";
                  $query = $this->db->query($sql,array($token,now(),$name,$password));
                  return $token;
            }
            return FALSE;
        }
        
        public function go_party($token, $idEvent){
            if(!$this->token->is_token_valid($token)){
                $message = "Invalid Token";
                $status_code = 500;
                show_error($message, $status_code);
            }
            $this->load->model('Users_model');
            $this->User_model->go_party($token,$idEvent);
        }
        
        public function favorite($token, $idEstablishment){
            if(!$this->token->is_token_valid($token)){
                $message = "Invalid Token";
                $status_code = 500;
                show_error($message, $status_code);
            }
            $this->load->model('Users_model');
            $this->User_model->favorite($token,$idEstablishment);
        }
        
        public function badges($token){
            if(!$this->token->is_token_valid($token)){
                $message = "Invalid Token";
                $status_code = 500;
                show_error($message, $status_code);
            }
            $this->load->model('Users_model');
            $this->User_model->badges($token);
        }
        
}

/* End of file events_model.php */
/* Location: ./application/model/events_model.php */