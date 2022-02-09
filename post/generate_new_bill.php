
<?php
   $property_id =$_POST['property_id']; 
   $unique_id =$_POST['unique_id']; 
  
         include_once 'dbconn_post.php';  //including d
         $connect=new dbconn_post; //making an object of dbconn_post  class
         $response=$connect->generate_bill($property_id, $unique_id );
         echo($response);     
?>