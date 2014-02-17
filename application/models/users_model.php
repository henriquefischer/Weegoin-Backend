<?php 

class Users_model extends CI_Model {
    
    /**
     * 
     * @param type $idFacebook
     * @param type $facebookToken
     * @return token,name,photo
     */

    public function facebook_sing_up($idFacebook, $facebookToken){
        $url = "https://graph.facebook.com/".$idFacebook."?access_token=".$facebookToken."&fields=id,name,email,picture.height(400).type(square),age_range";
        $json = json_decode(file_get_contents($url));
        $data['name'] = $json->name;
        $data['email'] = $json->email;
        $data['profilePhoto'] = $json->picture->data->url;
        $data['idFacebook'] = $idFacebook;
        $data['facebookToken'] = $facebookToken;
        $this->facebook_create_user($data);
        return $this->login_facebook($idFacebook,$facebookToken);
    }
    
    public function login_facebook($idFacebook,$facebookToken){
            $this->load->database();
            $sql = "SELECT * FROM `Users` WHERE `facebookToken`=? AND `idFacebook`=?";
            $query = $this->db->query($sql,array($facebookToken,$idFacebook));
            $data = $query->result_array();
            if($query->num_rows() > 0){
                  $token = md5(uniqid(rand(), true));
                  $sql = "UPDATE `Users` SET `token` = ?, `lastLogin` = ? WHERE `facebookToken` = ? AND `idFacebook` = ?;";
                  $query = $this->db->query($sql,array($token,date('Y-m-d H:i:s'),$facebookToken,$idFacebook));
                  $data['token'] = $token;
                  print_r($data);
            }
            return FALSE;
        }
    
    private function facebook_create_user($data){
        $this->load->database();
        $sql = "INSERT INTO `Users`
            (`name`,`profilePhoto`,`email`,`idFacebook`,`facebookToken`)
            VALUES 
            (?,?,?,?,?);";
        $query = $this->db->query($sql,array($data['name'],$data['profilePhoto'],$data['email'],$data['idFacebook'],$data['facebookToken']));
        return;
    }
    
    public function sing_up($name,$password,$profilePhoto,$email)
	{         
            $this->load->database();
            $sql = "INSERT INTO `Users`
            (`name`,'password`,`profilePhoto`,`email`)
            VALUES
            (?,?,?,?);";
            $query = $this->db->query($sql,array($name,$password,$profilePhoto,$email));
            return;
          
        }

        public function user_exist($idFacebook)
	{         
            $this->load->database();
            $sql = "SELECT * FROM `Users` WHERE `idFacebook`=? ;";
            $query = $this->db->query($sql,array($idFacebook));
            if($query->num_rows() > 0){
                return TRUE;
            }
            return FALSE;
                
          
        }
        
        public function login($name,$password){
            $this->load->database();
            $sql = "SELECT * FROM `Users` WHERE `name`=? AND `password`=?";
            $query = $this->db->query($sql,array($name,$password));
            if($query->num_rows() > 0){

                  $token = md5(uniqid(rand(), true));
                  $sql = "UPDATE`Users` SET `token` = ?, `lastLogin` = ?, WHERE `idUsers` = ? AND `idFacebook` = ?;";
                  $query = $this->db->query($sql,array($token,now(),$name,$password));
                  return $token;
            }
            return FALSE;
        }
        
        //Not finished
        public function edit_user($token,$name,$email,$password,$idFacebook,$facebookToken){
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
        
        private function update_profile($name,$password,$email,$idFacebook,$facebookToken){
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