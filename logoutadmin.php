<?php
    session_start();
    session_unset();
    session_destroy();
?>
<!DOCTYPE html>
<html>
    <head>
       <title>logout</title>
    </head>
    <body>
        <div>
            
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading"></div>
                            <div class="panel-body">
                                <p>You have been logged out. <a href="loginadmin.php">Login again.</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>
    </body>
</html>
