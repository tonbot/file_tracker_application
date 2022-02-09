<?php
   //getting form data from search.js
   $file_no                  = $_POST['file_no']; 
   $accepting_by             = $_POST['accepting_by']; 
   $accepting_officer        = $_POST['accepting_officer']; 

if( isset($file_no) && $file_no !="" && isset($accepting_by) && $accepting_by !="" &&
      isset($accepting_officer) && $accepting_officer !=""  )
                    {      
                            //including database file with connection
                            include_once 'dbconn_post.php';

                            //making an object of class dbconn  
                            $connect=new dbconn_post;

                            // passing five parameters to add users function in dbconn_post
                            $response=$connect->acceptFiles($file_no, $accepting_by, $accepting_officer);
                                
                             //getting response text
                             switch ($response) {
                                 case 'success':
                                     echo 'success';
                                     break;
                                 case'failed':
                                   echo 'failed';
                                     break;
                                case'file already been accepted':
                                   echo 'file already been accepted';
                                     break;
                                 default: 
                                      echo $response;
                             }
                    }

?>