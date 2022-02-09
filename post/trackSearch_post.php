
<?php
   $file_no = $_POST['file_no']; 
   if (isset($file_no))
   {
        include_once 'dbconn_post.php';  
         $connect=new dbconn_post;

         $response=$connect->get_details3($file_no);     
         echo (json_encode($response));
   }

?>