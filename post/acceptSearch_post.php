
<?php
   $file_no = $_POST['file_no']; 
   $sending_to = $_POST['sending_to']; 
   if (isset($file_no))
   {
        include_once 'dbconn_post.php';  
         $connect=new dbconn_post;

         $response=$connect->get_details2($file_no,$sending_to);     
         echo (json_encode($response));
   }

?>