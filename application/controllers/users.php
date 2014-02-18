<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Users extends CI_Controller {

         /* Loga usuario já existente
          * 
         * @param: idFacebook,
         * @param: facebookToken
         * @return data(JSON)
         * 
         */      
        public function facebook_login($idFacebook,$facebookToken,$userToken){
            $this->load->model('Users_model');
            if($this->Users_model->user_exist($idFacebook)){
                $data['query'] = $this->Users_model->login_facebook($idFacebook,$facebookToken);
                $this->load->view('list_events',$data);
            }else{
                $data['query'] = $this->Users_model->facebook_sing_up($idFacebook,$facebookToken,$userToken);
                $this->load->view('list_events',$data);
            }
            
        }
        
        private function user_exist($idFacebook,$password)
        {
            $this->load->model('Users_model');
            if($this->Users_model->user_exist($name,$password)){
                return TRUE;
            }
            return FALSE;
            
        }
        
        public function edit_user($token,$name,$password,$idFacebook,$facebookToken){
            $this->load->model('Token_model', 'token');
            if(!$this->token->is_token_valid($token)){
                $message = "Invalid Token";
                $status_code = 500;
                show_error($message, $status_code);
            }
            
            $this->update_profile($name,$password,$idFacebook,$facebookToken);
        }
        
        private function update_profile($name,$password,$idFacebook,$facebookToken){
            $this->load->model('Users_model');
            $data['query'] = $this->Users_model->update_profile;
            $this->load->view('list_events',$data);
        }
        
        public function go_party($idFacebook,$idEvent){
            /*if(!$this->token->is_token_valid($token)){
                $message = "Invalid Token";
                $status_code = 500;
                show_error($message, $status_code);
            }*/
            $this->load->model('Users_model');
            $data['query'] = $this->User_model->go_party($idFacebook,$idEvent);
            $this->load->view('list_events',$data);
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
/*public function sing_up($name,$password,$email)
	{
            //usuario existe?
            if(!$this->user_exist($name,$password.$email)){
                $message = "User already exist";
                $status_code = 500;
                show_error($message, $status_code);
            }
            $this->load->model('Users_model');
            $this->Users_model->sing_up($name,$password,$email);
            $this->login($name,$password);
            
        }*/

