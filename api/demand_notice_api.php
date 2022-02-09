<?php 

     
header("Content-type: application/json; charset=utf-8");
header('Access-Control-Allow-Headers: *');
header('Access-Control-Request-Method: POST');  

     
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {   
                
                 $property_id    = $_POST['property_id'];  
                 $image          = $_FILES['image']['name'];
                 $path           = realpath(dirname(__FILE__));

                 #getting the image extension;
                 $extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

                 if ( $_FILES['image']['error'] > 0 )
                   {
                      echo 'Error: ' . $_FILES['image']['error'] . '<br>';
                   } //if image is an errror
                 else
                  {
                     if(move_uploaded_file($_FILES['image']['tmp_name'], $path. '//upload//' . $property_id.".".$extension))
                        {
                            #including dbconnection
                            include_once "dbconnection.php";
                            #making a connection object
                            $connect = new dbconnection;
                            #if connection not null     
                                 if ($connect != null)
                                    {
                                       $response=$connect->demand_notice($property_id, $extension);
                                        echo $response;
                                    } #end of if connect not equal to null
                        }
                  } //end of else image is not error

                              
                               
            } // end of if server request is post   
              else{
               echo json_encode("request not accepted");
            }       
            
            
?>