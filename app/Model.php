
<?php

class Model{
    
    protected $db;
    
    
    public function __construct($dbname)
     {
       $mvc_bd_connection = new MongoClient();

       if (!$mvc_bd_connection) {
           die('The connection to the Database was unsuccesful.');
       }
       $db = $mvc_bd_connection->$dbname;

       $this->db = $db;
     }
    
    public function insertScore($questionaire_n,$userName,  $score){
        //FIND USER ID
        $collection = $this->db->users;
        $query = array("name"=>"$userName");
        $u = $collection->findOne($query);
        $u_id = $u['u_id'];
        //INSERT
        $collection = $this->db->scores;
        $document = array( 
      "questionaire_n" => "$questionaire_n", 
      "u_id" => "$u_id", 
      "score" => $score
       );
        $collection->insert($document);
    }
    
    
    public function authUser($name, $password){
        $collection = $this->db->users;
        $query = array("name"=>"$name", "password"=>"$password");
        $cursor = $collection->find($query);
        if($cursor->count() > 0)
        return 0;
         else
             return 1;
    }
    
    
    public function getQuestionaires(){
        $collection = $this->db->questionaires;
        $cursor = $collection->find();
        $data = array(); //ARRAY TO BE RETURNED
        foreach($cursor as $document){
            $data[] = $document;
        }
        
        return $data;
    }
    
    public function getQuestionaire($questionaire_n){
        $collection = $this->db->questionaires;
        $query = array("questionaire_n"=>"$questionaire_n");
        $cursor = $collection->findOne($query);
        
        return $cursor;
        
    }
    
    public function validateScore($questionaire_n, $userName){
        $collection = $this->db->users;
        $query = array("name"=>"$userName");
        $u = $collection->findOne($query);
        $u_id = $u['u_id'];
        $collection = $this->db->scores;
        $query = array("questionaire_n"=>"$questionaire_n","u_id"=>"$u_id");
         $cursor = $collection->find($query);
        if($cursor->count() > 0)
        return 0;
         else
             return 1;
    }
    
    public function getScores($userName){
        //FIND USER ID
        $collection = $this->db->users;
        $query = array("name"=>"$userName");
        $u = $collection->findOne($query);
        $u_id = $u['u_id'];
        //FIND SCORES
        $collection = $this->db->scores;
        $query = array("u_id"=>"$u_id");
        $cursor = $collection->find($query);
        $data = array(); //ARRAY TO BE RETURNED
        foreach($cursor as $document){
            $collection = $this->db->questionaires;
            $questionaire_n = $document['questionaire_n'];
            $query = array("questionaire_n"=>"$questionaire_n");
            $questionaire = $collection->findOne($query);
            $title =  $questionaire['title'];
            $score = $document['score'];
            $data[] = array("title"=>"$title", "score"=> $score);
        }
        
        return $data;
    }
    
    public function addQuestionaire($xml){
    }
}
