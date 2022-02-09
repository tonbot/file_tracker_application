<?php 

 if($_SERVER['REQUEST_METHOD']=='POST'){
     $receiptNumber= trim($_POST['receiptNumber']);
      //validate receipt number
      if(isset($receiptNumber) && $receiptNumber !=""){
          // including database connection
          include_once 'dbconn_post.php';  
          $connect=new dbconn_post;
 
          $response=$connect->reprint($receiptNumber);  
          switch ($response) {
              //on case sucess 
              case 'success':
                   echo 'success';
                  break;
              //on case invalid receipt number 
              case 'invalid':
                    echo 'invalid';
                   break;
              // on neutral        
          }   
         
      }// end of if 
 }



?>