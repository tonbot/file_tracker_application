<?php

    $file_no               = trim($_POST['file_no']); 
    $beneficiary           = trim($_POST['beneficiary']); 
    $file_desc             = trim($_POST['file_desc']); 
    $amount                = trim($_POST['amount']); 
    $officer_name          = trim($_POST['officer_name']); 
    $officer_department    = trim($_POST['officer_department']); 


   if( isset($file_no) && $file_no !="" && isset($beneficiary) && $beneficiary !="" &&
            isset($file_desc) && $file_desc !="" && isset($amount) && $amount !=""  &&
            isset($officer_name) && $officer_name !="" && isset($officer_department) && $officer_department !="" )
   {
                            //including database file with connection
                            include_once 'dbconn_post.php';

                            //making an object of class dbconn  
                            $connect=new dbconn_post;

                            // passing five parameters to add users function in dbconn_post
                            $response=$connect->addFiles( $file_no,$beneficiary,$file_desc,$amount,$officer_name,$officer_department  );
                                
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