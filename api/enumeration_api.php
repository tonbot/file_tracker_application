<?php 

     
header("Content-type: application/json; charset=utf-8");
header('Access-Control-Allow-Headers: *');
header('Access-Control-Request-Method: POST');  

     
                           
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {   
                    
                $title                = trim($_POST['title']);                
                $first_name           = trim($_POST['first_name']);
                $middle_name          = trim($_POST['middle_name']);           
                $last_name            = trim($_POST['last_name']);
                $gender               = trim($_POST['gender']);               
                $email                = trim($_POST['email']);
                $phone_number         = trim($_POST['phone_number']);          
                $occupation           = trim($_POST['occupation']);
                $property_id          = trim($_POST['property_id']);          
                $house_number         = trim($_POST['house_number']);
                $street               = trim($_POST['street']);               
                $area                 = trim($_POST['area']);
                $landmark             = trim($_POST['landmark']);             
                $property_name        = trim($_POST['property_name']);
                $property_type        = trim($_POST['property_type']);        
                $area_size            = trim($_POST['area_size']);
                $building_type        = trim($_POST['building_type']);         
                $building_purpose     = trim($_POST['building_purpose']);
                $category             = trim($_POST['category']);              
                $area_class           = trim($_POST['area_class']);
                $lga                  = trim($_POST['lga']);               
                $zone                 = trim($_POST['zone']);                 
                $agent_id             = trim($_POST['agent_id']);
                $mac_address          = trim($_POST['mac_address']);          
                $longitude            = trim($_POST['longitude']);
                $latitude             = trim($_POST['latitude']);             
                $image                = $_FILES['image']['name'];
            
                                #path of the root directory
                                $path = realpath(dirname(__FILE__));
                                #including dbconnection
                                include_once "dbconnection.php";
                                #making a connection object
                                $connect = new dbconnection;
                                #if connection not null
                                if ($connect != null)
                                                  
                                        {
                                            #get lga code in lga_codes table;
                                            $lga_code = $connect ->get_lga_code($lga);   
                                            #get propery type codes in property type codes table;  

                                            //check if property type is Residential building. if yes fetch from building type
                                            if ($property_type =='Residential Building') 
                                                {
                                                   #determine property type code
                                                    $prop_type= $building_type;
                                                    $property_type_code = $connect ->get_property_code($lga,$zone,$prop_type);
                                                   #####################################################################################3333 
                                                     #determine the chargeable rate for Residential using formula 
                                                     $build_purpose = $building_purpose;
                                                     $rate = $connect->get_rate($lga,$zone,$prop_type,$build_purpose);

                                                }   
                                            else
                                                {    

                                                    $prop_type= $property_type; 
                                                    $property_type_code = $connect ->get_property_code($lga,$zone,$prop_type);
                                                    #########################################################################
                                                         //prop_type can be any value execept Residential Building
                                                         //if prop_type is equall to school then building purpose will be equal to school_category value.
                                                            switch ($prop_type) 
                                                            {
                                                                case 'Schools':
                                                                    $build_purpose = $building_purpose;
                                                                    $rate = $connect->get_rate($lga,$zone,$prop_type,$build_purpose);
                                                                    break;
                                                                //if prop_type is not equal to school and not equal to Residential Building 
                                                                //then buill purpose will be equal to Business    
                                                                default:
                                                                    $build_purpose='Business';
                                                                    $rate = $connect->get_rate($lga,$zone,$prop_type,$build_purpose);
                                                                    break;
                                                            }
                                                         
                                                           
                                                    
                                                } 

                                                //log into file for texting i will soon remove it
                                                $response = $connect->logg(
                                                                                $title,               
                                                                                $first_name,     
                                                                                $middle_name,
                                                                                $last_name,          
                                                                                $gender,          
                                                                                $email,
                                                                                $phone_number,        
                                                                                $occupation,      
                                                                                $property_id,
                                                                                $house_number,        
                                                                                $street,          
                                                                                $area,         
                                                                                $landmark, 
                                                                                $property_name,       
                                                                                $property_type,   
                                                                                $area_size,  
                                                                                $building_type,      
                                                                                $building_purpose,   
                                                                                $category, 
                                                                                $area_class,          
                                                                                $lga,            
                                                                                $lga_code,  
                                                                                $property_type_code,  
                                                                                $zone,           
                                                                                $rate,  
                                                                                $agent_id,            
                                                                                $mac_address,     
                                                                                $longitude, 
                                                                                $latitude,          
                                                                                $path 
                                                                           ); 

                                             #initialisng bill number status
                                             $bill_number_status="awaiting";  
                                             $response = $connect->register(
                                                                                $title,               $first_name,      $middle_name,
                                                                                $last_name,           $gender,          $email,
                                                                                $phone_number,        $occupation,      $property_id,
                                                                                $house_number,        $street,          $area,         $landmark, 
                                                                                $property_name,       $property_type,   $area_size,  
                                                                                $building_type,       $build_purpose,   $category, 
                                                                                $area_class,          $lga,             $lga_code,  
                                                                                $property_type_code,  $zone,            $rate,  
                                                                                $agent_id,            $mac_address,     $longitude, 
                                                                                $latitude,            $bill_number_status

                                                                            ); #register ends here
                                              switch (trim($response)) 
                                                    {
                                                        case 'existed':
                                                                echo(json_encode("existed"));
                                                            break;
                                                        case 'success':
                                                           #save image file
                                                                    $extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

                                                                    if ( $_FILES['image']['error'] > 0 )
                                                                        {
                                                                            echo 'Error: ' . $_FILES['image']['error'] . '<br>';
                                                                        }
                                                                    else
                                                                        {   #moving the image from temporary meomory to upload folder
                                                                            if(move_uploaded_file($_FILES['image']['tmp_name'], $path. '//upload//'. "e_".$property_id.".".$extension))
                                                                                {
                                                                                
                                                                                    $response=$connect->save_enumeration_image($property_id, $extension);
                                                                                }
                                                                               
                                                                        }
                                                                echo(json_encode("success"));
                                                            break;                    
                                                        case 'failed':
                                                                echo(json_encode("something went wrong!"));
                                                            break;
                                                        default :
                                                                echo(json_encode("an unexpected error occur!"));
                                                    }

                                        } #end of if connect not null
                                         
                                                
                                else 
                                        {
                                            $response="Failed to connect to the DB";
                                            echo ($response );
                                            
                                        }# else connect is null

            } else{ #if server request is get

                 echo(json_encode("Request not supported"));
            }
     
      /*  if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {   
                    
                 $title                = $_POST['title'];                
                 $first_name           = trim($_POST['first_name']);
                 $middle_name          = $_POST['middle_name'];           
                 $last_name            = $_POST['last_name'];
                 $gender               = $_POST['gender'];               
                 $email                = $_POST['email'];
                 $phone_number         = $_POST['phone_number'];          
                 $occupation           = $_POST['occupation'];
                 $property_id          = $_POST['property_id'];          
                 $house_number         = $_POST['house_number'];
                 $street               = $_POST['street'];               
                 $area                 = $_POST['area'];
                 $landmark             = $_POST['landmark'];             
                 $property_name        = $_POST['property_name'];
                 $property_type        = $_POST['property_type'];        
                 $area_size            = $_POST['area_size'];
                 $building_type        = $_POST['building_type'];         
                 $building_purpose     = $_POST['building_purpose'];
                 $category             = $_POST['category'];              
                 $area_class           = $_POST['area_class'];
                 $lga                  = $_POST['lga'];               
                 $zone                 = $_POST['zone'];                 
                 $agent_id             = $_POST['agent_id'];
                 $mac_address          = $_POST['mac_address'];          
                 $longitude            = $_POST['longitude'];
                 $latitude             = $_POST['latitude'];             
                 $image                = $_FILES['image']['name'];
                      
                 $response1 = [
                    $title,               $first_name,         $middle_name,
                    $last_name,           $gender,             $email,
                    $phone_number,        $occupation,         $property_id,
                    $house_number,        $street,             $area,        
                    $property_name,       $property_type,      $area_size,  
                    $building_type,       $building_purpose,   $category, 
                    $area_class,          $lga,                $property_type_code, 
                    $zone,                $landmark,           $longitude, 
                    $agent_id,            $mac_address,        $latitude,  
                    $image  
                ];   
                      /* #including dbconnection
                                include_once "dbconnection.php";
                                #making a connection object
                                $connect = new dbconnection; */
                    //echo (json_encode($response));
                    $path = realpath(dirname(__FILE__));
                                                // STORE IMAGE FILE
                            if ( $_FILES['image']['error'] > 0 ){
                                echo 'Error: ' . $_FILES['image']['error'] . '<br>';
                            }
                            else {
                                if(move_uploaded_file($_FILES['image']['tmp_name'], $path. '//upload//' . $_FILES['image']['name']))
                                {
                                  $tur='true';
                                }
                            }
                         
                //register ends here        
                               
                                #including dbconnection
                                include_once "dbconnection.php";
                                #making a connection object
                                $connect = new dbconnection;
                                #if connection not null
                                if ($connect != null)
                                                  
                                        {
                                            #get lga code in lga_codes table;
                                            $lga_code = $connect ->get_lga_code($lga);   
                                            #get propery type codes in property type codes table;  

                                            //check if property type is Residential building. if yes fetch from building type
                                            if ($property_type =='Residential Building') 
                                                {
                                                   #determine property type code
                                                    $prop_type= $building_type;
                                                    $property_type_code = $connect ->get_property_code($lga,$zone,$prop_type);
                                                   ##################################################################################### 
                                                     #determine the chargeable rate for Residential using formula 
                                                     $build_purpose = $building_purpose;
                                                     $rate = $connect->get_rate($lga,$zone,$prop_type,$build_purpose);

                                                }   
                                            else
                                                {    

                                                    $prop_type= $property_type; 
                                                    $property_type_code = $connect ->get_property_code($lga,$zone,$prop_type);
                                                    #########################################################################
                                                         //prop_type can be any value execept Residential Building
                                                         //if prop_type is equall to school then building purpose will be equal to school_category value.
                                                            switch ($prop_type) 
                                                            {
                                                                case 'Schools':
                                                                    $build_purpose = $building_purpose;
                                                                    $rate = $connect->get_rate($lga,$zone,$prop_type,$build_purpose);
                                                                    break;
                                                                //if prop_type is not equal to school and not equal to Residential Building 
                                                                //then buill purpose will be equal to Business    
                                                                default:
                                                                    $build_purpose='Business';
                                                                    $rate = $connect->get_rate($lga,$zone,$prop_type,$build_purpose);
                                                                    break;
                                                            }
                                                         
                                                           
                                                       //register ends here
                                                         //log into file for texting i will soon remove it
                                
                                                } 
                                       
                                                      
                                            } //i will erase  this later
                                            /*
                                            ###############                       
                                            #initialisng bill number staus
                                                $bill_number_status="awaiting";                                        
                                            $response = $connect->register(
                                                     $title,               $first_name,      $middle_name,
                                                     $last_name,           $gender,          $email,
                                                     $phone_number,        $occupation,      $property_id,
                                                     $house_number,        $street,          $area,         $landmark, 
                                                     $property_name,       $property_type,   $area_size,  
                                                     $building_type,       $build_purpose,   $category, 
                                                     $area_class,          $lga,             $lga_code,  
                                                     $property_type_code,  $zone,            $rate,  
                                                     $agent_id,            $mac_address,     $longitude, 
                                                     $latitude,            $bill_number_status

                                            ); //register ends here
                                            switch ($response) 
                                                {
                                                                            
                                                    case 'success':
                                                        echo (json_encode($response, JSON_PRETTY_PRINT));
                                                       // echo(str_pad('22', 6, mt_rand(0,9). mt_rand(0,9). mt_rand(0,9). mt_rand(0,9)));
                                                        break;
                                                    default :
                                                }
                                        } 
                                else 
                                        {
                                            $response="Failed to connect to the DB";
                                            echo ($response );
                                            
                                        }

                                 

                       //validate if ends here
                       
              
            } /else{ // server request is get

                 echo(json_encode("Request not supported"));
            }
        
/* STORE IMAGE FILE
            if ( $_FILES['file']['error'] > 0 ){
                echo 'Error: ' . $_FILES['file']['error'] . '<br>';
            }
            else {
                if(move_uploaded_file($_FILES['file']['tmp_name'], $path.'upload//' . $_FILES['file']['name']))
                {
                  $tur='true';
                }
            }
                     $response = $connect->checkpaymentlog($first_name,$path);
 
                      if( $response == "existed"){
                          echo json_encode("duplicate");
                      }
               else {
                 $response = $connect->logg(
                                                                    $title,               
                                                                    $first_name,     
                                                                    $middle_name,
                                                                    $last_name,          
                                                                    $gender,          
                                                                    $email,
                                                                    $phone_number,        
                                                                    $occupation,      
                                                                    $property_id,
                                                                    $house_number,        
                                                                    $street,          
                                                                    $area,         
                                                                    $landmark, 
                                                                    $property_name,       
                                                                    $property_type,   
                                                                    $area_size,  
                                                                    $building_type,      
                                                                    $building_purpose,   
                                                                    $category, 
                                                                    $area_class,          
                                                                    $lga,            
                                                                    $lga_code,  
                                                                    $property_type_code,  
                                                                    $zone,           
                                                                    $rate,  
                                                                    $agent_id,            
                                                                    $mac_address,     
                                                                    $longitude, 
                                                                    $latitude,          
                                                                    $path 
                                                                
                                                                );
                                             echo (json_encode($response1));  
               }
            }     */   
?>