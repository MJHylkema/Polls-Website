<?php
class Polls_Model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

        public function get_polls()
        {
            $query = $this->db->get('Polls');
            $polls = $query->result();
            
            if ($query->num_rows() == 0) {
                throw new Exception("No Polls found in the database.");
            }
            
            $jsonObj = json_encode($polls);
            echo($jsonObj);
            
            return $jsonObj;
        }
        
        public function get_poll($pollID) 
        {
            $query = $this->db->get_where('Polls', array('id' => $pollID));
            $poll = $query->result();

            $answers = $this->get_answers($pollID);

            $ansarray= array();
            foreach ($answers as $answer){
                array_push($ansarray, $answer->answer);     
            } 

            $poll[0]->answers = $answers;
            
            if ($query->num_rows() == 0) {
                throw new Exception("Polls $pollID not found in database");
            }
            
            $jsonObj = json_encode($poll);
            echo($jsonObj);
            
            return $jsonObj;
        }
        
        
        public function get_votes($pollid)
        {
             $answersqueryrow = "SELECT * FROM Answers WHERE pollID = ?";
             $answersquery =( $this->db->query($answersqueryrow, $pollid));
             $answers = $answersquery->result();
             
             $iterator = 0;
             
             foreach ($answers as $answer)
            {
                 $countQuery = 'SELECT COUNT(DISTINCT(id)) AS counts FROM Votes WHERE answerID='.$answer->id;
                 $countQuerysql =$this->db->query($countQuery);
                 $count = $countQuerysql->result();
                 $answers[$iterator]->Count = $count[0]->counts;
                 
                 $iterator += 1;
            }
            
            $jsonObj = json_encode($answers);
            echo($jsonObj);
            
            return $jsonObj;
        }
        
        public function get_answers($pollID)
        {
            $answersqueryrow = "SELECT * FROM Answers WHERE pollID = ?";
            $answersquery =( $this->db->query($answersqueryrow, $pollID));
            $answers = $answersquery->result();
             
            return $answers;
        }
        
        public function delete_votes($pollID){
            $deleteanswers = "DELETE FROM Votes WHERE pollID = ?";
            $this->db->query($deleteanswers, $pollID);
        }
        
        public function post_vote($pollID, $answerID){
            
            $ip = $this->input->ip_address();
            $postvote = "INSERT INTO `Votes`( `pollID`, `answerID`, `ipAddress`) VALUES (?,?,?)";
            $this->db->query($postvote, array($pollID, $answerID, $ip));
        }
}