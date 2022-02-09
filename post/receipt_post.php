<?php 

 if($_SERVER['REQUEST_METHOD']=='POST'){
     $receiptNumber= $_POST['receiptNumber'];
      //validate receipt number
      if(isset($receiptNumber) && $receiptNumber !=""){
          // including database connection
          include_once 'dbconn_post.php';  
          $connect=new dbconn_post;
 
          $response=$connect->get_payment_records($receiptNumber);  
          switch ($response) {
              //on case sucess 
              case 'success':
                   echo 'success';
                  break;
              //on case invalid receipt number 
              case 'Invalid Receipt Number':
                    echo 'Invalid Receipt Number';
                   break;
              // on neutral        
              default:
                  echo (json_encode($response)) ;
                  break;
          }   
         
      }// end of if 
 }



?>