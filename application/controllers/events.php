<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
class Events extends CI_Controller {

	public function list_events($token,$next)
	{
            $this->load->model('Token_model','token');
            if(!$this->token->is_token_valid($token)){
                $message = "Invalid Token";
                $status_code = 500;
                show_error($message, $status_code);
            }
            
            $this->list_events_calendar($next);          
        }
        
        private function list_events_calendar($next)
        {
            $this->load->model('Events_model','events');
            $data['query'] = $this->events->list_events($next);
            $this->load->view('list_events',$data); 
            
        }
        
        public function list_single_event($token, $idEvent){
            $this->load->model('Token_model', 'token');
            if(!$this->token->is_token_valid($token)){
                $message = "Invalid Token";
                $status_code = 500;
                show_error($message, $status_code);
            }
            
            $this->list_single_event_token($idEvent);
        }
        
        private function list_single_event_token($idEvent){
            $this->load->model('Events_model','events');
            $data['query'] = $this->events->list_single_envent($idEvent);
            $this->load->view('list_events',$data);
        }
        
}

