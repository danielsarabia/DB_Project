<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    
    <head>
    <title>QandA.com</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../../web/css/style.css" />
        <script type="text/javascript" src="../../web/js/jquery.js"></script>
        <link rel="stylesheet" type="text/css" media="screen" href="../../web/js/css/jquery.ketchup.css" />
    <script type="text/javascript" src="../../web/js/jquery.ketchup.all.min.js"></script>
    <script type="text/javascript">
$(document).ready(function(){
					
					
				$.ketchup.message('required', 'This is an obligatory field.');				
				  $('#login').ketchup();
				});

</script>
    </head>
    
    <body>
        <div id="global">
            <div id="header">
                <img src="../../web/img/logo.png"  style="float:left;"/>
            </div>
            
            <div id="area">
                <div id="contenedorLogin">
    <h1> LOGIN </h1>
    
    <form name="login" method="post" action="./auth" id="login">
    <div id="contenedorInputsLogin">
    <span>User:</span><input type="text" class="textoLogin" name="name" data-validate="validate(required)" /><br /><br />
    <span>Password:</span> <input type="password" class="textoLogin" name="password" data-validate="validate(required)" />
    </div>
    <input type="submit" class="botonSubmit" value="GET IN" />
    </form>
       
       </div>
            
            <div id="footer">
            </div>
            
        
        </div>
    </body>
    
</html>