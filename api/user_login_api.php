<?php   
       #header settings
       header("Content-type: application/json; charset=utf-8");
       header('Access-Control-Allow-Headers: *');
       header('Access-Control-Request-Method: post');

    if($_SERVER['REQUEST_METHOD']=="POST")
        {
            $email=trim($_POST['email']);
            $password=trim($_POST['password']);

            #if isset email and password and not empty
            if ((isset($email) && $email != "") && (isset($password) && $password != ""))
                    {
                        #including dbconnection
                        include_once "dbconnection.php";
                        #making a connection object
                        $connect = new dbconnection;
                        #if connection not null
                        if ($connect != null)
                                {
                                    $response=$connect->login($email, $password);
                                    switch ($response) 
                                        {
                                            case 'success':
                                                echo "success";
                                                break;
                                            case 'failed':
                                                 echo "failed";
                                                 break;
                                            default:
                                                  echo 'error';
                                                break;
                                        }
                                } 
                        else 
                                {
                                    $response="Failed to connect to the DB";
                                    echo ($response );
                                    
                                }
                    } 
                    // password or email is empty
                    else{
                        echo "field can not be empty";
                    }
            
        } 
        else{
            echo 'Access denied';
        }

?>