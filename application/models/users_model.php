<?php 

class Users_model extends CI_Model {
    
    /**
     * 
     * @param type $idFacebook
     * @param type $facebookToken
     * @return token,name,photo
     */

    public function facebook_sing_up($idFacebook, $facebookToken){
        $url = "https://graph.facebook.com/oauth/access_token?grant_type=fb_exchange_token&client_id=1446634675566039&client_secret=6c4bfea9dcd163d9ed0177353e1245c4&fb_exchange_token=".$facebookToken;
        $querystring = file_get_contents($url);
        $a = explode('&', $querystring);
        $b = explode('=', $a[0]);
        $token = $b[1];
        $url = "https://graph.facebook.com/".$idFacebook."?access_token=".$facebookToken."&fields=id,name,email,picture.height(400).type(square),age_range";
        $json = json_decode(file_get_contents($url));
        $data['name'] = $json->name;
        $data['email'] = $json->email;
        $data['profilePhoto'] = $json->picture->data->url;
        $data['idFacebook'] = $idFacebook;
        $data['facebookToken'] = $token;
        $this->facebook_create_user($data);
        return $this->login_facebook($idFacebook,$token);
    }
    
    public function login_facebook($idFacebook,$facebookToken){
            $this->load->database();
            $sql = "SELECT * FROM `Users` WHERE `idFacebook`=?";
            $query = $this->db->query($sql,array($idFacebook));
            $data = $query->result_array();
            if($query->num_rows() > 0){
                  $token = md5(uniqid(rand(), true));
                  $sql = "UPDATE `Users` SET `token` = ?, `lastLogin` = ? WHERE `idFacebook` = ?;";
                  $query = $this->db->query($sql,array($token,date('Y-m-d H:i:s'),$idFacebook));
                  $data['session_token'] = $token;
                  return $data;
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
    
    /*public function sing_up($name,$password,$profilePhoto,$email)
	{         
            $this->load->database();
            $sql = "INSERT INTO `Users` (`name`,'password`,`profilePhoto`,`email`) VALUES
            (?,?,?,?);";
            $query = $this->db->query($sql,array($name,$password,$profilePhoto,$email));
            return;
          
        }*/ 

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
        
        public function go_party($idEvent,$idFacebook){
            $this->load->database();
            $sql = "SELECT * FROM `goevent` WHERE `idUser`=? AND `idEvent`=?)";
            $query = $this->db->query($sql,array($idFacebook,$idEvent));
            if($query->num_rows() === 0){
                  $sql = "INSERT INTO `goevent` (`idUser`,`idEvent`) VALUES (?,?);";
                  $query = $this->db->query($sql,array($idFacebook,$idEvent));
                  return $token;
            }
            return FALSE;

            
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