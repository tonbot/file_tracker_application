
<?php
   $file_no   = $_POST['file_no']; 
   $search_by = $_POST['search_by']; 
   if (isset($file_no))
   {
        include_once 'dbconn_post.php';  
         $connect=new dbconn_post;

         $response=$connect->get_details($file_no,$search_by);     
         echo (json_encode($response));
   }

?>