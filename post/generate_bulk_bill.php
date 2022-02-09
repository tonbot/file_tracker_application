
<?php
   $lga =$_POST['lga']; 
   if (isset($lga))
   {
        include_once 'dbconn_post.php';  
         $connect=new dbconn_post;

         $response=$connect->get_enumeration($lga);
            
         foreach($response as $data){
             
            $response=$connect->generate_bulk_bill($data['property_id'],$data['unique_id'] );
        
         }
        
          echo ("success");
   }

?>