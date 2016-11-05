<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @file polls.php
 * @author Matthew Ruffell
 * @date 10 October 2014
 * @brief This file simply serves up the original angular frontpage
 */
class Polls extends CI_Controller
{
    /**
     * Loads the front angular page
     */
    public function index()
    {
        $this->load->helper('html');
        $this->load->helper('url');
        $this->load->view('polls');
    }
    
    public function get_polls()  
    {
        $this->load->model('polls_model');
        
        if($this->input->server('REQUEST_METHOD') == 'GET') 
        {
            $jsonObj = $this->polls_model->get_polls();
        }
        
        return $jsonObj;
    }
    
    public function get_poll($pollID) 
    {
        $this->load->model('polls_model');
        
        if($this->input->server('REQUEST_METHOD') == 'GET') 
        {
            $jsonObj = $this->polls_model->get_poll($pollID);
        }
        
        return $jsonObj;
    }
    
    public function get_delete_votes($pollID)
    {
        $this->load->model('polls_model');
        
        if($this->input->server('REQUEST_METHOD') == 'GET') 
        {
            $jsonObj = $this->polls_model->get_votes($pollID);
            
            return $jsonObj;
        }
        
        if($this->input->server('REQUEST_METHOD') == 'DELETE') 
        {
            $this->polls_model->delete_votes($pollID);
        }
    }
    
    public function post_vote($pollID, $answerID)
    {
        $this->load->model('polls_model');
        
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->polls_model->post_vote($pollID, $answerID);
        }
    }
}