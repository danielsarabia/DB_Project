<?php

class questionaire{

    public function add() {
        require __DIR__ . '/templates/addQuestionnaire.php';
    }

    public function upload() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $file = "../uploads/file.xml";
            if(!move_uploaded_file($_FILES["file"]["tmp_name"], $file)) {
                echo "<script>alert('There was an error uploading the file. Please try again.');window.location.href='/DB_Project/web/questionaire/add'</script>";
            }
            else {
                $xml=simplexml_load_file($file);
                $params = $xml;
            }
        }

        require __DIR__.'/templates/savedQuestionnaire.php';
    }

    public function publish() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $m = new Model(Config::$mvc_bd_nombre);

            $file = "../uploads/file.xml";
            $xml=simplexml_load_file($file);

            $m->addQuestionnaire($xml);

            echo "<script>alert('The file was successfully added to the database.');</script>";

        }
        echo "<script>window.location.href='/DB_Project/web/questionaire/all'</script>";
    }

    public function all(){
    $m = new Model(Config::$mvc_bd_nombre);
        // THE $params VARIABLES IS INJECTED IN THE TEMPLATE (it's an array)
    $params = $m->getQuestionaires();
    require __DIR__ . '/templates/getQuestionaires.php';
    }
    
    public function solve(){
         $m = new Model(Config::$mvc_bd_nombre);
        $flag = 0;
        //VALIDATE IF THE USER HAS ALREADY ANSWERED THE TEST
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        @session_start();
        if($_SESSION["autentica"] == "SIP"){
         $flag= $m->validateScore($_GET['id'],$_SESSION['currentUser']);
        }
        }
        
        if($flag!=0){
        if($_SERVER['REQUEST_METHOD']=='GET'){
        // THE $params VARIABLES IS INJECTED IN THE TEMPLATE (it's an array)
    $params = $m->getQuestionaire($_GET['id']);
    require __DIR__ . '/templates/solveQuestionaire.php';
        }
        }else{
            echo "<script>alert('You have already answered this questionaire.');window.location.href='/DB_Project/web/questionaire/all'</script>”";
        }
    }
    
    public function submit(){
        $m = new Model(Config::$mvc_bd_nombre);
        $score = 0;
        $cont = 0; //THIS VARIABLE IS USED TO COUNT THE QUESTIONS idk
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			// CALCULATE THE TOTAL SCORE
                //get the questions
            $questionaire = $m->getQuestionaire($_POST['questionaire_n']);
            foreach($questionaire['questions'] as $question ){
                $q_answer = $question['answer'];
                $q_n = $question['question_n'];
                $answer = $_POST["$q_n"];
                if ($q_answer == $answer){
                    $score++;
                }
                $cont++;
            }
            
            @session_start();

        //Validamos si existe realmente una sesión activa o no
        if (isset($_SESSION["autentica"])){
        if($_SESSION["autentica"] == "SIP"){
         $m->insertScore($_POST['questionaire_n'],$_SESSION['currentUser'], floor($score / $cont * 100));
        }
            
        }
          }
        
        $m = new Model(Config::$mvc_bd_nombre);
        // THE $params VARIABLES IS INJECTED IN THE TEMPLATE (it's an array)
        @session_start();

        //Validamos si existe realmente una sesión activa o no
        if (isset($_SESSION["autentica"])){
        if($_SESSION["autentica"] == "SIP"){
        $params = $m->getScores($_SESSION['currentUser']);
         
        }
        }
    require __DIR__ . '/templates/getScores.php';
    }
    }



class user{
    
    public function login(){
        //phpinfo();
        require __DIR__ . '/templates/login.php';
    }
    
    public function auth(){
        $m = new Model(Config::$mvc_bd_nombre);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$result = $m->authUser($_POST['name'], $_POST['password']);
          }
        if($result == 0){
		     session_start();
			 $_SESSION['autentica']= "SIP";
			 $_SESSION['currentUser']= $_POST['name'];
			 $params = $m->getQuestionaires();
            require __DIR__ . '/templates/getQuestionaires.php';
		 }
		 else{
			 echo "<script>alert('ERROR');window.location.href='login'</script>”";
		 }
    }
    
    public function bye()
     {
		 session_start();
		 session_destroy();
         header("Location: /DB_Project/web/user/login");
     }
    
}


class score{
    
    public function all(){
        $m = new Model(Config::$mvc_bd_nombre);
        // THE $params VARIABLES IS INJECTED IN THE TEMPLATE (it's an array)
        @session_start();

        //Validamos si existe realmente una sesión activa o no
        if (isset($_SESSION["autentica"])){
        if($_SESSION["autentica"] == "SIP"){
        $params = $m->getScores($_SESSION['currentUser']);
         require __DIR__ . '/templates/getScores.php';
        }
        }
    }

}