<?php

   $department  =$_POST['department']; 
   $username    =$_POST['username']; 
   $email       =$_POST['email']; 
   $phone       =$_POST['phone']; 

      if( isset($department) && $department !="" && isset($username) && $username !="" &&
      isset($email) && $email !="" && isset($phone) && $phone !="" )
        
                    {      
                            //including database file with connection
                            include_once 'dbconn_post.php';

                            //making an object of class dbconn  
                            $connect=new dbconn_post;

                            // passing five parameters to add users function in dbconn_post
                            $response=$connect->update_user($username,$department,$email,$phone);
                                
                             //getting response text
                             switch ($response) {
                                 case 'success':
                                     echo 'success';
                                     break;
                                 
                                 case'failed':
                                   echo 'failed';
                                     break;
                                 default: 
                                      echo $response;
                             }
                    }

?>