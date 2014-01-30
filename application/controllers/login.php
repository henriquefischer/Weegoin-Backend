<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends CI_Controller {

	public function list_events($token)
	{
            $this->load->model('Token_model','token');
            if(!$this->token->is_token_valid($token)){
                $message = "Invalid Token";
                $status_code = 500;
                show_error($message, $status_code);
            }
            
            $this->list_events_calendar();          
        }
        
        public function list_events_calendar()
        {
            $this->load->model('Events_model','events');
            $data['query'] = $this->events->list_events();
            $this->load->view('list_events',$data); 
            
        }
}

