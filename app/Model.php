
<?php

class Model{
    
    protected $db;
    protected $mvc_bd_connection;
    
    public function __construct($dbname)
     {
       $this->mvc_bd_connection = new MongoClient();

       if (!$this->mvc_bd_connection) {
           die('The connection to the Database was unsuccesful.');
       }
       $db = $this->mvc_bd_connection->$dbname;

       $this->db = $db;
    }


    public function __destruct() {
        $this->mvc_bd_connection->close();
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
    
    public function addQuestionnaire($xml){
        $collection = $this->db->questionaires; //Select the questionnaires collection from MongoDB

        $queryObj = array(); //Empty query builder
        
        //Add basic info to the builder (questionnaire_n, title & description of the questionnaire)
        $queryObj["questionaire_n"] = (string)time();
        $queryObj["title"] = (string)$xml['title'];
        $queryObj["description"] = (string)$xml['description'];

        $questions = array(); //Empty container for the questions

        foreach($xml as $q){
            $question = array(); //Container for the question's info

            //Sets all the information that concerns a question
            $question['question_n'] = (string)$q['number'];
            $question['question'] = (string)$q->title;

            $question['options'] = array(); //Empty container for the options
            //Options are added here
            array_push($question['options'], array("A" => (string)$q->options->A));
            array_push($question['options'], array("B" => (string)$q->options->B));
            array_push($question['options'], array("C" => (string)$q->options->C));
            array_push($question['options'], array("D" => (string)$q->options->D));

            $question['answer'] = (string)$q->answer;

            //The question is added to the container for the questions
            array_push($questions,$question);
        }

        //Add all questions to the builder
        $queryObj['questions'] = $questions;

        try {
            //Insert questionnaire into the database
            $collection->insert($queryObj);

        } catch(Exception $e) {
            echo "Hubo un error\n";
        }

    }
}
