<?php ob_start() ?>
<?php
    //Reanudamos la sesión
    @session_start();

    //Validamos si existe realmente una sesión activa o no
	if (isset($_SESSION["autentica"])){
    if($_SESSION["autentica"] != "SIP"){
    //Si no hay sesión activa, lo direccionamos al index.php (inicio de sesión)
    header("Location: ../user/login");
	exit();
    }
	}else{
	header("Location: ../user/login");
	exit();
	}
    ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    
    <head>
    <title>QandA.com</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="/DB_Project/web/css/style.css" />
        <script type="text/javascript" src="/DB_Project/web/js/jquery.js"></script>
    </head>
    
    <body>
        <div id="global">
            <div id="header">
                <div class="linkslinks"><a href="/DB_Project/web/user/bye"><img src="/DB_Project/web/img/turnright32p.png"/></a></div>
                <div class="linkslinks"><a href="/DB_project/web/questionaire/all"><?php echo $_SESSION['currentUser'] ?></a></div>
                <img src="/DB_Project/web/img/logo.png"  style="float:left;"/>
            </div>
            
            <div id="area">
                <div id="sidebar">
                    <ul>
                        <p>TESTS</p>
                        <li><a href="/DB_Project/web/questionaire/all">See All <img src="/DB_Project/web/img/search32pp.png"/></a></li>
                        <li><a href="/DB_Project/web/questionaire/add">Add <img src="/DB_Project/web/img/plus32pp.png"/></a></li>
                    </ul>
                    <ul>
                        <p>PROFILE</p>
                        <li><a>Configuration <img src="/DB_Project/web/img/gear32pp.png"/></a></li>
                        <li><a href="/DB_Project/web/score/all">My Grades <img src="/DB_Project/web/img/notecheck32pp.png"/></a></li>
                    </ul>
                
                </div>
                
                <div id="content">
                    <?php echo $content ?>
                </div>
               
            </div>
            
            <div id="footer">
            </div>
            
        
        </div>
    </body>
    
</html>