<?php

   $email     =  $_POST['email']; 
   $password  =$_POST['password']; 
   $department=$_POST['department'];

      if( isset($email) && $email !="" && isset($password) && $password !=""  && isset($department) && $department !="")
    
                    {      
                            //including database file with connection
                            include_once 'dbconn_post.php';

                            //making an object of class dbconn  
                            $connect=new dbconn_post;

                            // passing five parameters to add users function in dbconn_post
                            $response=$connect->get_user_post($email, $password, $department);
                                
                             //getting response text
                             if ($response != "false"){
                               
                               echo  (json_encode($response));
                             }
                             else{

                               echo 'user not exist';
                             }
                    }

?>