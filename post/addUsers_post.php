<?php

    $department = trim($_POST['department']); 
    $username   = trim($_POST['username']); 
    $email      = trim($_POST['email']); 
    $phone      = trim($_POST['phone']); 
    $password   = md5("1234"); 

   if( isset($department) && $department !="" && isset($username) && $username !="" &&
   isset($email) && $email !="" && isset($phone) && $phone !=""  )
   {
                            //including database file with connection
                            include_once 'dbconn_post.php';

                            //making an object of class dbconn  
                            $connect=new dbconn_post;

                            // passing five parameters to add users function in dbconn_post
                            $response=$connect->addUsers($username,$department,$email,$phone,$password);
                                
                             //getting response text
                             switch ($response) {
                                 case 'success':
                                     echo 'success';
                                     break;
                                 
                                 case'true':
                                   echo 'true';
                                     break;
                                 default: 
                                      echo $response;
                             }
                    }

?>