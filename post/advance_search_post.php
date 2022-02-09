<?php 

        if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {   
                 $first_name          =  !empty(trim($_POST['first_name']))   ?(trim($_POST['first_name']))   : 'empty' ;
                 $last_name           =  !empty(trim($_POST['last_name']))    ?(trim($_POST['last_name']))    : 'empty';
                 $property_type       =  !empty(trim($_POST['property_type']))?(trim($_POST['property_type'])): 'empty';         
                 $middle_name         =  !empty(trim($_POST['middle_name']))  ?(trim($_POST['middle_name']))  : 'empty';          
                 $email               =  !empty(trim($_POST['email']))        ?(trim($_POST['email']))        : 'empty';
                 $phone_number        =  !empty(trim($_POST['phone_number'])) ?ltrim(trim(($_POST['phone_number']))) : 'empty';         
                 $category            =  !empty(trim($_POST['category']))     ?(trim($_POST['category']))     : 'empty'; 
                 $lga                 =  !empty(trim($_POST['lga']))          ?(trim($_POST['lga']))          : 'empty';
                 $zone                =  !empty(trim($_POST['zone']))         ?(trim($_POST['zone']))         : 'empty'; 
                 $area                =  !empty(trim($_POST['area']))         ?(trim($_POST['area']))         : 'empty'; 
                 $property_id         =  !empty(trim($_POST['property_id']))  ?(trim($_POST['property_id']))  : 'empty';
               
              
        
                                #including dbconnection
                                include_once "dbconn_post.php"; //this 
                                #making a connection object
                                $connect = new dbconn_post;
                                #if connection not null
                                if ($connect != null)          
                                     {
                                         $response=$connect->advance_search( $first_name, $last_name, $property_type, $middle_name, $email, $phone_number, $category,$lga, $zone, $area , $property_id );
                                        switch ($response) {
                                            case 'zero':
                                                   echo json_encode('zero');
                                                break;
                                            
                                            default:
                                                   echo json_encode($response);
                                                break;
                                        }
                                        }
                                          
      
            }
 
?>