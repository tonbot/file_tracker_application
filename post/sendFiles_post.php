<?php
   //getting form data from search.js
   $file_no          = $_POST['file_no']; 
   $sending_from     = $_POST['sending_from']; 
   $sending_to       = $_POST['sending_to']; 
   $sending_officer  = $_POST['sending_officer'];


if( isset($file_no) && $file_no !="" && isset($sending_from) && $sending_from !="" &&
      isset($sending_to) && $sending_to !="" && isset($sending_officer) && $sending_officer !="" )
                    {      
                            //including database file with connection
                            include_once 'dbconn_post.php';

                            //making an object of class dbconn  
                            $connect=new dbconn_post;

                            // passing five parameters to add users function in dbconn_post
                            $response=$connect->sendFiles($file_no, $sending_from, $sending_to, $sending_officer);
                                
                             //getting response text
                             switch ($response) {
                                 case 'success':
                                     echo 'success';
                                     break;
                                 case'failed':
                                   echo 'failed';
                                     break;
                                case'file already been sent':
                                   echo 'file already been sent';
                                     break;
                                case'file already been sent':
                                    echo 'please accept this file';
                                      break;
                                 default: 
                                      echo $response;
                             }
                    }

?>