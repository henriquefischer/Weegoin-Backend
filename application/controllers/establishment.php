<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Establishment extends CI_Controller {

	public function list_establishment($token)
	{
            $this->load->model('Token_model','token');
            if(!$this->token->is_token_valid($token)){
                $message = "Invalid Token";
                $status_code = 500;
                show_error($message, $status_code);
            }
            
            $this->list_establishment_valid();          
        }

        private function list_establishment_valid()
        {
            $this->load->model('Establishment_model','establishment');
            $data['query'] = $this->establishment->list_establishment();
            $this->load->view('list_events',$data); 
            
        }
        
        public function list_single_establishment($token, $idEstablishment){
            $this->load->model('Token_model', 'token');
            if(!$this->token->is_token_valid($token)){
                $message = "Invalid Token";
                $status_code = 500;
                show_error($message, $status_code);
            }
            
            $this->list_single_establishment_token($idEstablishment);
        }
        
        private function list_single_establishment_token($idEstablishment){
            $this->load->model('Establishment_model','events');
            $data['query'] = $this->events->list_single_establishment($idEstablishment);
            $this->load->view('list_events',$data);
        }
        
        public function list_events_establishment($token, $idEstablishment){
            $this->load->model('Token_model', 'token');
            if(!$this->token->is_token_valid($token)){
                $message = "Invalid Token";
                $status_code = 500;
                show_error($message, $status_code);
            }
            
            $this->list_events_establishment_token($idEstablishment);
        }
        
        private function list_events_establishment_token($idEstablishment){
            $this->load->model('Establishment_model','events');
            $data['query'] = $this->events->list_events_establishment($idEstablishment);
            $this->load->view('list_events',$data);
        }
     
}

